<?php
$title = "Edit Data Laporan Kesehatan";
include "setting_metatag.php";

include "setting_navbar.php";
?>
<script src="<?php echo $hostname; ?>/assets/js/jquery.min2.js"></script>

<script src="<?php echo $hostname; ?>/assets/js/bootstrap-datepicker.min.js"></script>

<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Edit Data Laporan Kesehatan
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $tampildata = mysqli_query($conect, "select*from kesehatan, pegawai, divisi where kesehatan.nip = pegawai.nip and kesehatan.id_divisi = divisi.id_divisi and id_kesehatan='$_GET[id]'");
                $b = mysqli_fetch_array($tampildata);

                $id_kesehatan = mysqli_real_escape_string($conect, $_POST['id_kesehatan']);
                $nip = mysqli_real_escape_string($conect, $_POST['nip']);
                $id_divisi = mysqli_real_escape_string($conect, $_POST['id_divisi']);
                $lampiran_suket = mysqli_real_escape_string($conect, $_POST['lampiran_suket']);
                $status_kesehatan = mysqli_real_escape_string($conect, $_POST['status_kesehatan']);
                $deskripsi = mysqli_real_escape_string($conect, $_POST['deskripsi']);
                $tgl_periksa = mysqli_real_escape_string($conect, $_POST['tgl_periksa']);

                if (isset($_POST['simpan'])) {
                    if (empty($id_kesehatan)) {
                        $er_id_kesehatan = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan ID Kesehatan Anda !</div>";
                    } elseif ($nip == "") {
                        $er_nama = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Nama Anda !</div>";
                    } elseif ($id_divisi == "") {
                        $er_nama_divisi = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Divisi !</div>";
                    } elseif (empty($lampiran_suket)) {
                        $er_lampiran_suket= "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Lampiran Surat Keterangan Kesehatan Anda dalam bentuk file pdf !</div>";
                    } elseif (empty($status_kesehatan)) {
                        $er_status_kesehatan = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Status Kesehatan Anda Saat ini !</div>";
                    } elseif (empty($deskripsi)) {
                        $er_deskripsi = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Deskripsi Mengenai Kesehatan Anda Saat ini!</div>";    
                    } elseif (empty($tgl_periksa)) {
                        $er_tgl_periksa = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Tanggal Anda Periksa Kesehatan</div>";
                    } else {
                        $save = mysqli_query($conect, "INSERT INTO kesehatan (id_kesehatan, nip, id_divisi, lampiran_suket, status_kesehatan, deskripsi, tgl_periksa) VALUE ('$id_kesehatan', '$nip', '$id_divisi', '$lampiran_suket', '$status_kesehatan', '$deskripsi', '$tgl_periksa')");
                        if ($save) {
                            echo "<script>alert('Data Laporan Kesehatan Berhasil Ditambahkan');document.location='tambah_kesehatan.php'</script>";
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
                        <a href="data_kesehatan.php" title="Input data" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Id Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Id Kesehatan"
                                        name="id_kesehatan" value="<?php echo $b['id_kesehatan']; ?>" maxlength=" 100"
                                        readonly>
                                </div>
                                <?php echo $er_id_kesehatan; ?>
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <select name="nama" class="form-control">
                                        <option value="">Pilih Nama Anda</option>
                                        <?php $pegawai = mysqli_query($conect, "select *from pegawai");
                                        while ($c = mysqli_fetch_array($pegawai)) {
                                            if ($c['nip'] == $b['nip']) {
                                                echo "
                                        <option value='$c[nip]' selected>$c[nama]</option>";
                                            } else {
                                                echo "
                                        <option value='$c[nip]'>$c[nama]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php echo $er_nama; ?>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <?php $id_divisi = mysqli_query($conect, "select * from divisi where id_divisi='$a[id_divisi]'");
                                        $divisi = mysqli_fetch_array($id_divisi);
                                        ?>
                                     <input type="text" class="form-control" placeholder="divisi"
                                        name="divisi" value="<?php echo $divisi['nama_divisi']; ?>"
                                        maxlength="100" readonly>
                                        <input type="hidden" class="form-control" placeholder="divisi"
                                        name="id_divisi" value="<?php echo $divisi['id_divisi']; ?>"
                                        maxlength="100" readonly>
                                </div>
                                <?php echo $er_nama_divisi; ?>
                                <div class="form-group">
                                    <label>Lampiran Surat Kesehatan</label>
                                    <input type="file" class="form-control" autocomplete="off" placeholder="Lampiran Surat Kesehatan"
                                        name="lampiran_suket" accept="application/pdf" id="lampiran_suket" value="<?php echo $_POST['lampiran_suket']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_lampiran_suket; ?>
                                <div class="form-group">
                                    <label>Status Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Status Kesehatan"
                                        name="status_kesehatan" value="<?php echo $b['status_kesehatan']; ?>"
                                        maxlength=" 100">
                                </div>
                                <?php echo $er_status_kesehatan; ?>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" placeholder="Deskripsi"
                                        name="deskripsi" value="<?php echo $b['deskripsi']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_deskripsi; ?>
                                <div class="form-group">
                                    <label>Tanggal Periksa</label>
                                    <input type="date" class="form-control" name="tgl_periksa"
                                        placeholder="Tanggal Periksa" value="<?php echo $b['tgl_periksa']; ?>" />
                                </div>
                                <?php echo $er_tanggal_periksa; ?>
                                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>

                            </form>
                            <script type="text/javascript">
                            $('#datepicker').datepicker({
                                format: "yyyy-mm-dd",
                                todayHighlight: true,
                                autoclose: true
                            }).attr("readonly", "readonly").css({
                                "cursor": "pointer",
                                "background": "white"
                            });
                            </script>
                        </div>


                    </div>

                </div>


            </div>





        </div>


    </div>


    <?php
    include "setting_footer.php";
    ?>