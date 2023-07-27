<?php
    require "./functions.php";

    $id_pesanan = $_GET['id'];
    $data = query("SELECT jumlah,nama_produk FROM pesanan WHERE id_pesanan = '$id_pesanan'");
    $jumlah = $data[0]['jumlah'];
    $jumlah *= 1;
    $id_produk = $data[0]['nama_produk'];
    $iswork = confirmOrder($id_pesanan, $id_produk,$jumlah);

    if($iswork == 4){
        echo "<script> 
        alert('Stok Barang tidak mencukupi Silahkan Update Stok Produk Terlebih dahulu');
        document.location.href = 'admin.php';
        </script>";
    } else if($iswork == 3){
        echo "<script>
            alert('Terjadi Error');
            document.location.href = 'admin.php';
            </script>";
    } else if($iswork == 1){
        echo "<script>
            alert('Status Pesanan Berhasil diubah');
            document.location.href = 'admin.php';
            </script>";
    } else{
        echo "<script>
            alert('Status Pesanan Gagal diubah');
            document.location.href = 'admin.php';
            </script>";
    }
?>