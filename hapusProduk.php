<?php
    $id = $_GET['id'];
    require "./functions.php";
    $query = "DELETE FROM produk WHERE id='$id'";
    mysqli_query($conn, $query);
    $hasil = mysqli_affected_rows($conn);
    if($hasil > 0){
        echo "<script>
        alert('Produk ",$id," Berhasil dihapus');
        document.location.href = 'admin_product.php';
        </script>";
    } else{
        echo "<script>
        alert('Error');
        document.location.href = 'admin_product.php';
        </script>";
    }
?>