<?php
    session_start();
    $id_user = $_SESSION['id_user'];
    require "./functions.php";

    if(addorder($_POST, $id_user) >0){
        echo "<script> 
        alert('Pesanan Berhasil Dibuat Silahkan Menunggu Konfirmasi Admin');
        document.location.href = 'myorder.php';
        </script>";
    } else{
        echo "<script>
            alert('Pesanan Gagal');
            document.location.href = 'myorder.php';
            </script>";
    }

?>