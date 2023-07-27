<?php
    session_start();
    require "functions.php";
    $id = $_GET['id'];
    $row = query("SELECT * FROM produk WHERE id='$id'");
    $row = $row[0];
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

    <section id="detail" class="product">
        <div class="single-pro-image">
            <img src="img/<?= $row['gambar']?>" id="main" alt="">
        </div>

        <div class="pro-detail">
        <h1>Detail Produk:</h1>
            <div id="pro-kategori">
                <h3>Kategori : <?= $row['kategori']?></h3>
            </div>
            <div id="pro-nama">
                <h2><?= $row['nama']?></h2>
            </div>
            <div id="pro-Harga">
                <h2>Rp <?= number_format($row['harga'],0,",",".")?></h2>
            </div>
            <h4>Deskripsi Snack: </h4>
            <div id="pro-des">
                <span><?=$row['deskripsi']?></span>
            </div>
            <div class="button" onclick="window.location.href='formbuy.php'">
                <button>Tambah Keranjang</button>
            </div>
        </div>
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

    <script src="./js/home.js"></script>
</body>
</html>