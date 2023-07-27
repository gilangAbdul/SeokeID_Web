<?php
    $id_pesanan = $_GET['id_pesanan'];
    require "./functions.php";
    if(finishOrder($id_pesanan)>0){
        echo "<script>
        alert('Pesanan Diselesaikan');
        document.location.href = 'myorder.php';
        </script>";
    } else{
        echo "<script>
        alert('Error');
        document.location.href = 'myorder.php';
        </script>";
    }
?>