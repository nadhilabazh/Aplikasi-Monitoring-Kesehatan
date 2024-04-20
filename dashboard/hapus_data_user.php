<?php
session_start();
include "../assets/koneksi/koneksi.php";

$id = $_GET['id'];
$yes = mysqli_query($conect, "DELETE FROM user where id='$id'");

if ($yes) {
    echo "<script>alert('Data User Berhasil di Hapus!');document.location='data_user.php'</script>";
} else {
    echo "<script>alert('Error!');document.location='csm.php'</script>";
}