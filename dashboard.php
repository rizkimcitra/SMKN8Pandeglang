<?php 
	session_start();

    // cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:login.php?pesan=gagal");
	}
     //koneksi database
        include 'config.php';
 
	?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- my CSS -->
    <link rel="stylesheet" href="assets/css/dashboard.css" />

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
        <a href="#" class="header_img"><img src="assets/img/admin.png" alt="admin" class="header_img" /></a>

        <a href="dashboard.php" class="header_logo">Dashboard</a>

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
        <div class="container_menu">
          <div class="container_row">

            <?php
            //menghitung total jumlah petugas yang tersedia
              $petugas = mysqli_query($connection, "SELECT * from petugas");
              $count    =mysqli_num_rows($petugas);
            ?>
            <div class="container_col">
              <h5 class="container_title">Total Petugas</h5>
              <h2 class="container_total"><?php echo "$count";?>+</h2>
              <p class="container_text">overview total petugas saat ini, untuk mengelola petugas, silahkan ke menu petugas menggunakan navbar atau tombol dibawah ini</p>
              <a href="manage-petugas.php" class="container_link">Kelola Petugas</a>
            </div>

            <?php
            //menghitung total jumlah siswa yang tersedia
              $siswa = mysqli_query($connection, "SELECT * from siswa");
              $count    =mysqli_num_rows($siswa);
            ?>
            <div class="container_col">
              <h5 class="container_title">Total Siswa</h5>
              <h2 class="container_total"><?php echo "$count";?>+</h2>
              <p class="container_text">overview total siswa saat ini, untuk mengelola siswa, silahkan ke menu siswa menggunakan navbar atau tombol dibawah ini</p>
              <a href="manage-siswa.php" class="container_link">Kelola Siswa</a>
            </div>


            <?php
            //menghitung total jumlah petugas yang tersedia
              $pembayaran = mysqli_query($connection, "SELECT * from pembayaran");
              $count    =mysqli_num_rows($pembayaran);
            ?>
            <div class="container_col">
              <h5 class="container_title">Pembayaran Dibuat</h5>
              <h2 class="container_total"><?php echo "$count";?>+</h2>
              <p class="container_text">overview total pembayaran yang telah dibuat, untuk mengelola pembayaran, silahkan ke menu pembayaran menggunakan navbar atau tombol dibawah ini</p>
              <a href="manage-pembayaran.php" class="container_link">Kelola Laporan</a>
            </div>
          </div>
          <div class="container_big">
          <!-- tag that contain id "greeting" -->
            <h5 class="container_big-greeting">Halo <?php echo $_SESSION['username']; ?></h5>
            <h5 class="container_big-greeting" id="greeting"></h5>
            <p class="container_big-text">
              Apa itu SPP?<br />
              menurut kamus besar Bahasa Indonesia, SPP ada beberapa singkatan yaitu antara lain Surat Persetujuan Pembayaran, Sumbangan Pembinaan Pendidikan, dan Surat Perjanjian Penerbitan. Namun jika ada hubungannya dengan pendidikan
              atau sekolah, berarti SPP itu sendiri mengambil definisi yang ke-dua dan bisa diartikan bahwa SPP adalah Sumbangan berupa dana untuk pembinaan pendidikan yang berada dalam suatu instansi pendidikan.
            </p>
          </div>
          <div class="container_sub">
            <div class="container_sub-content">
              <h2 class="sub_content-title">Biaya pembayaran SPP</h2>
              <p class="container_sub-text">Biaya pembayaran SPP sesuai dengan data tahunan, berikut adalah data biaya SPP :</p>
              <table>
                <tr class="headingtable">
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Biaya</th>
                </tr>
                <!-- looping data dari spp  -->
                <?php
                  $no = 1;
                  $sql = mysqli_query($connection,"SELECT * FROM spp");
                  while($data = mysqli_fetch_array($sql)){
                    ?>
                <tr>
                  <td><?php echo $no++; ?></td>
			            <td><?php echo $data['tahun']; ?></td>
			            <td>Rp. <?php echo $data['nominal']; ?></td>
                </tr>
                <?php 
                  }
                ?>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- end of main content -->

    <!-- my JS  -->
    <script src="assets/js/main.js"></script>
    <!-- end of my JS -->
  </body>
</html>
