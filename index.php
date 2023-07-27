<?php
    session_start();
    require "functions.php";
    $topProduk = query("SELECT * FROM produk ORDER BY stok LIMIT 0, 8");
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
    <link rel="stylesheet" href="./css/home_style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/e12c34da31.js"></script>
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

    <section class="hero">
            <div class="box">
                <p>Temukan  snack favoritmu disini 🍿</p>
            </div>
            <h1>
                Nikmati <br>aneka snack murah <br>dan berkualitas ✨
            </h1>
            <h6>SEOKE ID menyediakan berbagai 
                snack ringan untuk keluarga <br>dan teman ngemil kalian </h6>
            <div class="button" onclick="window.location.href='product.php'">
                <button>Order Sekarang!</button>
            </div>
    </section>
    
    <section class="kategori">
        <h4>Kategori Snack</h4>
        <div class="category">
            <ul  class="cat">
                <li id="manis">
                    <a href="./product.php">
                        <i class="fa-solid fa-face-grin-hearts face"></i>
                        <br><p>Snack Manis</p>
                    </a>
                </li>
                <li id="pedas">
                    <a href="./product.php">
                        <i class="fa-solid fa-face-dizzy face"></i>
                        <br><p>Snack Pedas</p>
                    </a>
                </li>
                <li id="asin">
                    <a href="./product.php">
                        <i class="fa-solid fa-face-grin-stars face"></i>
                        <br><p>Snack Asin</p>
                    </a>
                    
                </li>
            </ul>
        </div>
    </section>

    <section class="product">
        <h2>Produk Paling dicari</h2>
        <h4>Produk paling sering dicari</h4>
        <div class="pro-container">
            <?php foreach($topProduk as $row):?>
                <a href="sproduct.php?id=<?=$row['id']?>">
                <div class="pro">
                    <img src="img/<?= $row['gambar'] ?>" alt="">
                    <div class="des">
                        <span><?= $row['kategori'] ?></span>
                        <h6><?= $row['nama'] ?></h6>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p>Rp <?= number_format($row['harga'], 0, ",", ".")?></p>
                    </div>
                    <a href="./product.php"><i class="fa-solid fa-cart-plus fa-lg"></i></a>
                </div>
                </a>
            <?php endforeach;?>
        </div>
    </section>

    <section class="testimoni">
        <h4>Testimonial SEOKE ID</h4>
        <h2><i class="fa-regular fa-comment-dots"></i> • Apa Kata Mereka Tentang SEOKE ID</h2>
        <div class="testi-container">
            <div class="slide-container">
                <div class="card">
                    <img src="img/home/testi_1.png" alt="">
                    <div class="content">
                        <p>Snack di SEOKE ID<br>murah dan sangat enak 👍</p>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <a>Bu Nori Wilantika</a>
                        <h6>Dosen Baik Hati</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="img/home/testi_3.png" alt="">
                    <div class="content">
                        <p>Pelayanan pesanan di SEOKE ID<br>sangat cepat dan tanggap</p>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <a>Kak Windi</a>
                        <h6>Mahasiswa</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="img/home/testi_2.png" alt="">
                    <div class="content">
                        <p>SEOKE ID membantu saya memilih teman nyemil terbaik</p>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <a>Gilang Abdul</a>
                        <h6>Warga Bikini Bottom</h6>
                    </div>
                </div>
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
                <li><a href="contact.php">Kontak Kami</a></li>
            </ul>
        </div>
    </section>
    <script src="./js/home.js"></script>

</body>
</html>