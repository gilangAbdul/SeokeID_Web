<?php
    session_start();
    require "./functions.php";
    if(empty($_SESSION)){
        header("Location: ./account.php");
    }
    $id_user = $_SESSION['id_user'];
    if(!empty($_SESSION)){
        $fname = $_SESSION['fname'];
        $if_admin = $_SESSION['if_admin'];
    }
    $myOrder = query("SELECT * FROM pesanan WHERE id_user = '$id_user' ORDER BY tgl_order DESC");
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

    <section id="myorder">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Gambar</td>
                    <td>Nama Produk</td>
                    <td>Jumlah</td>
                    <td>Status</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($myOrder as $row):
                    $id_produk = $row['nama_produk'];
                    $produk = query("SELECT nama, gambar FROM produk WHERE id='$id_produk'");
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><img src="./img/<?=$produk[0]['gambar'];?>" alt=""></td>
                    <td><?=$produk[0]['nama'];?></td>
                    <td><?=$row['jumlah']; ?></td>
                    <td><?php
                        $status = $row['status']*1;
                        if($status === 1){
                            echo "Pesanan Sedang <br>Dikonfirmasi";
                        }elseif($status === 2){
                            echo "Pesanan Sedang <br> Diproses";
                        }elseif($status === 3){
                            echo "Pesanan Sedang <br> Dikirim";
                        }else
                            echo "Pesanan Selesai";
                    ?></td>
                    <?php if($status === 1){?>
                        <td><a href='batalpesanan.php?id_pesanan=<?=$row['id_pesanan'];?>' onclick="return confirm('Konfirmasi hapus produk')"><button class='working'>Batalkan Pesanan</button></a></td>
                    <?php }elseif($status === 3){?>
                        <td><a href='selesaipesanan.php?id_pesanan=<?=$row['id_pesanan'];?>'><button class='isdone'>Pesanan Diterima</button></a></td>
                    <?php }elseif($status === 4){
                        echo "<td><a href=''><button class='done'>Pesanan Selesai</button></a></td>";
                    }else
                        echo "<td><button class='notworking'>Batalkan Pesanan<td>";
                    ?>
                </tr>
                <?php 
                    $i++;
                    endforeach;
                ?>
            </tbody>
        </table>
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
</body>
</html>