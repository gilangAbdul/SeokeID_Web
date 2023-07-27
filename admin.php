<?php
	session_start();
	require "./functions.php";
	if(empty($_SESSION)){
        header("Location: ./account.php");
    }
	ifadmin($_SESSION['if_admin']);
	$fname = $_SESSION['fname'];

	$pesanan = query("SELECT * FROM pesanan ORDER BY tgl_order DESC");
	$alamat = query("SELECT * FROM alamat");

	$pesanan_dummy = query("SELECT id_pesanan FROM pesanan WHERE status = '1'");
	$pesanan_baru = count($pesanan_dummy);
	$pesanan_dummy = query("SELECT id_pesanan FROM pesanan WHERE status = '3'");
	$pesanan_dikirim = count($pesanan_dummy);

	$pesanan_dummy = query("SELECT total FROM pesanan WHERE status = '4'");
	$total_penjualan = 0;
	foreach ($pesanan_dummy as $total):
		$total_penjualan += $total['total']*1;
	endforeach;
	$total_penjualan = number_format($total_penjualan, 0, ",", ".");
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
							<a href="#">Beranda</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Admin Dashboard</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<div class="text">
						<h3><?= $pesanan_baru; ?></h3>
						<p>Pesanan Baru</p>
                    </div>
				</li>
				<li>
					<i class='bx bxs-truck' ></i>
					<div class="text">
						<h3><?= $pesanan_dikirim; ?></h3>
						<p>Sedang dikirim</p>
                    </div>
				</li>
				<li>
					<i class='bx bxs-coin-stack' ></i>
					<div class="text">
						<h3> Rp <?= $total_penjualan?></h3>
						<p>Total Penghasilan</p>
                    </div>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Daftar Pesanan</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Tanggal Pemesanan</th>
								<th>Status</th>
								<th>Rincian</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($pesanan as $row):
							$userid = $row['id_user'];
							$username = query("SELECT Fname, Lname FROM user WHERE id= '$userid'");
							$username = $username[0]['Fname']." ".$username[0]['Lname'];
							$tgl_order = explode(" ",$row['tgl_order']);
							$tgl_order = $tgl_order[0];
							$status =  $row['status']*1;
							?>
							<tr>
								<td><p><?= $username; ?></p></td>
								<td><?= $tgl_order; ?></td>
								<td><?php
									if($status === 1){
										echo "<span class='status completed'>Pesanan Baru</span>";
									}elseif($status === 2){
										echo "<span class='status process'>Pesanan Diproses</span>";
									}elseif($status === 3){
										echo "<span class='status send'>Pesanan Dikirim</span>";
									}else
										echo "<span class='status done'>Pesanan Selesai</span>";
								?></td>
								<td><a href="detailOrder.php?id=<?=$row['id_pesanan'];?>"><button>Rincian Pesanan</button></a></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>
</html>