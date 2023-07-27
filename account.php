<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon Website" href="./img/nachos.png?v=<?php echo time(); ?>">
    <title>SEOKE ID</title>
    <script src="https://kit.fontawesome.com/e12c34da31.js"></script>
    <link rel="stylesheet" href="./css/account_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css">
</head>
<body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
            <form action="./signin.php" class="sign-in-form" method="post">
              <a href="index.php"><i class="fas fa-home"></i></a>
              <h2 class="title">Sign In</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Email/ Username" name="user"/>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name="password"/>
              </div>
              <p id="error"></p>
              <input type="submit" value="Login" class="btn solid"/>
          </form>


          <form action="./signup.php" class="sign-up-form" method="post">
            <a href="index.php"><i class="fas fa-home"></i></a>
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama Depan" name="fname"/>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama Belakang" name="lname"/>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <input type="submit" value="Sign Up" class="btn solid" />

          </form>
        </div>
      </div>
      <div class="panels-container">

        <div class="panel left-panel">
            <div class="content">
                <img src="img/home/logo.png" class="image" alt=""><br><br>
                <h3>Buat Akun</h3><br>
                <p>Jadikan SEOKE ID teman nyemil kamu</p><br>
                <button class="btn transparent" id="sign-up-btn">Sign Up</button>
            </div>
        </div>

        <div class="panel right-panel">
            <div class="content">
                <img src="img/home/logo.png" class="image" alt=""><br><br>
                <h3>Sudah Memiliki Akun?</h3><br>
                <p>Login dengan akun Anda disini!</p><br>
                <button class="btn transparent" id="sign-in-btn">Sign In</button>
            </div>
        </div>
      </div>
    </div>

    <script src="./js/account.js"></script>
  </body>
</html>