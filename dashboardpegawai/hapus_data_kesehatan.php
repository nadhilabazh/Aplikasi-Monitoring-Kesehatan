<?php
session_start();
include "../assets/koneksi/koneksi.php";

$id = $_GET['id'];
$yes = mysqli_query($conect, "DELETE FROM kesehatan where id_kesehatan='$id'");

if ($yes) {
    echo "<script>alert('Data Laporan Kesehatan Berhasil di Hapus!');document.location='data_kesehatan.php'</script>";
} else {
    echo "<script>alert('Error!');document.location='csm.php'</script>";
}