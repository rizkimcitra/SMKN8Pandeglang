<!-- Menyambungkan dengan database -->
  <?php
  session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:login.php?pesan=gagal");
	}
  include 'config.php';

  ?>
<!-- end of PHP -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/about.css" />

    <!-- Icon Tab -->
    <link rel="icon" href="assets/img/smkn8logo.png">

    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="header_container">
        <a href="#" class="header_img"><img src="assets/img/admin.png" alt="admin" class="header_img" /></a>

        <a href="about.php" class="header_logo">Tentang</a>

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

              <a href="dashboard.php" class="nav_link">
                <i class="bx bx-home nav_icon"></i>
                <span class="nav_name">Home</span>
              </a>

              <a href="about.php" class="nav_link active">
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

          <div class="title">
            <img src="assets/img/smkn8logo.png" width="150" alt="SMKN 8 Pandeglang Logo">
            <h1>SMKN 8 Pandeglang</h1>
          </div>
          
          <div class="content">
            <p>SMKN 8 Pandeglang adalah Sekolah Menengah Kejuruan Nasional yang terakreditasi B, Didirikan pada tanggal 2 Februari 2009, dibawah naungan Kementrian Pendidikan dan Kebudayaan, Berlokasi di Jl. Raya Pandeglang - Pari KM.14 Mandalawangi.</p>
          <p>untuk info lebih lanjut, klik tombol dibawah ini</p>
          <button onclick="showTable()" id="toggle_btn">Lihat Detail</button>
          <div id="hiddenTable">
              <table class="stylingTable">
                <tr>
                  <th>Nama.</th>
                  <td>SMKN 8 Pandeglang</td>
                </tr>
                <tr>
                  <th>NPSN</th>
                  <td>20614396</td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td>Jl. Raya Pandeglang - Pari KM.14 Mandalawangi</td>
                </tr>
                <tr>
                  <th>Kode POS</th>
                  <td>42261</td>
                </tr>
                <tr>
                  <th>Desa/Kelurahan</th>
                  <td>Cikoneng</td>
                </tr>
                <tr>
                  <th>Kecamatan/Kota</th>
                  <td>Kec. Mandalawangi</td>
                </tr>
                <tr>
                  <th>Kab./Kota</th>
                  <td>Kab. Pandeglang</td>
                </tr>
                <tr>
                  <th>Provinsi</th>
                  <td>Banten</td>
                </tr>
                <tr>
                  <th>Status Sekolah</th>
                  <td>Negeri</td>
                </tr>
                <tr>
                  <th>Jenjang Pendidikann</th>
                  <td>SMK</td>
                </tr>
                <tr>
                  <td colspan="2"><a class="ref_link" href="https://referensi.data.kemdikbud.go.id/tabs.php?npsn=20614396" target="_blank">Sumber <i class='bx bx-link-external'></i></a></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- end of main content  -->

    <!-- My JS -->
    <script src="assets/js/main.js"></script>
    <!-- End of My JS -->
  </body>
</html>
