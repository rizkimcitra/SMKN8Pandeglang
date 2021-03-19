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
              $edit = mysqli_query($connection, "UPDATE kelas SET
                                                  id_kelas = '$_POST[id_kelas]',
                                                  nama_kelas = '$_POST[nama_kelas]',
                                                  kompetensi_keahlian = '$_POST[kompetensi_keahlian]'
                                            WHERE id_kelas = '$_GET[id]'
                                                ");
                //jika simpan sukses
                if($edit){
                  echo "<script>
                    alert('update data sukses!');
                    document.location='manage-kelas.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('update data GAGAL!');
                    document.location='manage-kelas.php';
                  </script>";
                }
            }else{
              //data akan disimpan sebagai data yang baru
                  $save = mysqli_query($connection, "INSERT INTO kelas (id_kelas, nama_kelas, kompetensi_keahlian)
                          VALUES ('$_POST[id_kelas]',
                                  '$_POST[nama_kelas]',
                                  '$_POST[kompetensi_keahlian]')");
                //jika simpan sukses
                if($save){
                  echo "<script>
                    alert('simpan data sukses!');
                    document.location='manage-kelas.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('simpan data gagal!');
                    document.location='manage-kelas.php';
                  </script>";
                }
            }
            
        }

        //jika tombol edit atau hapus diklik
        if(isset($_GET['page'])){
        //jika url berubah menjadi page=edit
          if($_GET['page'] == "edit"){
            //menampilkan data yang akan diupdate
            $tampil = mysqli_query($connection, "SELECT * FROM kelas WHERE id_kelas = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka akan ditampung kedalam variable
                //varaible berisikan sesuai dengan field yang dipilih
                $vid = $data['id_kelas'];
                $vnama = $data['nama_kelas'];
                $vjurusan = $data['kompetensi_keahlian'];
            }
          }
          else if($_GET['page'] == "delete")
          {
            //menghapus data yang dipilih
            $delete = mysqli_query($connection, "DELETE FROM kelas WHERE id_kelas = '$_GET[id]' ");
            if($delete){
              echo "<script>
                    alert('data sukses dihapus!');
                    document.location='manage-kelas.php';
                  </script>";
            }else{
              echo "<script>
                    alert('data gagal dihapus!');
                    document.location='manage-kelas.php';
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
    <link rel="stylesheet" href="assets/css/manage-kelas.css" />

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

        <a href="manage-kelas.php" class="header_logo">Kelola Kelas</a>

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
        <div class="container_table">
          <div class="table_petugas">
            <h2 class="formHeader">Data Kelas yang tersedia</h2>
            <p  style="margin:0;">untuk menambahkan Data Kelas, cukup inputkan data baru pada form dibawah, jika ingin memperbarui data, klik tombol tampilkan data, lalu klik ubah dan kemudian otomatis form akan terisi dengan data sebelumnya yang nantinya dapat diperbarui oleh user</p>
            <button class="show_table" onclick="showTable()" id="toggle_btn">Tampilkan Data</button>
            <button class="show_table" onclick="window.location.reload();">Refresh Data</button>
            <div id="hiddenTable">
              <table class="stylingTable">
                <tr>
                  <th>No.</th>
                  <th>ID Kelas</th>
                  <th>Nama Kelas</th>
                  <th>Kompetensi Keahlian</th>
                  <th colspan="2">Action</th>
                </tr>

                <!-- create loop with php to create another field on table -->
                <?php
                // menampilkan data dari database
                  $no = 1;
                  $tampil = mysqli_query($connection, "SELECT * from kelas order by id_kelas asc");
                  while ($data = mysqli_fetch_array($tampil)) :
                
                ?>

                <!-- table that got looped -->
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$data['id_kelas']?></td>
                  <td><?=$data['nama_kelas']?></td>
                  <td><?=$data['kompetensi_keahlian']?></td>
                  <td>
                    <a href="manage-kelas.php?page=edit&id=<?=$data['id_kelas']?>" class="btn_update"><i class="bx bx-pencil btn_icon"></i>Update</a>
                  </td>
                  <td>
                    <a href="manage-kelas.php?page=delete&id=<?=$data['id_kelas']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?, Harap dicatat data yang dipilih akan kembali jika data mempunyai bentuk fisik dan dapat di input ulang oleh admin pengelola web!')" class="btn_delete"><i class="bx bx-trash-alt btn_icon"></i>Delete</a>
                  </td>
                </tr>
                <?php endwhile; //penutup perulangan while ?>
              </table>
            </div>
          </div>

          <!-- Styling Create & Update datas -->
          <div class="table_lr">
          <div class="table_edit">
            <form  method="POST" action="" class="formStyle" id="formId">
              <h2 class="formHeader">Edit atau tambahkan Data Kelas</h2>

              <!-- Overall input data kelas -->
              <label for="id_kelas">ID Kelas</label>
              <input type="text" name="id_kelas" value="<?=@$vid?>" class="inputStyle" id="id_kelas" placeholder="Masukkan Id Kelas" required>

              <label for="nama_kelas">Nama Kelas</label>
              <select name="nama_kelas" id="nama_kelas" required>
                <option value="<?=@$vnama?>"><?=@$vnama?></option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>

              <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
              <select name="kompetensi_keahlian" id="kompetensi_keahlian" required>
                <option value="<?=@$vjurusan?>"><?=@$vjurusan?></option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Akuntansi">Akuntansi</option>
                <option value="Teknik dan Bisnis Sepeda Motor">Teknik dan Bisnis Sepeda Motor</option>
                <option value="Teknik Instalasi Tenaga Listrik">Teknik Instalasi Tenaga Listrik</option>
              </select>
              <div class="button_area">
                <button type="submit" name="save" class="btn_submit">Save</button>
                <button type="reset" class="btn_cancel">Cancel</button>
              </div>
            </form>
          </div>
          

        </div>
      </section>
    </main>
    <!-- End of Main Content -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <!-- end of main JS  -->
  </body>
</html>