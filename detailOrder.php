<?php
	session_start();
    $id_pesanan = $_GET['id'];
	require "./functions.php";
    if(empty($_SESSION)){
        header("Location: ./account.php");
    }
	ifadmin($_SESSION['if_admin']);
	$fname = $_SESSION['fname'];
	$pesanan = query("SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan'");
    $pesanan= $pesanan[0];
	$alamat = query("SELECT * FROM alamat WHERE id_pesanan='$id_pesanan'");
    $alamat = $alamat[0];
    $idProduk = $pesanan['nama_produk'];
    $namaProduk = query("SELECT nama FROM produk WHERE id= '$idProduk'");
    $namaProduk = $namaProduk[0]['nama'];

?>


<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon Website" href="./img/nachos.png?v=<?php echo time(); ?>">
    <title>SEOKE ID</title>
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="./css/admin_styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css">

</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
        <div class="logo">
            <a href="index.php"><img src="img/home/logo.png" alt="icon"></a>
            <a href="index.php">SEOKE ID</a>
        </div>
		<ul class="side-menu top">
			<h1>Hello <?='<br>'.$fname?></h1>
			<li class="active">
				<a href="admin.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Beranda</span>
				</a>
			</li>
			<li>
				<a href="admin_product.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Produk</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="./logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- MAIN -->
		<section class="main">
			<div class="head-title">
				<div class="left">
					<h1>Beranda</h1>
					<ul class="breadcrumb">
						<li>
							<a href="./admin.php">Beranda</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="">Rincian Pesanan</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
                    <a href="./admin.php"><i class="bx bx-arrow-back"></i></a>
                    <br><br>
					<h2>Rincian Pesanan</h2>
                    <div class= "rincian">
                        <h3>Detail Produk yang dipesan </h3>
                        <table>
                            <tr>
                                <td>Tanggal Pemesanan </td>
                                <td>: <?php $tgl = $pesanan['tgl_order'];
                                            $tgl = explode(" ", $tgl);
                                            echo $tgl[0]."  (".$tgl[1].")";
                                ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Pesanan </td>
                                <td>: <?=$pesanan['jumlah'];?></td>
                            </tr>
                            <tr>
                                <td>Kemungkinan Income: </td>
                                <td>: Rp <?= number_format($pesanan['total'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran </td>
                                <td>: <?php
                                    $tipe = $pesanan['metode_pembayaran']*1;
                                    if ($tipe === 1){
                                        echo "GOPAY";
                                    } elseif($tipe === 2){
                                        echo "OVO";
                                    } elseif($tipe === 3){
                                        echo "TRANSFER REKENING";
                                    } else{
                                        echo "COD";
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td>Catatan Pembeli </td>
                                <td>: <?= $pesanan['catatan']; ?></td>
                            </tr>
                        </table>
                        <h3>Detail Pengiriman</h3>
                        <table>
                            <tr>
                                <td>User Id</td>
                                <td>: <?=$alamat['id_user']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Penerima </td>
                                <td>: <?=$alamat['full_name']; ?></td>
                            </tr>
                            <tr>
                                <td>Nomor HP </td>
                                <td>: <?=$alamat['kontak']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat </td>
                                <td>: <?=$alamat['address']; ?> </td>
                            </tr>
                            <tr>
                                <td>Kurir </td>
                                <td>: <?=$alamat['kurir']; ?></td>
                            </tr>
                            <tr>
                                <td>Tipe Pegiriman </td>
                                <td>: <?=$alamat['layanan']; ?> </td>
                            </tr>
                            <tr>
                                <td>Status Pesanan </td>
                                <td>: <?php
                                    $tipe = $pesanan['status']*1;
                                    if ($tipe === 1){
                                        echo "Belum Dikonfimasi";
                                    } elseif($tipe === 2){
                                        echo "Pesanan Diproses";
                                    } elseif($tipe === 3){
                                        echo "Pesanan Dikirim";
                                    } else{
                                        echo "Pesanan Selesai";
                                    }
                                ?></td>
                            </tr>
                        </table>

                        <?php
                            if($tipe === 1){?>
                                <a href="./confirm.php?id=<?= $pesanan['id_pesanan'];?>">
                                <button type="submit" name="ubah" class="btn-download">
                                    <span class="text">Konfirmasi Pesanan</span>
                                </button>
                                </a>
                            <?php }elseif ($tipe===2){?>
                                <a href="./kirim.php?id=<?=$pesanan['id_pesanan'];?>">
                                <button type="submit" name="ubah" class="btn-download">
                                    <span class="text">Konfirmasi Kirim Pesanan</span>
                                </button>
                                </a>
                            <?php } else{?>
                                <button type="submit" name="ubah" class="btn-download">
                                    <span class="text">Pesanan Selesai</span>
                                </button>
                            <?php }?>
				</div>
			</div>
		</section>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>
</html>