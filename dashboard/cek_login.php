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