<?php
    require "./functions.php";
    $id_pesanan = $_GET['id'];

    if(sendOrder($id_pesanan) > 0){
        echo "<script> 
        alert('Pesanan Dikirim');
        document.location.href = 'admin.php';
        </script>";
    } else{
        echo "<script>
            alert('Status Pesanan Gagal Dikirim');
            document.location.href = 'admin.php';
            </script>";
    }
?>