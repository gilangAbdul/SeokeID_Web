<?php
    session_start();
    require "./functions.php";
    if($_POST['user']=="" || $_POST['password'] ==""){
        echo "<script>
            alert('Harap Memasukkan Email dan Password');
            window.location.href='account.php';
            </script>";
    }
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $user = query("SELECT * FROM user WHERE (username = '$user' OR email='$user') AND password='$pass'");
    
    if(!empty($user)){
        $_SESSION['id_user'] = $user[0]['id'];
        $_SESSION['if_admin'] = $user[0]['if_admin'];
        $_SESSION['fname'] = $user[0]['Fname'];
        
        $admin = $user[0]['if_admin'];
        if($admin == 1){
            header('Location: admin.php');
        } else{
            header('Location: index.php');
        }
    }
    echo "<script>
        alert('Email atau Password Salah');
        document.location.href='account.php';
    </script>";
    ?>