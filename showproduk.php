<?php
    require "./functions.php";
    if (isset ($_GET['id'])){
        $kode = $_GET['id'];
        $produk = query("SELECT nama,harga,id FROM produk WHERE id LIKE '$kode%' ");
    } elseif(isset ($_GET['keyword'])){
        $keyword = $_GET['keyword'];
        $produk = query("SELECT * FROM produk WHERE 
                            nama LIKE '%$keyword%' OR
                            kategori LIKE '%$keyword%'");
    }
    echo "<option> --Pilihan Produk-- </option>";
    foreach($produk as $data){
        echo "<option value=".$data['harga'].",".$data['id']."> ".$data['nama']."</option>";
    }
?>