<?php
    require "./functions.php";
        $keyword = $_GET['keyword'];
        $produk = query("SELECT * FROM produk WHERE 
                            nama LIKE '%$keyword%' OR
                            kategori LIKE '%$keyword%'");
?>

<?php foreach($produk as $row){?>
    <tr>
        <td>
            <img src="img/<?php echo $row['gambar'];?>" alt="">
            <p><?php echo $row['nama'];?></p>
        </td>
        <td><?php echo $row['kategori'];?></td>
        <td><?php echo 'Rp '.number_format($row['harga'],0,",",".");?></td>
        <?php 	
            $status = '';
            $class = '';
            if($row['stok']< 20){
                global $status;
                global $class;
                $class = 'pending';
                $status = 'Hampir Habis';
            }elseif($row['stok'] < 50){
                $class = 'process';
                $status = 'Menipis';
            }else{
                $class = 'completed';
                $status = 'Tersedia';
            };?>
        <td><span class="status <?=$class;?>"><?=$status; ?></span></td>
        <td><a href="ubahProduk.php?id=<?=$row['id']?>"><i class="bx bxs-edit status completed"></i></a></td>
        <td><a href="hapusProduk.php?id=<?=$row['id']?>"><i class='bx bxs-message-square-x status pending'></i></i></a></td>
    </tr>
<?php }?>
