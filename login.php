<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- my CSS -->
    <link rel="stylesheet" href="assets/css/login.css" />

    <!-- Icon Tab -->
    <link rel="icon" href="assets/img/smkn8logo.png">
    
    <!-- Box Icons   -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <title>Admin Login</title>
  </head>
  <body>
    <main>
      <section id="container">
        <!-- make header -->
        <div class="header">
          <img src="assets/img/smkn8logo.png" alt="SMKN8Pandeglang" width="120" />
          <h2>SMKN 8 Pandeglang</h2>
          <p>Login untuk mengelola Sumbangan Pembinaan Pendidikan!</p>
        </div>
        <!-- make a form -->
        <div class="formStyling">
          <form action="auth.php" method="POST">
            <div class="stylingInput">
              <i class="bx bxs-user"></i>
              <input type="text" name="username" id="username" placeholder="username" required class="inputForm" />
            </div>
            <div class="stylingInput">
              <i class="bx bxs-lock-alt"></i>
              <input type="password" name="password" id="password" placeholder="password" required class="inputForm" />
            </div>
            <input type="checkbox" name="checkbox" onclick="showPassword()" />show password
            <div class="foot">
              <button type="submit" name="login">login</button>
              <a href="#">forgot password?</a>
            </div>
          </form>
        </div>
      </section>
    </main>

    <!-- My JS  -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
