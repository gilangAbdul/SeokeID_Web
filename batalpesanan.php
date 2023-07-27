<?php
    $id_pesanan = $_GET['id_pesanan'];
    require "./functions.php";
    if(hapusOrder($id_pesanan)>0){
        echo "<script>
        alert('Pesanan Dibatalkan');
        document.location.href = 'myorder.php';
        </script>";
    } else{
        echo "<script>
        alert('Error');
        document.location.href = 'myorder.php';
        </script>";
    }
?>