<?php
$title = "Tambah Data User";
include "setting_metatag.php";

include "setting_navbar.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Tambah Data User
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $nama = mysqli_real_escape_string($conect, $_POST['nama']);
                $username = mysqli_real_escape_string($conect, $_POST['username']);
                $password = mysqli_real_escape_string($conect, $_POST['password']);
                $password2 = mysqli_real_escape_string($conect, $_POST['password2']);
                $password3 = md5($password2);
                $level = mysqli_real_escape_string($conect, $_POST['level']);

                if (isset($_POST['simpan'])) {
                    if (empty($nama)) {
                        $er_nama = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Nama User !</div>";
                    } elseif (empty($username)) {
                        $er_username = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Username !</div>";
                    } elseif (empty($password)) {
                        $er_password = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Password User !</div>";
                    } elseif (strlen($password) < 8) {
                        $er_password = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Password User  Min. 8 Karakter!</div>";
                    } elseif (strlen($password) > 15) {
                        $er_password = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Password User  Max. 12 Karakter!</div>";
                    } elseif (empty($password2)) {
                        $er_password2 = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Ulangi Password User !</div>";
                    } elseif ($password != $password2) {
                        $er_password2 = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Ulangi Password User Dengan Benar !</div>";
                    } elseif (empty($level)) {
                        $er_level = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Level !</div>";
                    } else {
                        $save = mysqli_query($conect, "INSERT INTO user (nama,username,password,level) VALUE ('$nama','$username','$password3','$level')");
                        if ($save) {
                            echo "<script>alert('Data User Baru Berhasil Ditambahkan');document.location='data_user.php'</script>";
                        } else {
                            $error = "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <i class='fa fa-info-circle'></i> Gagal Menyimpan !</div>";
                        }
                    }
                }

                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="data_user.php" title="Kembali"><button name="input"
                                class="btn btn-primary">Kembali</button></a>
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama"
                                        value="<?php echo $_POST['nama']; ?>" maxlength="100">
                                </div>
                                <?php echo $er_nama; ?>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username"
                                        name="username" value="<?php echo $_POST['username']; ?>" maxlength="100">
                                </div>
                                <?php echo $er_username; ?>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        value="<?php echo $_POST['password']; ?>" maxlength="100">
                                </div>
                                <?php echo $er_password; ?>
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input type="password" class="form-control" placeholder="Ulangi Password"
                                        name="password2" value="<?php echo $_POST['password2']; ?>" maxlength="100">
                                </div>
                                <?php echo $er_password2; ?>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control">
                                        <option value="">Pilih Level</option>
                                        <option value=“admin”> Admin </option>
		                                <option value=“pegawai”> Pegawai </option>
                                    </select>
                                </div>
                                <?php echo $er_level; ?>

                                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>

                            </form>
                        </div>
                    </div>


                </div>

            </div>


        </div>





    </div>


</div>


<?php
include "setting_footer.php";
?>