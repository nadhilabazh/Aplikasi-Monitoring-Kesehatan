<?php
$title = "Halaman Utama";
//pemanggilan file metatag
include "setting_metatag.php";
//pemanggilan file navbar
include "setting_navbar.php";
$databaseHost = 'localhost';
$databaseName = 'uas';
$databaseUsername = 'root';
$databasePassword = '';

                                    $db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
                                    $sql1 = "select*from pegawai where id='$_SESSION[id]'";
                                    $query1 = mysqli_query($db, $sql1);
                                    $jumlah10 = mysqli_num_rows($query1);
                                    if($jumlah10 == 0){
                                        echo "<script>alert('Lengkapi Data Terlebih Dahulu');document.location='tambah_pegawai.php'</script>";
                                    }

?>
<script src="<?php echo $hostname; ?>/assets/js/chart.js"></script>
<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">

                <!--konten pilihan start-->
                
            </div>
        </div>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Change Password</title>
  </head>
<body>
    <div class="container">
    <div class="jumbotron">
  <h1 class="display-4">Hello, <?= $_SESSION['nama'] ?> </h1>
  <p class="lead">Selamat Datang, anda login sebagai <?= $_SESSION['data_user'] ?> </p>
</div>

<div class="card">
  <div class="card-header bg-primary text-white">
    Ganti Password jika anda ingin menggantikannya
</div><br><br>

<div class="card-body">
<form method="post" action="proses_change_pass.php">
  <div class="form-group" >
  <input type="hidden" name="data_user" value="<?= $_SESSION['data_user'] ?>">
  <label>Masukkan Password Lama Anda</label>
    <input type="text" class="form-control"  name="pass_lama">
  </div>
  <div class="form-group">
    <label>Masukkan Password Baru Anda</label>
    <input type="text" class="form-control"  name="pass_baru">
  </div>
  <div class="form-group">
    <label>Konfirmasi Password</label>
    <input type="text" class="form-control"  name="konfirmasi_pass">
  </div>

  
  <button type="submit" class="btn btn-primary">Proses</button>
  <button type="reset" class="btn btn-danger">Batal</button>
</form>
</div>
    </div>

    
</body>
</html>

<?php
//pemanggilan file setting footer
include "setting_footer.php";

?>