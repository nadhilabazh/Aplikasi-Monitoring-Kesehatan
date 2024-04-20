<?php
session_start();
include "../assets/koneksi/koneksi.php";

$id = $_GET['id'];
$yes = mysqli_query($conect, "DELETE FROM divisi where id_divisi='$id'");

if ($yes) {
    echo "<script>alert('Data Divisi Berhasil di Hapus!');document.location='data_divisi.php'</script>";
} else {
    echo "<script>alert('Error!');document.location='csm.php'</script>";
}