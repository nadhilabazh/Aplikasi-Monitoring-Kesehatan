<?php
error_reporting(0);
session_start();
include "assets/koneksi/koneksi.php";

if (isset($_SESSION["data_user"])) {
    header("location:dashboard/index.php");
}

$username = mysqli_real_escape_string($conect, $_POST['username']);
$password = mysqli_real_escape_string($conect, $_POST['password']);
$password_md5 = md5($password);

if (isset($_POST['login'])) {
    $sql_cek = mysqli_query($conect, "SELECT * FROM user where username='$username' and password='$password_md5'");
    $cek = mysqli_num_rows($sql_cek);
    if ($cek > 0) {

        $data = mysqli_fetch_assoc($sql_cek);
        if($data['level']=="admin"){

        $_SESSION['data_user'] = $username;
        $_SESSION['level']= $level;
        $_SESSION['id']=$data['id'];
        $_SESSION['nama']=$data['nama'];

        echo "<script>alert('Selamat Datang!');document.location='dashboard/index.php'</script>";

        } else if ($data['level']=="pegawai") {

        $_SESSION['data_user'] = $username;
        $_SESSION['level']= $level;
        $_SESSION['id']=$data['id'];
        $_SESSION['nama']=$data['nama'];

        echo "<script>alert('Selamat Datang!');document.location='dashboardpegawai/index.php'</script>";

    } else {
        echo "<script>alert('Login Gagal! Username atau password tidak valid!');document.location='index.php'</script>";
    }
    
}
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" href="assets/images/logo/logo.png">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-5.14.0-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style_login.css">
</head>

<body>
    <div class="container-body">
        <form action="" method="post" class="login-form">
            <div class="img-logo">
                <img src="assets/images/logo/logo.png" alt="logo" class="logo">
            </div>
            
            <p><b>PT. Pelabuhan Indonesia II (Persero) Cabang Palembang </b></p>
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" required><br><br><br>

                

                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </div>

    </script>
    <script src="<?php echo $hostname; ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo $hostname; ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo $hostname; ?>/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>




