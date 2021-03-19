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

        // jika tombol simpan diklik
        if(isset($_POST['save'])){


            //apakah data akan diupdate atau disimpan yang baru
            if($_GET['page'] == "edit"){

              //data akan diedit
              $edit = mysqli_query($connection, "UPDATE petugas SET
                                                  id_petugas = '$_POST[id_petugas]',
                                                  nama = '$_POST[nama_petugas]',
                                                  username = '$_POST[username_petugas]',
                                                  password = '$_POST[password_petugas]',
                                                  no_telepon = '$_POST[phonenum_petugas]',
                                                  level = '$_POST[level]'
                                                WHERE id_petugas = '$_GET[id]'
                                                ");
                //jika simpan sukses
                if($edit){
                  echo "<script>
                    alert('update data sukses!');
                    document.location='manage-petugas.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('update data GAGAL!');
                    document.location='manage-petugas.php';
                  </script>";
                }
            }else{
              //data akan disimpan sebagai data yang baru
                  $save = mysqli_query($connection, "INSERT INTO petugas (id_petugas, nama, username, password, no_telepon, level) VALUES ('$_POST[id_petugas]',
                                  '$_POST[nama_petugas]',
                                  '$_POST[username_petugas]',
                                  '$_POST[password_petugas]',
                                  '$_POST[phonenum_petugas]',
                                  '$_POST[level]')");
                //jika simpan sukses
                if($save){
                  echo "<script>
                    alert('simpan data sukses!');
                    document.location='manage-petugas.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('simpan data gagal!');
                    document.location='manage-petugas.php';
                  </script>";
                }
            }
            
        }

        //jika tombol edit atau hapus diklik
        if(isset($_GET['page'])){
        //jika url berubah menjadi page=edit
          if($_GET['page'] == "edit"){
            //menampilkan data yang akan diupdate
            $tampil = mysqli_query($connection, "SELECT * FROM petugas WHERE id_petugas = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka akan ditampung kedalam variable
                //varaible berisikan sesuai dengan field yang dipilih
                $vid = $data['id_petugas'];
                $vnama = $data['nama'];
                $vuname = $data['username'];
                $vpass = $data['password'];
                $vphone = $data['no_telepon'];
                $vlevel = $data['level'];
            }
          }
          else if($_GET['page'] == "delete")
          {
            //menghapus data yang dipilih
            $delete = mysqli_query($connection, "DELETE FROM petugas WHERE id_petugas = '$_GET[id]' ");
            if($delete){
              echo "<script>
                    alert('data sukses dihapus!');
                    document.location='manage-petugas.php';
                  </script>";
            }else{
              echo "<script>
                    alert('data gagal dihapus!');
                    document.location='manage-petugas.php';
                  </script>";
            }
          }
        }

  ?>


<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/manage-petugas.css" />

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

        <a href="manage-petugas.php" class="header_logo">Kelola Petugas</a>

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
                <a href="#" class="nav_link active">
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
            <h2 class="formHeader">Data Petugas yang tersedia</h2>
            <p>untuk menambahkan petugas, cukup inputkan data baru pada form dibawah, jika ingin memperbarui data, klik tombol tampilkan data, lalu klik ubah dan kemudian otomatis form akan terisi dengan data sebelumnya yang nantinya dapat diperbarui oleh user</p>
            <button class="show_table" onclick="showTable()">Tampilkan Data</button>
            <button class="show_table" onclick="window.location.reload();">Refresh Data</button>
            <div id="hiddenTable">
            <!-- Styling the table -->
              <table class="stylingTable">
                <tr>
                <!-- Table Header -->
                  <th>No.</th>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Phone Number</th>
                  <th>Level</th>
                  <th colspan="2">action</th>
                </tr>

                <!-- create loop with php to create another field on table -->
                <?php
                // menampilkan data dari database
                  $no = 1;
                  $tampil = mysqli_query($connection, "SELECT * from petugas order by id_petugas asc");
                  while ($data = mysqli_fetch_array($tampil)) :
                
                ?>

                <!-- table that got looped -->
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$data['id_petugas']?></td>
                  <td><?=$data['nama']?></td>
                  <td><?=$data['username']?></td>
                  <td><?=$data['password']?></td>
                  <td><?=$data['no_telepon']?></td>
                  <td><?=$data['level']?></td>
                  <td>
                    <a href="manage-petugas.php?page=edit&id=<?=$data['id_petugas']?>" class="btn_update"><i class="bx bx-pencil btn_icon"></i>Update</a></td>
                  <td>
                    <a href="manage-petugas.php?page=delete&id=<?=$data['id_petugas']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?, Harap dicatat data yang dipilih akan kembali jika data mempunyai bentuk fisik dan dapat di input ulang oleh admin pengelola web!')" class="btn_delete"><i class="bx bx-trash-alt btn_icon"></i>Delete</a>
                  </td>
                </tr>
                <?php endwhile; //penutup perulangan while ?>
              </table>
            </div>
          </div>

          <!-- Styling Create & Update form -->
          <div class="table_lr">
          <div class="table_edit">
          <!-- FORM -->
            <form method="POST" action="" class="formStyle" id="formId">
            <!-- create header for form -->
              <h2 class="formHeader">Edit atau tambahkan Petugas</h2>
              
              <!-- overall Input data -->
              <label for="id_petugas">Id Petugas</label>
              <input type="text" name="id_petugas" value="<?=@$vid?>" class="inputStyle" placeholder="Masukkan Id Petugas" required>

              <label for="nama_petugas">Nama Petugas</label>
              <input type="text" name="nama_petugas" value="<?=@$vnama?>" class="inputStyle" placeholder="Masukkan Nama Petugas" required>

              <label for="username_petugas">Username Petugas</label>
              <input type="text" name="username_petugas" value="<?=@$vuname?>" class="inputStyle" placeholder="Masukkan Username Petugas" required>

              <label for="password_petugas">Password Petugas</label>
              <input type="password" name="password_petugas" value="<?=@$vpass?>" class="inputStyle" placeholder="Masukkan Password" id="password" required>

              <label for="phonenum_petugas">No. Telepon</label>
              <input type="text" name="phonenum_petugas" value="<?=@$vphone?>" class="inputStyle" placeholder="Masukkan No.Telepon Petugas" required>
             
              <!-- make a custom selection -->
              <label for="level">Level Petugas</label>
              <select name="level" id="levelPetugas" required>
                <option value="<?=@$vlevel?>"><?=@$vlevel?></option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
              </select>
              <input type="checkbox" name="chekbox" onclick="showPassword()" id="togglePassword">Show Password
              
              <div class="button_area">
                <button type="submit" name="save" class="btn_submit">Save</button>
                <button type="reset" name="cancel_data" class="btn_cancel">Cancel</button>
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
