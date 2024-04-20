<?php
$title = "Edit Data Pegawai";
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
                    Edit Data Pegawai
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $tampildata = mysqli_query($conect, "select*from pegawai, divisi where pegawai.id_divisi = divisi.id_divisi and nip='$_GET[id]'");
                $b = mysqli_fetch_array($tampildata);

                $nip = mysqli_real_escape_string($conect, $_POST['nip']);
                $nama = mysqli_real_escape_string($conect, $_POST['nama']);
                $alamat = mysqli_real_escape_string($conect, $_POST['alamat']);
                $tgl_lahir = mysqli_real_escape_string($conect, $_POST['tgl_lahir']);
                $jk = mysqli_real_escape_string($conect, $_POST['jk']);
                $no_hp = mysqli_real_escape_string($conect, $_POST['no_hp']);
                $email = mysqli_real_escape_string($conect, $_POST['email']);
                $id_divisi = mysqli_real_escape_string($conect, $_POST['nama_divisi']);

                if (isset($_POST['simpan'])) {
                    if (empty($nip)) {
                        $er_nip = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Nip</div>";
                    } elseif (empty($nama)) {
                        $er_nama = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Nama Pegawai</div>";
                    } elseif (empty($alamat)) {
                        $er_alamat = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Alamat</div>";
                    } elseif (empty($tgl_lahir)) {
                        $er_tgl_lahir = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Tanggal Lahir</div>";
                    } elseif (empty($jk)) {
                        $er_jk = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Jenis Kelamin</div>";
                    } elseif (empty($no_hp)) {
                        $er_no_hp = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan No Hp</div>";
                    } elseif (empty($email)) {
                        $er_email = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Email</div>";
                    } elseif ($id_divisi == "") {
                        $er_nama_divisi = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukkan Divisi</div>";
                    } else {
                        $save = mysqli_query($conect, "UPDATE pegawai set nip='$nip', nama='$nama', alamat='$alamat', tgl_lahir='$tgl_lahir', jk='$jk', no_hp='$no_hp', email='$email', id_divisi='$id_divisi' where nip='$nip'");
                        if ($save) {
                            echo "<script>alert('Data Pegawai Berhasil Diperbarui');document.location='data_pegawai.php'</script>";
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
                        <a href="data_pegawai.php" title="Input data" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="panel-body">

                    <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Nip</label>
                                    <input type="text" class="form-control" placeholder="Nip"
                                        name="nip" value="<?php echo $b['nip']; ?>" maxlength=" 100"
                                        readonly>
                                </div>
                                <?php echo $er_nip ?>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama"
                                        name="nama" value="<?php echo $b['nama']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_nama; ?>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" placeholder="Alamat"
                                        name="alamat" value="<?php echo $b['alamat']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_alamat; ?>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" id="datepicker" class="form-control" name="tgl_lahir"
                                        placeholder="Tanggal Lahir"
                                        value="<?php echo $b['tgl_lahir']; ?>" />
                                </div>
                                <?php echo $er_tgl_lahir; ?>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input type="text" class="form-control" placeholder="Jenis Kelamin"
                                        name="jk" value="<?php echo $b['jk']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_jk; ?>
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input type="text" class="form-control" placeholder="No Hp"
                                        name="no_hp" value="<?php echo $b['no_hp']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_no_hp; ?>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email"
                                        name="email" value="<?php echo $b['email']; ?>"
                                        maxlength="100">
                                </div>
                                <?php echo $er_email; ?>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <select name="nama_divisi" class="form-control">
                                        <option value="">Pilih Divisi</option>
                                        <?php $divisi = mysqli_query($conect, "select *from divisi");
                                        while ($c = mysqli_fetch_array($divisi)) {
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