<?php
$title = "Edit Data Divisi";
include "setting_metatag.php";

include "setting_navbar.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Edit Data Divisi
                </h3>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">

                <?php
                $tampildata = mysqli_query($conect, "select*from divisi where id_divisi='$_GET[id]'");
                $b = mysqli_fetch_array($tampildata);

                $id_divisi = mysqli_real_escape_string($conect, $_POST['id_divisi']);
                $nama_divisi = mysqli_real_escape_string($conect, $_POST['nama_divisi']);

                if (isset($_POST['simpan'])) {
                    if (empty($nama_divisi)) {
                        $er_nama_divisi = "<div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <i class='fa fa-info-circle'></i> Masukan Nama Divisi !</div>";
                    } else {
                        $save = mysqli_query($conect, "UPDATE divisi set id_divisi='$id_divisi', nama_divisi='$nama_divisi' where id_divisi='$id_divisi'");
                        if ($save) {
                            echo "<script>alert('Data Divisi Berhasil Diperbarui');document.location='data_divisi.php'</script>";
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
                        <a href="data_divisi.php" title="Input data" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <?php echo $error; ?>
                                <div class="form-group">
                                    <label>Nama Divisi</label>
                                    <input type="text" class="form-control" placeholder="Nama Divisi"
                                        name="nama_divisi" value="<?php echo $b['nama_divisi']; ?>" maxlength="100">
                                </div>
                                <?php echo $er_nama_divisi; ?>
                                <input type="hidden" name="id_divisi" value="<?php echo $b['id_divisi']; ?>">
                                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>

                            </form>
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