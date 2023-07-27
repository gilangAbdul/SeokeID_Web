<?php
    session_start();
    require "./functions.php";
    if(empty($_SESSION)){
        header("Location: ./account.php");
    }
    $allProvince = getProvince();
    if(!empty($_SESSION)){
        $fname = $_SESSION['fname'];
        $if_admin = $_SESSION['if_admin'];
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon Website" href="./img/nachos.png?v=<?php echo time(); ?>">
    <title>SEOKE ID</title>
    <script src="https://kit.fontawesome.com/e12c34da31.js"></script>
    <link rel="stylesheet" href="./css/home_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css">
</head>

<body>
    <section class="header">
        <div class="logo">
            <a href="index.php"><img src="img/home/logo.png" alt="icon"></a>
            <a href="index.php">SEOKE ID</a>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="index.php" class="active">Beranda</a></li>
                <li><a href="product.php">Produk</a></li>
                <li><a href="myorder.php">Pesanan Saya</a></li>
                <li><a href="formbuy.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a id="menu"><i class="fa-solid fa-user"></i></a></li>
                <a href="" id="close"><i class="fa-solid fa-times"></i></a>
            </ul>
            <div class="menu-wrap" id="sub-menu">
                <div class="sub-menu">
                    <?php if(!empty($fname)){?>
                        <div class="user-info">
                        <i class="fa-solid fa-user"></i>
                        <h4>Halo <?=$fname?></h4>
                    </div>
                    <?php } else{?>
                        <div class="user-info">
                        <i class="fa-solid fa-user"></i>
                        <a href="./account.php">Login</a>
                        </div>
                    <?php }?>
                    <hr>
                    <?php if (!empty($if_admin )){?>
                            <a href="./admin.php" class="sub-menu-link">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <h6>Masuk Panel Admin</h6>
                                <span>></span>
                            </a>
                        <?php } ?>
                    <?php if(!empty($fname)){?>
                    <a href="./logout.php" class="sub-menu-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <h6>Logout</h6>
                        <span>></span>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <div class="mobile">
            <a href="formbuy.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section class="form">
        <h1>Form Pemesanan</h1>
        <form id="order-form" method="post" action="./buatpesanan.php">
            <h2>Produk:</h2>
            <div class="field">
                <label>Kategori Produk:</label>
                <div class="category">
                    <label><input type="radio" name="cat" value="SA" onchange="updateProduct()">  Snack Asin</label>
                    <label><input type="radio" name="cat" value="SM" onchange="updateProduct()">  Snack Manis</label>
                    <label><input type="radio" name="cat" value="SP" onchange="updateProduct()">  Snack Pedas</label>
                </div>
            </div>
          
            <label for="product-name">Nama Produk:</label>
            <select id="product-name" name="product-name" onchange="updateHarga()" required>
              <option>-- Pilih produk --</option>
            </select>
          
            <label for="product-price">Harga Produk:</label>
            <p type="text" id="product-price"></p>
          
            <label for="quantity">Jumlah:</label>
            <select id="quantity" name="quantity" required onchange="totalHarga(this.value)">
                <option value="">-- Pilih Jumlah --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <input type="hidden" id="totalharga" name="totalharga">
            <h2>Informasi Pengiriman:</h2>
          
            <label for="full-name">Nama Lengkap:</label>
            <input type="text" id="full-name" name="full-name" required>
            
            <label for="state">Provinsi:</label>
            <select name="province" id="province" require onchange="carikota(this.value)">
                <option>Pilih Provinsi</option>
                <?php
                    foreach ($allProvince -> rajaongkir ->results as $province){
                        echo "<option value='".$province -> province_id."'>"
                        .$province -> province."</option>";
                    }
                ?>
            </select>

            <label for="city">Kabupaten/ Kota:</label>
            <select name="city" id="city" require>
                <option >Pilih Kota</option>
            </select>
          
            <label for="address">Alamat Lengkap:</label>
            <input type="text" id="address-line-1" name="address" required>
            
            <label for="zip">Kode Pos:</label>
            <input type="text" id="zip" name="zip" required>
            
            <h2>Informasi Kontak:</h2>
          
            <label for="email">Alamat Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            
            <label for="phone">Nomor Telepon:</label>
            <input type="tel" id="phone" name="phone" placeholder="No.Telp/ HP" required pattern="(\62|0)8[1-9][0-9]{6,9}$">
 
            <h2>Pilih Jasa Pengantaran:</h2>
            <label for="kurir">Pilih Kurir:</label>
            <select id="kurir" name="kurir" required onchange="carilayanan(this.value)"> 
                <option value="">-- Pilih Kurir --</option>
                <option value="jne">JNE</option>
                <option value="pos">Pos Indonesia</option>
                <option value="tiki">TIKI</option>
            </select>
 
            <label for="service">Jenis Layanan:</label>
            <select id="service" name="service" required onchange="hitungTotal()"> 
                <option value="">-- Pilih Layanan --</option>
            </select>


            <h2>Total Harga</h2>
            <label>Total Harga:</label>
            <h4 id="total-price"></h4>
            <i>*Harga sudah termasuk ongkir dan pajak</i>

            <h2>Informasi Pembayaran:</h2>
          
            <label for="payment">Metode Pembayaran:</label>
            <select id="payment" name="payment" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="1">Gopay</option>
                <option value="2">Ovo</option>
                <option value="3">Transfer Bank (admin Rp 2500)</option>
                <option value="4">COD (Hanya Beberapa Wilayah)</option>
            </select>
            <h2>Komentar/ Catatan:</h2>
            <label for="comments">Catatan: <br>
                <textarea id="comments" name="comments" rows="10" placeholder="Packing yang rapi ya kak!"></textarea>
            </label>
          
            <button type="submit">Buat Pesanan</button>
          </form>
          
    </section>

    <section class="footer">
        <img src="img/home/logo.png" alt="">
        <div class="des">
            <h4>SEOKE ID</h4>
            <p>SEOKE ID menyediakan berbagai jenis pilihan snack ringan <br>untuk keluarga dan teman-teman kalian semua</p>
            <div class="link">
                <div class="left">

                </div>
                <a href="https://wa.me/6289506608135" target="_blank"><i class="fa-sharp fa-solid fa-phone"></i> &#9; &#9; 0895-0660-8135</a>
                <a href="mailto:seoke.id@gmail.com" target="_blank"><i class="fa-solid fa-envelope"></i> &#9; &#9; seoke.id@gmail.com</a>
                <a href="https://goo.gl/maps/x8rWwBfQUc3Vm8jC6" target="_blank"><i class="fa-sharp fa-solid fa-location-dot"></i> &#9; &#9; Jakarta Timur, Indonesia</a>
            </div>
            <div class="sosmed">
                <h6>Follow Us</h6>
                <a href="http://www.instagram.com/seoke.id/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="http://www.facebook.com/seoke.id" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            </div>
        </div>
        <div class="foot">
            <footer><small>&copy; Copyright All Rights Reserved</small> </footer> 
            <ul>
                <li><a href="contact.html">Kontak Kami</a></li>
            </ul>
        </div>
    </section>
    <script src="./js/home.js?v=<?php echo time(); ?>"></script>
    <script>
        function carikota(id_province){
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                const city = document.getElementById('city');
                city.innerHTML=xhr.responseText;
            }
        }
        xhr.open('GET', './API_carikota.php?province='+id_province, true);
        xhr.send();
            }
    </script>
</body>
</html>