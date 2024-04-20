<?php
$title = "Data Laporan Kesehatan Selesai";
//pemanggilan file metatag
include "setting_metatag.php";

//pemanggilan file navbar
include "setting_navbar.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">
        <!-- .row -->
        <!-- Page Heading  breadcumb-->
        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Data Laporan Kesehatan Selesai
                </h3>
                <hr>
            </div>
        </div>
        <!-- /.row -->

        <!-- .row -->
        <div class="row">

            <!-- .col lg 12 -->
            <div class="col-lg-12">

                <!-- panel . (Pelajari cara membuat panel di bootstrap yah)-->
                <div class="panel panel-default">

                    <!-- panel heading -->
                    <div class="panel-heading">
                        <form action="cari_data_kesehatan_selesai.php" method="get" class="form-inline text-right">
                            <input type="text" class="form-control" name="id_kesehatan"
                                placeholder="Masukkan Id Kesehatan" value="<?php echo $_GET['id_kesehatan']; ?>"
                                required>
                            <button type="submit" class="btn btn-success">Cari</button>
                        </form>
                    </div>
                    <!-- /.panel heading -->

                    <!-- panel body -->
                    <div class="panel-body">

                        <!-- /.tabel responsive -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Kesehatan</th>
                                        <th>Nama Pegawai</th>
                                        <th>Divisi</th>
                                        <th>Lampiran Surat Kesehatan</th>
                                        <th>Status Kesehatan</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Disetujui</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pg = isset($_GET['pg']) ? $_GET['pg'] : "";
                                    $batas = 10; /*batas tampilan setiap halaman*/
                                    if (empty($pg)) {
                                        $posisi = 0;
                                        $pg = 1;
                                    } else {
                                        $posisi = ($pg - 1) * $batas;
                                    }
                                    /*Jika variabel $pg kosong maka akan menampilkan halaman pertama dengan batas baris 10*/

                                    $ambildata = mysqli_query($conect, "select*from kesehatan_selesai, divisi, pegawai where kesehatan_selesai.id_divisi = divisi.id_divisi and kesehatan_selesai.nip = pegawai.nip and id_kesehatan LIKE '%$_GET[id_kesehatan]%' order by tgl_disetujui desc limit $posisi, $batas");
                                    $jumlah = mysqli_num_rows($ambildata);  /*mysql_num_rows untuk menghitung total baris di tabel databse*/
                                    if ($jumlah == 0) {  //jika tidak ada data
                                    ?>
                                    <tr>
                                        <td colspan="8">Tidak Terdapat Data</td>
                                    </tr>
                                    <?php
                                    } else {
                                        //jika ada data di tb_brand
                                        while ($a = mysqli_fetch_array($ambildata)) { /*mysql_fetch array untuk mengambil data di setiap field di tabel databse*/
                                        ?>
                                    <tr>
                                        <td><?php echo $posisi = $posisi + 1; ?></td>
                                        <td><?php echo $a['id_kesehatan']; ?></td>
                                        <td><?php echo $a['nama']; ?></td>
                                        <td><?php 
                                            $id_divisi = mysqli_query($conect, "select * from divisi where id_divisi='$a[id_divisi]'");
                                            $divisi = mysqli_fetch_array($id_divisi);
                                            echo $divisi['nama_divisi'];
                                            ?></td>
                                        <td><?php echo $a['lampiran_suket']; ?></td>
                                        <td><?php echo $a['status_kesehatan']; ?></td>
                                        <td><?php echo $a['deskripsi']; ?></td>
                                        <td><?php echo $a['tgl_selesai']; ?></td>
                                        <td>
                                            <a href="edit_data_kesehatan_selesai.php?id=<?php echo $a['id_kesehatan']; ?>"
                                                title="Edit data"><button class="btn btn-primary btn-sm"><i
                                                        class="fa fa-pencil-square-o fa-fw"></i> Edit</button> </a>
                                            <a href="hapus_data_kesehatan_selesai.php?id=<?php echo $a['id_kesehatan']; ?>"
                                                onclick="return confirm('Yakin akan meghapus data ini')"
                                                title="Hapus data"><button class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash-o fa-fw"></i> Hapus</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tabel responsive -->

                        <div class="text-center">
                            <?php
                            //script paging, untuk menampikan setiap halaman
                            $jml_data = mysqli_num_rows(mysqli_query($conect, "select*from kesehatan_selesai, divisi, pegawai where kesehatan_selesai.id_divisi = divisi.id_divisi and kesehatan_selesai.nip = pegawai.nip and id_kesehatan LIKE '%$_GET[id_kesehatan]%' order by tgl_disetujui desc"));
                            $JmlHalaman = ceil($jml_data / $batas); //ceil digunakan untuk pembulatan keatas
                            if ($jml_data != 0) {
                                if ($pg > 1) {
                                    $link = $pg - 1;
                                    $prev = "<a href='?pg=$link'><button name='prev' class='btn btn-primary btn-sm'>Prev</button></a> ";
                                } else {
                                    $prev = "<button name='prev' class='btn btn-default btn-sm'>Prev </button> ";
                                }
                                $nmr = '';
                                for ($i = 1; $i <= $JmlHalaman; $i++) {

                                    if ($i == $pg) {
                                        $nmr .= "<button name='prev' class='btn btn-primary btn-sm'>$i</button> ";
                                    } else {
                                        $nmr .= "<a href='?pg=$i'><button name='prev' class='btn btn-default btn-sm'>$i</button></a> ";
                                    }
                                }
                                if ($pg < $JmlHalaman) {
                                    $link = $pg + 1;
                                    $next = "<a href='?pg=$link'><button name='prev' class='btn btn-primary btn-sm'>Next</button></a> ";
                                } else {
                                    $next = "<button name='prev' class='btn btn-default btn-sm'>Next</button> ";
                                }
                                echo $prev . $nmr . $next;
                            ?>
                            <br><br>
                            <span class="text-muted">Menampilkan <?php echo $jumlah; ?> dari <?php echo $jml_data; ?>
                                Record </span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /.panel body -->

                </div>
                <!-- /.panel -->

            </div>
            <!-- /.col lg 12-->

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
//pemanggilan file setting footer
include "setting_footer.php";

?>