<?php
    require "./functions.php";
    if(addUser($_POST) <1){
        echo "<script>
        alert('Gagal Membuat Akun');
        window.location.href='account.php';
        </script>";
    } else{
        echo "<script>
        alert('Akun Berhasil dibuat');
        window.location.href='account.php';
        </script>";
    }
?>