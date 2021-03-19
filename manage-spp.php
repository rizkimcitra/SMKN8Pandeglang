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
              $edit = mysqli_query($connection, "UPDATE spp SET
                                                  id_spp = '$_POST[id_spp]',
                                                  tahun = '$_POST[tahun_spp]',
                                                  nominal = '$_POST[nominal_spp]'
                                            WHERE id_spp = '$_GET[id]'
                                                ");
                //jika simpan sukses
                if($edit){
                  echo "<script>
                    alert('update data sukses!');
                    document.location='manage-spp.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('update data GAGAL!');
                    document.location='manage-spp.php';
                  </script>";
                }
            }else{
              //data akan disimpan sebagai data yang baru
                  $save = mysqli_query($connection, "INSERT INTO spp (id_spp, tahun, nominal)
                          VALUES ('$_POST[id_spp]',
                                  '$_POST[tahun_spp]',
                                  '$_POST[nominal_spp]')");
                //jika simpan sukses
                if($save){
                  echo "<script>
                    alert('simpan data sukses!');
                    document.location='manage-spp.php';
                  </script>";
                }else{
                    echo "<script>
                    alert('simpan data gagal!');
                    document.location='manage-spp.php';
                  </script>";
                }
            }
            
        }

        //jika tombol edit atau hapus diklik
        if(isset($_GET['page'])){
        //jika url berubah menjadi page=edit
          if($_GET['page'] == "edit"){
            //menampilkan data yang akan diupdate
            $tampil = mysqli_query($connection, "SELECT * FROM spp WHERE id_spp = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka akan ditampung kedalam variable
                //varaible berisikan sesuai dengan field yang dipilih
                $vidspp = $data['id_spp'];
                $vthnspp = $data['tahun'];
                $vnominalspp = $data['nominal'];
            }
          }
          else if($_GET['page'] == "delete")
          {
            //menghapus data yang dipilih
            $delete = mysqli_query($connection, "DELETE FROM spp WHERE id_spp = '$_GET[id]' ");
            if($delete){
              echo "<script>
                    alert('data sukses dihapus!');
                    document.location='manage-spp.php';
                  </script>";
            }else{
              echo "<script>
                    alert('data gagal dihapus!');
                    document.location='manage-spp.php';
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
    <link rel="stylesheet" href="assets/css/manage-spp.css" />

    <!-- Icon Tab -->
    <link rel="icon" href="assets/img/smkn8logo.png">

    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="header_container">
        <a href="profile-setting.html" class="header_img"><img src="assets/img/admin.png" alt="admin" class="header_img" /></a>

        <a href="manage-spp.php" class="header_logo">Kelola SPP</a>

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
            <h2 class="formHeader">Data SPP yang tersedia</h2>
            <button class="show_table" onclick="showTable()">Tampilkan Data</button>
            <button class="show_table" onclick="window.location.reload();">Refresh Data</button>
            <div id="hiddenTable">
              <table class="stylingTable">
                <tr>
                  <th>No.</th>
                  <th>id</th>
                  <th>tahun</th>
                  <th>nominal</th>
                  <th colspan="2">Action</th>
                </tr>

                <!-- Create Loop in the table -->
                <?php
                // menampilkan data dari database
                  $no = 1;
                  $tampil = mysqli_query($connection, "SELECT * FROM spp order by id_spp asc");
                  while ($data = mysqli_fetch_array($tampil)) :
                
                ?>
                <!-- Table that got looped -->
                <tr>
                   <td><?=$no++?></td>
                  <td><?=$data['id_spp']?></td>
                  <td><?=$data['tahun']?></td>
                  <td><?=$data['nominal']?></td>
                  <td>
                    <a href="manage-spp.php?page=edit&id=<?=$data['id_spp']?>" class="btn_update"><i class="bx bx-pencil btn_icon"></i>Update</a>
                  </td>
                  <td>
                    <a href="manage-spp.php?page=delete&id=<?=$data['id_spp']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?, Harap dicatat data yang dipilih akan kembali jika data mempunyai bentuk fisik dan dapat di input ulang oleh admin pengelola web!')" class="btn_delete"><i class="bx bx-trash-alt btn_icon"></i>Delete</a>
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
              <h2 class="formHeader">Edit atau buat daftar SPP</h2>

              <label for="id_spp">ID SPP</label>
              <input type="text" name="id_spp" id="id_spp" value="<?=@$vidspp?>" class="inputStyle" placeholder="Masukkan ID SPP" >

              <label for="tahun_spp">Tanggal dibuatnya SPP</label>
              <select name="tahun_spp" id="tahun_spp" class="inputStyle" required>
                <option value="<?=@$vthnspp?>"><?=@$vthnspp?></option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
              </select>

              <label for="nominal_spp">Nominal SPP</label>
              <input type="text" name="nominal_spp" id="nominal_spp" value="<?=@$vnominalspp?>" class="inputStyle" placeholder="Masukkan nominal" >
                <button type="submit" name="save" class="btn_submit">Save</button>
                <button type="reset" class="btn_cancel">Cancel</button>
                <span>Harap jangan menambahkan simbol seperti .(titik) ,(koma) atau yang lainnya pada form nominal</span>
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
