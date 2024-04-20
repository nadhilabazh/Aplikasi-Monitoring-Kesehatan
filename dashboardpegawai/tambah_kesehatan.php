<?php
$title = "Tambah Data Laporan Kesehatan";
include "setting_metatag.php";

include "setting_navbar.php";
$query="select * from pegawai where id = '$_SESSION[id]'";
$sql = mysqli_query($conect,$query);
$data = mysqli_fetch_array($sql);
?>

<script src="<?php echo $hostname; ?>../assets/js/jquery.min2.js"></script>

<script src="<?php echo $hostname; ?>../assets/js/bootstrap-datepicker.min.js"></script>

<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Tambah Data Laporan Kesehatan
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $id_kesehatan = mysqli_real_escape_string($conect, $_POST['id_kesehatan']);
                $nip = mysqli_real_escape_string($conect, $_POST['nama']);
                $id_divisi = mysqli_real_escape_string($conect, $_POST['id_divisi']);
                $status_kesehatan = mysqli_real_escape_string($conect, $_POST['status_kesehatan']);
                $deskripsi = mysqli_real_escape_string($conect, $_POST['deskripsi']);
                $tgl_periksa = mysqli_real_escape_string($conect, $_POST['tgl_periksa']);

                $file = $_FILES['lampiran_suket']['tmp_name'];
                $nama_file = $_FILES['lampiran_suket']['name'];
                $destination = "file/".$nama_file;

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
                        $save = mysqli_query($conect, "INSERT INTO kesehatan (id_kesehatan, nip, id_divisi, lampiran_suket, status_kesehatan, deskripsi, tgl_periksa) VALUE ('$id_kesehatan', '$nip', '$id_divisi', '$nama_file', '$status_kesehatan', '$deskripsi', '$tgl_periksa')");
                        if ($save) {
                            move_uploaded_file($file, $destination);
                            echo "<script>alert('Data Laporan Kesehatan Berhasil Ditambahkan');document.location='data_kesehatan.php'</script>";
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
                        <a href="data_kesehatan.php" title="Kembali"><button name="input"
                                class="btn btn-primary">Kembali</button></a>
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Id Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Id Kesehatan"
                                        name="id_kesehatan" value="<?php echo $_POST['id_kesehatan']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_id_kesehatan ?>
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <input type="text" class="form-control" placeholder="nama"
                                        name="" value="<?php echo $data['nama']; ?>"
                                        maxlength="100"  readonly>
                                        <input type="hidden" class="form-control" placeholder="nama"
                                        name="nama" value="<?php echo $data['nip']; ?>"
                                        maxlength="100"  readonly>
                                </div>
                                <?php echo $er_nama; ?>
                                <div class="form-group">
                                    <label>Divisi</label>
                                        <?php $id_divisi = mysqli_query($conect, "select * from divisi where id_divisi='$data[id_divisi]'");
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
                                        name="lampiran_suket" accept="application/pdf" id="lampiran_suket"
                                        maxlength="100">
                                </div>
                                <?php echo $er_lampiran_suket; ?>
                                <div class="form-group">
                                    <label>Status Kesehatan</label>
                                    <input type="text" class="form-control" placeholder="Status Kesehatan"
                                        name="status_kesehatan" value="<?php echo $_POST['status_kesehatan']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_status_kesehatan; ?>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" placeholder="Deskripsi"
                                        name="deskripsi" value="<?php echo $_POST['deskripsi']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_deskripsi; ?>
                                <div class="form-group">
                                    <label>Tanggal Periksa</label>
                                    <input type="date" class="form-control" name="tgl_periksa"
                                        placeholder="Tanggal Periksa"
                                        value="<?php echo $_POST['tgl_periksa']; ?>" />
                                </div>
                                <?php echo $er_tgl_periksa; ?>
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


</div>


<?php
include "setting_footer.php";
?>