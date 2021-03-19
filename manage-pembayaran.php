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

        // jika tombol simpan diklik
        if(isset($_POST['save'])){


            //apakah data akan diupdate atau disimpan yang baru
            if($_GET['page'] == "edit"){

              //data akan diedit
              $edit = mysqli_query($connection, "UPDATE pembayaran SET
                                                  id_pembayaran = '$_POST[id_pembayaran]',
                                                  id_petugas = '$_POST[id_petugas]',
                                                  nisn = '$_POST[nisn]',
                                                  tgl_bayar = '$_POST[tgl_bayar]',
                                                  id_spp = '$_POST[id_spp]',
                                                  jumlah_bayar = '$_POST[jumlah_bayar]',
                                            WHERE id_pembayaran = '$_GET[id]'
                                                ");
                //jika simpan sukses
                if($edit){
                  echo "<script>
                    alert('update data sukses!');
                    document.location='manage-pembayaran.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('update data GAGAL!');
                    document.location='manage-pembayaran.php';
                  </script>";
                }
            }else{
              //data akan disimpan sebagai data yang baru
                  $save = mysqli_query($connection, "INSERT INTO pembayaran (id_pembayaran, id_petugas, nisn, tgl_bayar, id_spp, jumlah_bayar)
                          VALUES ('$_POST[id_pembayaran]',
                                  '$_POST[id_petugas]',
                                  '$_POST[nisn]',
                                  '$_POST[tgl_bayar]',
                                  '$_POST[id_spp]',
                                  '$_POST[jumlah_bayar]')");
                //jika simpan sukses
                if($save){
                  echo "<script>
                    alert('simpan data sukses!');
                    document.location='manage-pembayaran.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('simpan data gagal!');
                    document.location='manage-pembayaran.php';
                  </script>";
                }
            }
            
        }

        //jika tombol edit atau hapus diklik
        if(isset($_GET['page'])){
        //jika url berubah menjadi page=edit
          if($_GET['page'] == "edit"){
            //menampilkan data yang akan diupdate
            $tampil = mysqli_query($connection, "SELECT * FROM pembayaran WHERE id_pembayaran = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka akan ditampung kedalam variable
                //varaible berisikan sesuai dengan field yang dipilih
                $vidpembayaran = $data['id_pembayaran'];
                $vidpetugas = $data['id_petugas'];
                $vnisn = $data['nisn'];
                $vtglbayar = $data['tgl_bayar'];
                $vidspp = $data['id_spp'];
                $vjumlahbayar = $data['jumlah_bayar'];
            }
          }
          else if($_GET['page'] == "delete")
          {
            //menghapus data yang dipilih
            $delete = mysqli_query($connection, "DELETE FROM pembayaran WHERE id_pembayaran = '$_GET[id]' ");
            if($delete){
              echo "<script>
                    alert('data sukses dihapus!');
                    document.location='manage-pembayaran.php';
                  </script>";
            }else{
              echo "<script>
                    alert('data gagal dihapus!');
                    document.location='manage-pembayaran.php';
                  </script>";
            }
          }
        }

  ?>
<!-- end of PHP -->
<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/manage-pembayaran.css" />

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

        <a href="manage-spp.php" class="header_logo">Kelola Pembayaran SPP</a>

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
                <a href="#" class="nav_link active">
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

    <!-- main content -->
    <main>
      <section id="overview">
        <div class="container_table">
          <div class="table_spp">
            <h2 class="formHeader">Data Pembayaran SPP yang tersedia</h2>
            <p  style="margin:0;">untuk menambahkan data Pembayaran SPP, anda harus terlebih dahulu mengisi Data Kelas, Data Siswa, dan Data SPP, ketika anda ingin menambahkan Data Pembayaran SPP, input NISN Siswa, Id SPP, dan Id Kelas harus sama dengan yang tersedia di menu Kelola Siswa, Kelola SPP, dan menu Kelola Kelas</p>
            <button class="show_table" onclick="showTable()">Tampilkan Data</button>
            <button class="show_table" onclick="window.location.reload();">Refresh Data</button>
            <div id="hiddenTable">
              <table class="stylingTable">
                <tr>
                  <th>No.</th>
                  <th>Id pembayaran</th>
                  <th>Id Petugas</th>
                  <th>NISN Siswa</th>
                  <th>Tanggal Bayar</th>
                  <th>Id SPP</th>
                  <th>Jumlah Bayar</th>
                  <th colspan="2">Action</th>
                </tr>

                <!-- Create Loop in the table -->
                <?php
                // menampilkan data dari database
                  $no = 1;
                  $tampil = mysqli_query($connection, "SELECT * FROM pembayaran order by id_pembayaran asc");
                  while ($data = mysqli_fetch_array($tampil)) :
                
                ?>
                <!-- Table that got looped -->

                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data['id_pembayaran']?></td>
                    <td><?=$data['id_petugas']?></td>
                    <td><?=$data['nisn']?></td>
                    <td><?=$data['tgl_bayar']?></td>
                    <td><?=$data['id_spp']?></td>
                    <td><?=$data['jumlah_bayar']?></td>
                  <td>
                    <a href="manage-pembayaran.php?page=edit&id=<?=$data['id_pembayaran']?>" class="btn_update"><i class="bx bx-pencil btn_icon"></i>Update</a>
                  </td>
                  <td>
                    <a href="manage-pembayaran.php?page=delete&id=<?=$data['id_pembayaran']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?, Harap dicatat data yang dipilih akan kembali jika data mempunyai bentuk fisik dan dapat di input ulang oleh admin pengelola web!')" class="btn_delete"><i class="bx bx-trash-alt btn_icon"></i>Delete</a>
                  </td>
                </tr>
                <?php endwhile; //end the loop here ?>
              </table>
            </div>
          </div>

          <!-- Styling Create & Update datas -->
          <div class="table_lr">
          <div class="table_edit">
            <form method="POST" action="" class="formStyle" id="formId">
              <h2 class="formHeader">Edit atau buat Tiket Pembayaran SPP</h2>

              <label for="id_pembayaran">ID Pembayaran</label>
              <input type="text" name="id_pembayaran" value="<?=@$vidspp?>" id="id_pembayaran" class="inputStyle" placeholder="Masukkan Id Pembayaran" required>

              <label for="id_petugas">ID Petugas</label>
              <input type="text" name="id_petugas" value="<?=@$vidpetugas?>" id="id_petugas" class="inputStyle" placeholder="Masukkan Id Petugas" required>

              <label for="nisn">NISN Siswa</label>
              <input type="text" name="nisn" id="nisn" value="<?=@$vnisn?>" class="inputStyle" placeholder="Masukkan NISN Siswa" required>

              <label for="tgl_bayar">Tanggal dibuatnya Tiket Pembayaran SPP</label>
              <input type="date" name="tgl_bayar" value="<?=@$vtglbayar?>" id="tgl_bayar" class="inputStyle" required>

              <label for="id_spp">ID SPP</label>
              <input type="text" name="id_spp" value="<?=@$vidspp?>" id="id_spp" class="inputStyle" placeholder="Masukan ID SPP" required>

              <label for="jumlah_bayar">Jumlah Bayar</label>
              <input type="text" name="jumlah_bayar" value="<?=@$vjumlahbayar?>" id="jumlah_bayar" class="inputStyle" placeholder="Masukkan Jumlah Bayar" required>

                <button type="submit" name="save" class="btn_submit">Save</button>
                <button type="reset" class="btn_cancel">Cancel</button>
                <span>Harap jangan menambahkan simbol seperti .(titik) ,(koma) atau yang lainnya pada form jumlah bayar</span>
              </div>
              
            </form>
          </div>
          

        </div>
      </section>
    </main>
    <!-- end of main content -->

    <!-- My JS -->
    <script src="assets/js/main.js"></script>
    <!-- end of my js -->
  </body>
</html>
