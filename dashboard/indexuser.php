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
                        <p class="lead">di Aplikasi Monitoring Kesehatan Pegawai PT. Pelabuhan Cabang Palembang.
                        Aplikasi ini berfungsi untuk memonitoring setiap data laporan kesehatan pegawai
                        pada PT. PELABUHAN TANJUNG PRIOK CABANG PALEMBANG.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pie-chart fa-fw"></i> Grafik Laporan kesehatan Per-Bulan
                        </h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="myChart"></canvas>
                        <?php
                        $bulan = "";
                        $jumlah = null;
                        $sql = "select MONTH(tanggal_gangguan),COUNT(*) as 'total' from kesehatan GROUP by MONTH(tanggal_gangguan)";
                        $hasil = mysqli_query($conect, $sql);

                        while ($data = mysqli_fetch_array($hasil)) {
                            if ($data['MONTH(tanggal_gangguan)'] == 1) {
                                $bul = "Januari";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 2) {
                                $bul = "Febuari";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 3) {
                                $bul = "Maret";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 4) {
                                $bul = "April";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 5) {
                                $bul = "Mei";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 6) {
                                $bul = "Juni";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 7) {
                                $bul = "Juli";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 8) {
                                $bul = "Agustus";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 9) {
                                $bul = "September";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 10) {
                                $bul = "Oktober";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 11) {
                                $bul = "November";
                            } elseif ($data['MONTH(tanggal_gangguan)'] == 12) {
                                $bul = "Desember";
                            }
                            $bulan .= "'$bul'" . ", ";
                            $jum = $data['total'];
                            $jumlah .= "$jum" . ", ";
                        }
                        ?>

                        <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [<?php echo $bulan; ?>],
                                datasets: [{
                                    label: '',
                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)',
                                        'rgb(60, 179, 113)', 'rgb(175, 238, 239)',
                                        'rgb(242, 99, 255)', 'rgb(255,246,99)', 'rgb(255,144,0)',
                                        'rgb(113,255,136)', 'rgb(255,113,213)', 'rgb(113,213,255)',
                                        'rgb(140,113,255)', 'rgb(127,52,239)'
                                    ],
                                    borderColor: ['rgb(255, 99, 132)'],
                                    data: [<?php echo $jumlah; ?>]
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pie-chart fa-fw"></i> Grafik Pie Laporan Kesehatan
                            Berdasarkan Jenisnya</h3>
                    </div>
                    <div class="panel-body">
                        <canvas id="myChart2"></canvas>
                        <?php
                        $jenis2 = "";
                        $jumlah2 = null;
                        $sql3 = "select id_jenis,COUNT(*) as 'total2' from kesehatan GROUP by id_jenis";
                        $hasil3 = mysqli_query($conect, $sql3);

                        while ($data3 = mysqli_fetch_array($hasil3)) {
                            $jenis1 = $data3['id_jenis'];
                            $jum2 = $data3['total2'];
                            $jumlah2 .= "$jum2" . ", ";

                            $sql4 = "select * from jenis_keluhan where id_jenis = '$jenis1'";
                            $hasil4 = mysqli_query($conect, $sql4);
                            while ($data4 = mysqli_fetch_array($hasil4)) {
                                $nama = $data4['nama_keluhan'];
                                $jenis3 .= "'$nama'" . ", ";
                            }
                        }
                        ?>
                        <script>
                        var ctx = document.getElementById('myChart2').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: [<?php echo $jenis3; ?>],
                                datasets: [{
                                    label: '',
                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)',
                                        'rgb(60, 179, 113)', 'rgb(175, 238, 239)',
                                        'rgb(242, 99, 255)', 'rgb(255,246,99)', 'rgb(255,144,0)',
                                        'rgb(113,255,136)', 'rgb(255,113,213)', 'rgb(113,213,255)',
                                        'rgb(140,113,255)', 'rgb(127,52,239)'
                                    ],
                                    borderColor: ['rgb(255, 99, 132)'],
                                    data: [<?php echo $jumlah2; ?>]
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                        </script>
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
                                        <th>No. Pegawai</th>
                                        <th>Nama Pegawai</th>
                                        <th>Keluhan</th>
                                        <th>Teknisi</th>
                                        <th>Tanggal Gangguan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $databaseHost = 'localhost';
                                    $databaseName = 'monitoring';
                                    $databaseUsername = 'root';
                                    $databasePassword = '';

                                    $db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
                                    $sql = "select*from gangguan, jenis_keluhan, teknisi where gangguan.id_jenis = jenis_keluhan.id_jenis and gangguan.id_teknisi = teknisi.id_teknisi order by tanggal_gangguan desc limit 5";
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
                                        <td><?php echo $user_data['no_pelanggan']; ?></td>
                                        <td><?php echo $user_data['nama_pelanggan']; ?></td>
                                        <td><?php echo $user_data['nama_keluhan']; ?></td>
                                        <td><?php echo $user_data['nama_teknisi']; ?></td>
                                        <td><?php echo $user_data['tanggal_gangguan']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="text-right">
                            <a href="data_gangguan.php">Lihat Semua Data Kesehatan <i
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
                                        <th>No. Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Keluhan</th>
                                        <th>Teknisi</th>
                                        <th>Tanggal Gangguan Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $databaseHost = 'localhost';
                                    $databaseName = 'monitoring';
                                    $databaseUsername = 'root';
                                    $databasePassword = '';

                                    $db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
                                    $sql = "select*from gangguan_selesai, jenis_keluhan, teknisi where gangguan_selesai.id_jenis = jenis_keluhan.id_jenis and gangguan_selesai.id_teknisi = teknisi.id_teknisi order by tanggal_selesai desc limit 5";
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
                                        <td><?php echo $user_data['no_pelanggan']; ?></td>
                                        <td><?php echo $user_data['nama_pelanggan']; ?></td>
                                        <td><?php echo $user_data['nama_keluhan']; ?></td>
                                        <td><?php echo $user_data['nama_teknisi']; ?></td>
                                        <td><?php echo $user_data['tanggal_selesai']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="text-right">
                            <a href="data_gangguan.php">Lihat Semua Data Kesehatan <i
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