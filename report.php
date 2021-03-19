<!-- PHP -->
<!-- Menyambungkan dengan database -->
<?php
  session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:login.php?pesan=gagal");
	}

        //koneksi database
        $server = "localhost";
        $user = "root";
        $pass = "";
        $database = "db_spp";
        //menghubungkan server
        $connection = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($connection));

?>
<!-- end of PHP -->

<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- my CSS -->
    <link rel="stylesheet" href="assets/css/report.css" />

    <!-- Icon Tab -->
    <link rel="icon" href="assets/img/smkn8logo.png">

    <!-- Box Icons   -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <title>Admin Dashboard</title>
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="header_container">
        <a href="profile-setting.php" class="header_img"><img src="assets/img/admin.png" alt="admin" class="header_img" /></a>

        <a href="dashboard.php" class="header_logo">Kelola Laporan</a>

        <div class="header_toggle">
          <i class="bx bx-menu" id="header-toggle"></i>
        </div>
      </div>
    </header>

    <!-- NAV -->
    <div class="nav" id="navbar">
      <nav class="nav_container">
        <div>
          <div class="nav_list">
            <div class="nav_items">
              <h3 class="nav_subtitle">Overview</h3>

              <a href="dashboard.php" class="nav_link active">
                <i class="bx bx-home nav_icon"></i>
                <span class="nav_name">Home</span>
              </a>

              <a href="about.php" class="nav_link">
                <i class="bx bx-info-circle nav_icon"></i>
                <span class="nav_name">Tentang</span>
              </a>
            </div>
          </div>

          <div class="nav_list">
            <div class="nav_items">
              <h3 class="nav_subtitle">Administrasi</h3>

              <div class="nav_dropdown">
                <a href="#" class="nav_link">
                  <i class="bx bx-group nav_icon"></i>
                  <span class="nav_name">Petugas</span>
                  <i class="bx bx-chevron-down nav_icon nav_dropdown-icon"></i>
                </a>

                <div class="nav_dropdown-collapse">
                  <div class="nav_dropdown-content">
                    <a href="manage-petugas.php" class="nav_dropdown-items">Kelola Petugas</a>
                  </div>
                </div>
              </div>

              <div class="nav_dropdown">
                <a href="#" class="nav_link">
                  <i class="bx bx-user nav_icon"></i>
                  <span class="nav_name">Kelas</span>
                  <i class="bx bx-chevron-down nav_icon nav_dropdown-icon"></i>
                </a>

                <div class="nav_dropdown-collapse">
                  <div class="nav_dropdown-content">
                    <a href="manage-kelas.php" class="nav_dropdown-items">Kelola Kelas</a>
                    <a href="manage-siswa.php" class="nav_dropdown-items">Kelola Siswa</a>
                  </div>
                </div>
              </div>

              <div class="nav_dropdown">
                <a href="#" class="nav_link">
                  <i class="bx bx-money nav_icon"></i>
                  <span class="nav_name">SPP</span>
                  <i class="bx bx-chevron-down nav_icon nav_dropdown-icon"></i>
                </a>

                <div class="nav_dropdown-collapse">
                  <div class="nav_dropdown-content">
                    <a href="manage-spp.php" class="nav_dropdown-items">Kelola SPP</a>
                    <a href="manage-pembayaran.php" class="nav_dropdown-items">Kelola Pembayaran</a>
                  </div>
                </div>
              </div>

              <a href="report.php" class="nav_link">
                <i class="bx bx-task nav_icon"></i>
                <span class="nav_name">Laporan</span>
              </a>
            </div>
          </div>
        </div>

        <a href="logout.php" class="nav_link nav_logout">
          <i class="bx bx-log-out nav_icon"></i>
          <span class="nav_name">Log Out</span>
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <main>
      <section id="overview">
        <div class="container">
          <h1>Membuat Laporan</h1>
          <p>Ingin membuat laporan? pilih laporan tentang apa yang akan anda buat dengan meng-klik salah satu tombol dibawah ini!</p>
          


          <!-- Datas For Report -->
          <!-- Create Hidden Table -->
          <h3>Petugas</h3>
          <span>Untuk membuat laporan tentang Data Petugas, klik buat laporan</span>
          <a href="print/print-petugas.php" target="_blank" class="printReport">Print Laporan <i class='bx bx-link-external'></i></a>
          


          <!-- Datas For Report 2 -->
          <!-- Create Hidden Table -->
          <h3>Kelas</h3>
          <span>Untuk membuat laporan tentang Data Kelas, klik buat laporan</span>
           <a href="print/print-kelas.php" target="_blank" class="printReport">Print Laporan <i class='bx bx-link-external'></i></a>

          <!-- Datas For Report 3 -->
          <!-- Create Hidden Table -->
          <h3>SPP</h3>
          <span>Untuk membuat laporan tentang Data SPP, klik buat laporan</span>
          <a href="print/print-spp.php" target="_blank" class="printReport">Print Laporan <i class='bx bx-link-external'></i></a>

          <!-- Datas For Report 4 -->
          <!-- Create Hidden Table -->
          <h3>Siswa</h3>
          <span>Untuk membuat laporan tentang Data Siswa, klik buat laporan</span>
          <a href="print/print-siswa.php" target="_blank" class="printReport">Print Laporan <i class='bx bx-link-external'></i></a>

          
          <!-- Datas For Report 5-->
          <!-- Create Hidden Table -->
          <h3>Pembayaran SPP</h3>
          <span>Untuk membuat laporan tentang Data Pembayaran SPP, klik buat laporan</span>
          <a href="print/print-pembayaran.php" target="_blank" class="printReport">Print Laporan <i class='bx bx-link-external'></i></a>

        </div>
      </section>
    </main>
    <!-- end of main content -->

    <!-- my JS  -->
    <script src="assets/js/report.js"></script>
    <!-- end of my JS -->
  </body>
</html>
