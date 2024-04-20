<?php
include "../assets/koneksi/koneksi.php";
$id_kesehatan = $_GET['id'];

$ambil = mysqli_query($conect, "select*from kesehatan where id_kesehatan='$id_kesehatan'");
$l = mysqli_fetch_array($ambil);

$nip = $l['nip'];
$id_divisi = $l['id_divisi'];
$lampiran_suket = $l['lampiran_suket'];
$status_kesehatan = $l['status_kesehatan'];
$deskripsi = $l['deskripsi'];
$tgl_disetujui = date('Y-m-d');

$save1 = mysqli_query($conect, "INSERT INTO kesehatan_selesai (id_kesehatan,nip,id_divisi,lampiran_suket,status_kesehatan,deskripsi,tgl_disetujui) VALUE ('$id_kesehatan','$nip','$id_divisi','$lampiran_suket','$status_kesehatan','$deskripsi','$tgl_disetujui')");
$hapus1 = mysqli_query($conect, "DELETE FROM kesehatan where id_kesehatan='$id_kesehatan'");
if ($save1 and $hapus1) {
    echo "<script>alert('Data Laporan Kesehatan Telah Disetujui!');document.location='data_kesehatan.php'</script>";
} else {
    $error = "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <i class='fa fa-info-circle'></i> Gagal Menyimpan !</div>";
}