<?php
$title = "Halaman Utama";
//pemanggilan file metatag
include "setting_metatag.php";
//pemanggilan file navbar
include "setting_navbar.php";
?>
<script src="<?php echo $hostname; ?>/assets/js/chart.js"></script>

<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">

                <!--konten pilihan start-->
                <div class="jumbotron">
                    <div class="container">
                        <h3 class="display-5">SELAMAT DATANG,</h3>
                        <p class="lead">di Aplikasi Monitoring Kesehatan Pegawai PT. Pelabuhan Indonesia II (Persero) Cabang Palembang <br>
                        Aplikasi ini berfungsi untuk memonitoring setiap data laporan kesehatan pegawai
                        pada PT. Pelabuhan Indonesia II (Persero) Cabang Palembang .</p>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pie-chart fa-fw"></i> Daftar Laporan Kesehatan</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Kesehatan</th>
                                        <th>Nama Pegawai</th>
                                        <th>Divisi</th>
                                        <th>Lampiran Surat Kesehatan</th>
                                        <th>Status Kesehatan</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $databaseHost = 'localhost';
                                    $databaseName = 'uas';
                                    $databaseUsername = 'root';
                                    $databasePassword = '';

                                    $db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
                                    $sql = "select*from kesehatan, pegawai, divisi where kesehatan.nip = pegawai.nip and kesehatan.id_divisi = divisi.id_divisi order by tgl_periksa desc limit 5";
                                    $query = mysqli_query($db, $sql);
                                    $jumlah3 = mysqli_num_rows($query);
                                    if ($jumlah3 == 0) {
                                    ?>
                                    <tr>
                                        <td colspan="6">Tidak terdapat Data</td>
                                    </tr>
                                    <?php
                                    } else {
                                        while ($user_data = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $posisi3 = $posisi3 + 1; ?></td>
                                        <td><?php echo $user_data['id_kesehatan']; ?></td>
                                        <td><?php echo $user_data['nama']; ?></td>
                                        <td><?php echo $user_data['nama_divisi']; ?></td>
                                        <td><?php echo $user_data['lampiran_suket']; ?></td>
                                        <td><?php echo $user_data['status_kesehatan']; ?></td>
                                        <td><?php echo $user_data['deskripsi']; ?></td>
                                        <td><?php echo $user_data['tgl_periksa']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="text-right">
                            <a href="data_kesehatan.php">Lihat Semua Data Kesehatan <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pie-chart fa-fw"></i> Daftar Laporan Kesehatan Selesai
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Kesehatan</th>
                                        <th>Nama Pegawai</th>
                                        <th>Divisi</th>
                                        <th>Lampiran Surat Kesehatan</th>
                                        <th>Status Kesehatan</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $databaseHost = 'localhost';
                                    $databaseName = 'uas';
                                    $databaseUsername = 'root';
                                    $databasePassword = '';

                                    $db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
                                    $sql = "select*from kesehatan_selesai, pegawai, divisi where kesehatan_selesai.nip = pegawai.nip and kesehatan_selesai.id_divisi = divisi.id_divisi order by tgl_disetujui desc limit 5";
                                    $query = mysqli_query($db, $sql);
                                    $jumlah3 = mysqli_num_rows($query);
                                    if ($jumlah3 == 0) {
                                    ?>
                                    <tr>
                                        <td colspan="6">Tidak terdapat Data</td>
                                    </tr>
                                    <?php
                                    } else {
                                        while ($user_data = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $posisi4 = $posisi4 + 1; ?></td>
                                        <td><?php echo $user_data['id_kesehatan']; ?></td>
                                        <td><?php echo $user_data['nama']; ?></td>
                                        <td><?php echo $user_data['nama_divisi']; ?></td>
                                        <td><?php echo $user_data['lampiran_suket']; ?></td>
                                        <td><?php echo $user_data['status_kesehatan']; ?></td>
                                        <td><?php echo $user_data['deskripsi']; ?></td>
                                        <td><?php echo $user_data['tgl_disetujui']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="text-right">
                            <a href="data_kesehatan_selesai.php">Lihat Semua Data Kesehatan <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
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