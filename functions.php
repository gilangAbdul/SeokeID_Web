<?php
    $conn = mysqli_connect("sql312.infinityfree.com", "if0_34631155", "lEJJAfcUK1u", "if0_34631155_seoke");
    date_default_timezone_set('Asia/Jakarta');

    function ifadmin($data){
        if($data == 1){
            return;
        } else 
            return header("Location: ./index.php");
    }

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function getId($kategori){
        global $conn;
        $kat = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = '$kategori'");
        $row = 0;
        while(mysqli_fetch_assoc($kat)){
            $row++;
        }
        $row++;
        $id = null;
        if($kategori === "Snack Asin"){
            $id = "SA";
        } elseif($kategori === "Snack Manis"){
            $id = "SM";
        } elseif($kategori === "Snack Pedas"){
            $id = "SP";
        }
        $id .= $row;
        return $id;
    }

    function upload(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if($error === 4 ){
            echo "<script>
                    alert('Pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        $ekstensiValid = ['jpg', 'jpeg', 'png', 'JPG'];
        $ekstensiGambar = pathinfo( $namaFile, PATHINFO_EXTENSION);

        if(!in_array($ekstensiGambar, $ekstensiValid)){
            echo "<script>
                    alert('Pilih file ekstensi (*.jpg, *.jpeg, atau *.png)');
                </script>";
            return false;
        }

        if($ukuranFile > 2000000){
            echo "<script> 
                    alert ('Ukuran Gambar terlalu besar')
                    </script>";
            return false;
        }

        $namaFileBaru = uniqid().'.'.$ekstensiGambar;
        move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

        return $namaFileBaru;
    }

    function tambah($data){
        global $conn;
		$kategori = htmlspecialchars($data['kategori']);
        $id = getId($kategori);
		$nama = htmlspecialchars($data['nama']);
		$harga = htmlspecialchars($data['harga']);
		$stok = htmlspecialchars($data['stok']);
		$preorder = $data['preorder'];
        $deskripsi = htmlspecialchars($data['deskripsi']);
		$gambar = upload();

        if(!$gambar){
            return false;
        }

        $query = "INSERT INTO produk 
                    VALUES 
                    ('$id','$nama', '$kategori', '$harga', '$stok', '$preorder', '$gambar', '$deskripsi')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function ubah($data, $id){
        global $conn;
		$kategori = htmlspecialchars($data['kategori']);
		$nama = htmlspecialchars($data['nama']);
		$harga = htmlspecialchars($data['harga']);
		$stok = htmlspecialchars($data['stok']);
		$preorder = $data['preorder'];
        $deskripsi = htmlspecialchars($data['deskripsi']);
		$gambar = upload();

        if(!$gambar){
            return false;
        }
        $query = "UPDATE produk SET 
                    nama = '$nama', 
                    kategori = '$kategori', 
                    harga = '$harga', 
                    stok = '$stok', 
                    preorder = '$preorder', 
                    gambar = '$gambar', 
                    deskripsi = '$deskripsi'
                WHERE id = '$id'";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function addorder($data, $id_user){
        global $conn;
        $namaProduk = $data['product-name'];
        $namaProduk = explode(",",$namaProduk);
        $namaProduk = htmlspecialchars($namaProduk[1]);
    
        $jumlahPesanan = $data['quantity'];
        $totalHarga = $data['totalharga'];
        $namePenerima = htmlspecialchars($data['full-name']);
        $provinsi = $data['province'];
        $kota = $data['city'];
        $alamat = htmlspecialchars($data['address']);
        $zip =htmlspecialchars($data['zip']);
        $telp = htmlspecialchars($data['phone']);
        $kurir = $data['kurir'];

        $layanan = $data['service'];
        $layanan = explode(",",$layanan);
        $layanan = htmlspecialchars($layanan[1]);
        
        $payment = $data['payment'];
        $komen = htmlspecialchars($data['comments']);
        $id_pesanan = $namaProduk.uniqid().$id_user;

        $order_tgl = date("Y-m-d H:i:s");
        
        $query = "INSERT INTO pesanan
                    VALUES
                    ('$id_pesanan', '$namaProduk', '$jumlahPesanan', '$totalHarga',
                    '$id_user', '$order_tgl', null, '1', '$payment', '$komen')";
        mysqli_query($conn, $query);

        $query2 = "INSERT INTO alamat 
                    VALUES
                    ('$id_user', '$id_pesanan', '$namePenerima', '$telp',
                    '$provinsi', '$kota', '$zip', '$alamat', '$kurir', '$layanan')";
        mysqli_query($conn, $query2);

        return mysqli_affected_rows($conn);
    }

    function hapusOrder($id){
        global $conn;
        $query = "DELETE FROM pesanan WHERE id_pesanan='$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function finishOrder($id){
        global $conn;
        $finish_tgl  = date("Y-m-d H:i:s");
        $query = "UPDATE pesanan SET 
            tgl_selesai = '$finish_tgl', 
            status = '4'
            WHERE id_pesanan = '$id'";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function confirmOrder($id_pesanan,$id_produk, $jumlah){
        global $conn;
        $stok = query("SELECT stok FROM produk WHERE id='$id_produk'");
        $stok = ($stok[0]['stok'])*1;
        if ($stok < $jumlah){
            return 4;
        }else{
            try{
                $query = "UPDATE produk SET
                         stok = GREATEST(0,stok- $jumlah)
                        WHERE id = '$id_produk'";
                mysqli_query($conn, $query);
            } catch(Exception){
                return 3;
            }
            try{
                $query = "UPDATE pesanan SET 
                    status = '2'
                    WHERE id_pesanan = '$id_pesanan'";
                mysqli_query($conn, $query);
            } catch(Exception){
                return 3;
            }
            return mysqli_affected_rows($conn);
        }
    }

    function sendOrder($id){
        global $conn;
        $query = "UPDATE pesanan SET 
            status = '3' 
            WHERE id_pesanan = '$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function addUser($data){
        global $conn;
        $username = $data['username'];
        $pass = $data['password'];
        $email=$data['email'];
        $fname = $data['fname'];
        $lname = $data['lname'];
        $id ="P";

        $row = query("SELECT * FROM user WHERE id LIKE '$id%'");
        $sum_row = count($row);
        $sum_row++;
        $id = "P".$sum_row;

        $query = "INSERT INTO user
            (`id`, `username`, `Fname`, `Lname`, `password`, `email`, `if_admin`) 
            VALUES ('$id','$username','$fname','$lname','$pass','$email',0)";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function getProvince(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 5a1b3e470a2c33744e18eeac486e563d"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $province = json_decode($response);
        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return $province;
        }
    }
?>