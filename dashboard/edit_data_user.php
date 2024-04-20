<?php
$title = "Edit Data User";
include "setting_metatag.php";

include "setting_navbar.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Edit Data User
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $tampildata = mysqli_query($conect, "select*from user where id='$_GET[id]'");
                $b = mysqli_fetch_array($tampildata);

                $id = mysqli_real_escape_string($conect, $_POST['id']);
                $nama = mysqli_real_escape_string($conect, $_POST['nama']);
                $username = mysqli_real_escape_string($conect, $_POST['username']);
                $password = mysqli_real_escape_string($conect, $_POST['password']);
                $password2 = mysqli_real_escape_string($conect, $_POST['password2']);
                $password3 = md5($password);
                $level = mysqli_real_escape_string($conect, $_POST['level']);

                if (isset($_POST['simpan'])) {
                    if (empty($nama)) {
                        $er_nama = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Nama !</div>";
                    } elseif (empty($username)) {
                        $er_username = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Username !</div>";
                    } elseif (empty($password)) {
                        $er_password = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Password !</div>";
                    } elseif (strlen($password) < 8) {
                        $er_password = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Password  Min. 8 Karakter!</div>";
                    } elseif (strlen($password) > 15) {
                        $er_password = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Password  Max. 12 Karakter!</div>";
                    } elseif (empty($password2)) {
                        $er_password2 = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Ulangi Password !</div>";
                    } elseif ($password != $password2) {
                        $er_password2 = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Ulangi Password dengan Benar !</div>";
                    } elseif (empty($level)) {
                        $er_level = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Level !</div>";
                    } else {
                        $save = mysqli_query($conect, "UPDATE user set id='$id', nama='$nama', username='$username', password='$password3', level='$level' where id='$id'");
                        if ($save) {
                            echo "<script>alert('Data User Berhasil Diperbarui');document.location='data_user.php'</script>";
                            $_SESSION['data_user'] = $username;
                        } else {
                            $error = "<div class='alert alert-danger alert-dismissable'>
                                	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                	<i class='fa fa-info-circle'></i> Gagal Perbarui Data !</div>";
                        }
                    }
                }

                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="data_user.php" title="Input data" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama"
                                        value="<?php echo $b['nama']; ?>" maxlength="100">
                                </div>
                                <?php echo $er_nama; ?>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username"
                                        name="username" value="<?php echo $b['username']; ?>" maxlength="100">
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
                                <?php echo $er_level; ?>
                                <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" placeholder="Level"
                                        name="level" value="<?php echo $b['level']; ?>" maxlength="100">
                                </div>
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