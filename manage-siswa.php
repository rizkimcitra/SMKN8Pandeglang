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
              $edit = mysqli_query($connection, "UPDATE siswa SET
                                                  nisn = '$_POST[nisn_siswa]',
                                                  nis = '$_POST[nis_siswa]',
                                                  nama = '$_POST[nama_siswa]',
                                                  id_kelas = '$_POST[id_kelas]',
                                                  alamat = '$_POST[alamat_siswa]',
                                                  no_telepon = '$_POST[no_telp_siswa]',
                                                  id_spp = '$_POST[id_spp]',
                                                  level = '$_POST[level_siswa]',
                                                  password = '$_POST[password_siswa]'
                                            WHERE nisn = '$_GET[id]'
                                                ");
                //jika simpan sukses
                if($edit){
                  echo "<script>
                    alert('update data sukses!');
                    document.location='manage-siswa.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('update data GAGAL!');
                    document.location='manage-siswa.php';
                  </script>";
                }
            }else{
              //data akan disimpan sebagai data yang baru
                  $save = mysqli_query($connection, "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telepon, id_spp, level, password)
                          VALUES ('$_POST[nisn_siswa]',
                                  '$_POST[nis_siswa]',
                                  '$_POST[nama_siswa]',
                                  '$_POST[id_kelas]',
                                  '$_POST[alamat_siswa]',
                                  '$_POST[no_telp_siswa]',
                                  '$_POST[id_spp]',
                                  '$_POST[level_siswa]',
                                  '$_POST[password_siswa]')");
                //jika simpan sukses
                if($save){
                  echo "<script>
                    alert('simpan data sukses!');
                    document.location='manage-siswa.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('simpan data gagal!');
                    document.location='manage-siswa.php';
                  </script>";
                }
            }
            
        }

        //jika tombol edit atau hapus diklik
        if(isset($_GET['page'])){
        //jika url berubah menjadi page=edit
          if($_GET['page'] == "edit"){
            //menampilkan data yang akan diupdate
            $tampil = mysqli_query($connection, "SELECT * FROM siswa WHERE nisn = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka akan ditampung kedalam variable
                //varaible berisikan sesuai dengan field yang dipilih
                $vnisn = $data['nisn'];
                $vnis = $data['nis'];
                $vnama = $data['nama'];
                $vidkls = $data['id_kelas'];
                $valamat = $data['alamat'];
                $vphone = $data['no_telepon'];
                $vidspp = $data['id_spp'];
                $vlevel = $data['level'];
                $vpass = $data['password'];
            }
          }
          else if($_GET['page'] == "delete")
          {
            //menghapus data yang dipilih
            $delete = mysqli_query($connection, "DELETE FROM siswa WHERE nisn = '$_GET[id]' ");
            if($delete){
              echo "<script>
                    alert('data sukses dihapus!');
                    document.location='manage-siswa.php';
                  </script>";
            }else{
              echo "<script>
                    alert('data gagal dihapus!');
                    document.location='manage-siswa.php';
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
    <link rel="stylesheet" href="assets/css/manage-siswa.css" />

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

        <a href="manage-siswa.php" class="header_logo">Kelola Siswa</a>

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
            <h2 class="formHeader">Data Siswa yang tersedia</h2>
            <p  style="margin:0;">untuk menambahkan data Siswa, anda harus terlebih dahulu mengisi data kelas dan spp, ketika anda ingin menambahkan data siswa, input Id SPP dan Id Kelas harus sama dengan yang tersedia di menu Kelola SPP dan menu Kelola Kelas</p>

            <button class="show_table" onclick="showTable()" id="toggle_btn">Tampilkan Data</button>
            <button class="show_table" onclick="window.location.reload();">Refresh Data</button>
            <div id="hiddenTable">
              <table class="stylingTable">
                <tr>
                  <th>No.</th>
                  <th>NISN</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Id Kelas</th>
                  <th>Alamat</th>
                  <th>No. Telepon</th>
                  <th>Id SPP</th>
                  <th>Level</th>
                  <th>Password</th>
                  <th colspan="2">Action</th>
                </tr>

                <!-- create loop with php to create another field on table -->
                <?php
                // menampilkan data dari database
                  $no = 1;
                  $tampil = mysqli_query($connection, "SELECT * FROM siswa order by nisn asc");
                  while ($data = mysqli_fetch_array($tampil)) :
                
                ?>

                <!-- table that got looped -->
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$data['nisn']?></td>
                  <td><?=$data['nis']?></td>
                  <td><?=$data['nama']?></td>
                  <td><?=$data['id_kelas']?></td>
                  <td><?=$data['alamat']?></td>
                  <td><?=$data['no_telepon']?></td>
                  <td><?=$data['id_spp']?></td>
                  <td><?=$data['level']?></td>
                  <td><?=$data['password']?></td>
                  <td>
                    <a href="manage-siswa.php?page=edit&id=<?=$data['nisn']?>" class="btn_update"><i class="bx bx-pencil btn_icon"></i>Update</a>
                  </td>
                  <td>
                    <a href="manage-siswa.php?page=delete&id=<?=$data['nisn']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?, Harap dicatat data yang dipilih akan kembali jika data mempunyai bentuk fisik dan dapat di input ulang oleh admin pengelola web!')" class="btn_delete"><i class="bx bx-trash-alt btn_icon"></i>Delete</a>
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
              <h2 class="formHeader">Edit atau tambahkan Siswa</h2>
              <!-- ALL INPUT -->
              <label for="nisn_siswa">No. NISN</label>
              <input type="number" name="nisn_siswa" value="<?=@$vnisn?>" class="inputStyle" placeholder="Masukkan NISN Siswa">

              <label for="nis_siswa">No. NIS</label>
              <input type="number" name="nis_siswa" value="<?=@$vnis?>" class="inputStyle" placeholder="Masukkan NIS Siswa">

              <label for="nama_siswa">Nama Siswa</label>
              <input type="text" name="nama_siswa" value="<?=@$vnama?>" class="inputStyle" placeholder="Masukkan Nama Siswa">

              <label for="id_kelas">ID Kelas</label>
              <input type="number" name="id_kelas" value="<?=@$vidkls?>" class="inputStyle" placeholder="Masukkan Id Kelas Siswa">

              <label for="alamat_siswa">Alamat Siswa</label>
              <input type="text" name="alamat_siswa" value="<?=@$valamat?>" class="inputStyle" placeholder="Masukkan Alamat Siswa">

              <label for="no_telp_siswa">No. Telepon Siswa</label>
              <input type="number" name="no_telp_siswa" value="<?=@$vphone?>" class="inputStyle" placeholder="Masukkan No.Telepon Siswa">

              <label for="id_spp">ID SPP</label>
              <input type="number" name="id_spp" value="<?=@$vidspp?>" class="inputStyle" placeholder="Masukkan Id SPP Siswa">
              <!-- Crete Custom Select -->
              <label for="level_siswa">Level Siswa</label>
              <select name="level_siswa" id="level_siswa" class="inputStyle" required>
                <option value="<?=@$vlevel?>"><?=@$vlevel?></option>
                <option value="siswa">Siswa</option>
              </select>

              <label for="password_siswa">Password Siswa</label>
              <input type="password" name="password_siswa" value="<?=@$vpass?>" class="inputStyle" placeholder="Password" id="password">
              <!-- Showing Password using JavaScript -->
              <input type="checkbox" name="chekbox" onclick="showPassword()" id="togglePassword">Show Password

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
