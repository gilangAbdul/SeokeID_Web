<?php
    require "./functions.php";
    if (isset ($_GET['id'])){
        $kode = $_GET['id'];
        $produk = query("SELECT * FROM produk WHERE id LIKE '$kode%' ");
    } elseif(isset ($_GET['keyword'])){
        $keyword = $_GET['keyword'];
        $produk = query("SELECT * FROM produk WHERE 
                            nama LIKE '%$keyword%' OR
                            kategori LIKE '%$keyword%'");
    }
?>

<div class="pro-container">
    <?php foreach($produk as $row):?>
        <a href="sproduct.php?id=<?=$row['id'];?>">
        <div class="pro">
            <img src="img/<?= $row['gambar']; ?>" alt="">
            <div class="des">
                <span><?= $row['kategori']; ?></span>
                <h6><?= $row['nama']; ?></h6>
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>Rp <?= number_format($row['harga'], 0, ",", ".")?></p>
            </div>
            <a href="./sproduct.php?id<?=$row['id'];?>"><i class="fa-solid fa-cart-plus fa-lg"></i></a>
        </div>
        </a>
    <?php endforeach;?>
</div>

