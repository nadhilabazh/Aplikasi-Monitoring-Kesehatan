<?php
$title = "Data User";
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
                    Data User
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
                        <div class="col-lg-6">
                            <a href="tambah_user.php" title="Tambah User"><button name="input"
                                    class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Tambah User
                                </button> </a>
                        </div>
                        <div class="col-lg-6">
                            <form action="cari_data_user.php" method="get" class="form-inline text-right">
                                <input type="text" class="form-control" name="nama"
                                    placeholder="Masukkan Nama" required>
                                <button type="submit" class="btn btn-success">Cari</button>
                            </form>
                        </div>
                        <div style="clear:both;"></div>
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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Level</th>
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

                                    $ambildata = mysqli_query($conect, "select*from user order by id desc limit $posisi, $batas");
                                    $jumlah = mysqli_num_rows($ambildata);  /*mysql_num_rows untuk menghitung total baris di tabel databse*/
                                    if ($jumlah == 0) {  //jika tidak ada data
                                    ?>
                                    <tr>
                                        <td colspan="6">Tidak Terdapat Data</td>
                                    </tr>
                                    <?php
                                    } else {
                                        //jika ada data di tb_brand
                                        while ($a = mysqli_fetch_array($ambildata)) { /*mysql_fetch array untuk mengambil data di setiap field di tabel databse*/
                                        ?>
                                    <tr>
                                        <td><?php echo $posisi = $posisi + 1; ?></td>
                                        <td><?php echo $a['nama']; ?></td>
                                        <td><?php echo $a['username']; ?></td>
                                        <td><?php echo md5($a['password']); ?></td>
                                        <td><?php echo $a['level']; ?></td>
                                        <td>
                                            <a href="edit_data_user.php?id=<?php echo $a['id']; ?>"
                                                title="Edit data"><button class="btn btn-primary btn-sm"><i
                                                        class="fa fa-pencil-square-o fa-fw"></i> Edit</button> </a>
                                            <a href="hapus_data_user.php?id=<?php echo $a['id']; ?>"
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
                            $jml_data = mysqli_num_rows(mysqli_query($conect, "select*from user order by id desc"));
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
                            <span class="text-muted">Menampilkan <?php echo $jumlah; ?> dari
                                <?php echo $jml_data; ?>
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