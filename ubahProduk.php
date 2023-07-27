<?php
    $id = $_GET['id'];
	session_start();
    require "./functions.php";
	if(isset($_POST["ubah"])){
		if (ubah($_POST, $id) > 0){
			echo "<script> 
				alert('Produk Berhasil diubah');
				document.location.href = 'admin_product.php';
			</script>";
		} else{
			echo "<script>
				alert('Produk Gagal diubah');
				document.location.href = 'admin_product.php';
				</script>";
		}
	}
    $produk = query("SELECT * FROM produk WHERE id='$id'");
	$produk = $produk[0];


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
	<link rel="stylesheet" href="./css/admin_styles.css">
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

    <section id="content">
		<!-- MAIN -->
		<section class="main">
			<div class="head-title">
				<div class="left">
					<h1>Tambah Produk</h1>
				</div>

			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Isi Form Produk berikut untuk menambah produk</h3>
					</div>
                    <div class="form">
                        <form id="order-form" action="" method="post" enctype="multipart/form-data">
                            <h4>Detail Produk:</h4>
                            <label for="category">Kategori Produk:</label>
                            <select id="category" name="kategori" value="<?=$produk['kategori'];?>" required>
                                <option value="">-- Masukkan Kategori --</option>
                                <option value="Snack Asin">Snack Asin</option>
                                <option value="Snack Manis">Snack Manis</option>
                                <option value="Snack Pedas">Snack Pedas</option>
                            </select>

                            <label for="product-name">Nama Produk:</label>
                            <input type="text" id="product-name" name="nama" required autocomplete="off" value="<?=$produk['nama'];?>">
                
                            <label for="product-price">Harga Produk:</label>
                            <input type="number" id="product-price" name="harga" autocomplete="off" placeholder="Masukkan Harga Tanpa Rp" required value="<?=$produk['harga'];?>">
                
                            <label for="product-des">Deskripsi Produk:</label>
							<textarea id="product-des" rows="10" name="deskripsi"><?=$produk['deskripsi'];?></textarea>
                            <!-- <input type="text" id="product-des" name="deskripsi" autocomplete="off" required value="<?=$produk['deskripsi'];?>"> -->
                            
                            <label for="product-stok">Masukkan Stok Produk:</label>
                            <input type="number" id="product-stok" name="stok" autocomplete="off" required value="<?=$produk['stok'];?>">
                
                          
                            <h4>Photo Produk:</h4>
                            <label for="file-product">Masukkan Foto Produk:</label>
                            <input type="file" id="file-product" name="gambar">
                            <div class="field">
                                <label>Produk Pre-Order:</label>
                                <div class="preoder">
                                    <label><input type="radio" name="preorder" value="ya" required> Ya</label>
                                    <label><input type="radio" name="preorder" value="tidak"> Tidak</label>
                                </div>
                            </div>

                            <button type="submit" name="ubah" class="btn-download">
                                <i class='bx bx-add-to-queue'></i>
                                <span class="text">Konfirmasi Ubah Produk</span>
							</button>
                          </form>
                    </div>

				</div>
			</div>
		</section>
		<!-- MAIN -->
	</section>
	
</body>
</html>