<?php
session_start();
include "../assets/koneksi/koneksi.php";

$id = $_GET['id'];
$yes = mysqli_query($conect, "DELETE FROM pegawai where nip='$id'");

if ($yes) {
    echo "<script>alert('Data Pegawai Berhasil di Hapus!');document.location='data_pegawai.php'</script>";
} else {
    echo "<script>alert('Error!');document.location='csm.php'</script>";
}