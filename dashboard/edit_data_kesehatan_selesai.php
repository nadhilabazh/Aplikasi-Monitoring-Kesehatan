<?php
$title = "Edit Data Laporan Kesehatan Selesai";
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
                    Edit Data Laporan Kesehatan Selesai
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $tampildata = mysqli_query($conect, "select*from kesehatan_selesai , divisi, pegawai where kesehatan_selesai.id_divisi = divisi.id_divisi and kesehatan_selesai.nip = pegawai.nip and id_kesehatan='$_GET[id]'");
                $b = mysqli_fetch_array($tampildata);

                $id_kesehatan = mysqli_real_escape_string($conect, $_POST['id_kesehatan']);
                $nip = mysqli_real_escape_string($conect, $_POST['nama']);
                $id_divisi = mysqli_real_escape_string($conect, $_POST['nama_divisi']);
                $lampiran_suket = mysqli_real_escape_string($conect, $_POST['lampiran_suket']);
                $status_kesehatan = mysqli_real_escape_string($conect, $_POST['status_kesehatan']);
                $deskripsi = mysqli_real_escape_string($conect, $_POST['deskripsi']);
                $tgl_disetujui = mysqli_real_escape_string($conect, $_POST['tgl_disetujui']);

                if (isset($_POST['simpan'])) {
                    if (empty($id_kesehatan)) {
                        $er_id_kesehatan = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Id Kesehatan</div>";
                    } elseif (empty($nip == "")) {
                        $er_nama = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Nama Pegawai</div>";
                    } elseif (empty($id_divisi == "")) {
                        $er_nama_divisi = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Divisi</div>";
                    } elseif (empty($lampiran_suket)) {
                        $er_nlampiran_suket = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Lampiran Surat Kesehatan</div>";
                    } elseif (empty($status_kesehatan)) {
                        $er_status_kesehatan = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Status Kesehatan</div>";
                    } elseif (empty($deskripsi)) {
                        $er_deskripsi = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Deskripsi Mengenai Kesehatan</div>";
                    } elseif (empty($tgl_disetujui)) {
                        $er_tgl_disetujui = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Tanggal disetujui</div>";
                    } else {
                        $save = mysqli_query($conect, "UPDATE kesehatan_selesai set id_kesehatan='$id_kesehatan', nip='$nip', id_divisi='$id_divisi', lampiran_suket='$lampiran_suket', status_kesehatan='$status_kesehatan', deskripsi='$deskripsi', tgl_disetujui='$tgl_disetujui' where id_kesehatan='$id_kesehatan'");
                        if ($save) {
                            echo "<script>alert('Data Laporan Kesehatan Selesai Berhasil Diperbarui');document.location='data_kesehatan_selesai.php'</script>";
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
                        <a href="data_kesehatan_selesai.php" title="Input data" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Id Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Id Kesehatan"
                                        name="id_kesehatan" value="<?php echo $b['id_kesehatan']; ?>" maxlength="15"
                                        readonly>
                                </div>
                                <?php echo $er_id_kesehatan; ?>
                                <div class="form-group">
                                    <label>Nip</label>
                                    <select name="nama" class="form-control">
                                        <option value="">Pilih Nama</option>
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
                                    <select name="nama_teknisi" class="form-control">
                                        <option value="">Pilih Divisi</option>
                                        <?php $teknisi = mysqli_query($conect, "select *from divisi");
                                        while ($c = mysqli_fetch_array($teknisi)) {
                                            if ($c['id_divisi'] == $b['id_divisi']) {
                                                echo "
                                        <option value='$c[id_divisi]' selected>$c[nama_divisi]</option>";
                                            } else {
                                                echo "
                                        <option value='$c[id_divisi]'>$c[nama_divisi]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php echo $er_nama_divisi; ?>
                                <div class=" form-group">
                                    <label>Lampiran Surat Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Lampiran Surat Kesehatan"
                                        name="lampiran_suket" value="<?php echo $b['lampiran_suket']; ?>"
                                        maxlength=" 100">
                                </div>
                                <?php echo $er_lampiran_suket; ?>
                                <div class="form-group">
                                    <label>Status Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Status Kesehatan"
                                        name="status_kesehatan" value="<?php echo $b['status_kesehatan']; ?>"
                                        maxlength="15">
                                </div>
                                <?php echo $er_status_kesehatan; ?>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" placeholder="Deskripsi"
                                        name="deskripsi" value="<?php echo $b['deskripsi']; ?>"
                                        maxlength="15">
                                </div>
                                <?php echo $er_deskripsi; ?>
                                <div class="form-group">
                                    <label>Tanggal Kesehatan disetujui</label>
                                    <input type="text" id="datepicker" class="form-control" name="tgl_disetujui"
                                        placeholder="Tanggal Kesehatan Selesai"
                                        value="<?php echo $b['tgl_disetujui']; ?>" />
                                </div>
                                <?php echo $er_tgl_disetujui; ?>
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