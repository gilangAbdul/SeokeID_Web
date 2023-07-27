<?php
	session_start();
	require "functions.php";
	if(empty($_SESSION)){
        header("Location: ./account.php");
    }
	ifadmin($_SESSION['if_admin']);
	$produk = query("SELECT * FROM produk");
	$fname = $_SESSION['fname'];
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
			<li>
				<a href="admin.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Beranda</span>
				</a>
			</li>
			<li class="active">
				<a href="admin.php">
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
                    <a href="#" class="nav-link">Kategori</a>
					<h1>Produk</h1>
					<ul class="breadcrumb">
                        <li>
							<a href="#">Produk</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Admin Produk</a>
						</li>
					</ul>
				</div>
				<a href="formadd.php" class="btn-download">
					<i class='bx bx-add-to-queue'></i>
					<span class="text">Tambah Produk</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<div class="text">
						<h3><?php echo count($produk)?></h3>
						<p>Produk</p>
                    </div>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Daftar Produk</h3>
						<form action="">
							<input type="search" id="keyword">
							<i class='bx bx-search' ></i>
						</form>
					</div>
					<table>
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Kategori Produk</th>
								<th>Harga</th>
                                <th>Stok</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php foreach($produk as $row){
								$status = '';
								$class = '';
								if($row['stok']< 15){
									global $status;
									global $class;
									$class = 'pending';
									$status = 'Hampir Habis';
								}elseif($row['stok'] < 50){
									$class = 'process';
									$status = 'Menipis';
								}else{
									$class = 'done';
									$status = 'Tersedia';
								};?>
								<tr>
									<td>
										<img src="img/<?php echo $row['gambar'];?>" alt="">
										<p><?php echo $row['nama'];?></p>
									</td>
									<td><?php echo $row['kategori'];?></td>
									<td><?php echo 'Rp '.number_format($row['harga'],0,",",".");?></td>
									<td><?php echo $row['stok'];?></td>
									<td><span class="status <?=$class?>"><?=$status?></span></td>
									<td><a href="ubahProduk.php?id=<?=$row['id'];?>"><i class="bx bxs-edit status completed" ></i></a></td>
									<td><a href="hapusProduk.php?id=<?=$row['id'];?>" onclick="return confirm('Konfirmasi hapus produk')"><i class='bx bx-trash status pending' ></i></i></a></td>
								</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="./js/admin.js"></script>
</body>
</html>