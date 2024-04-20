<?php
include('../assets/koneksi/koneksi.php');
require_once("../assets/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($conect,"select*from kesehatan, pegawai where kesehatan.nip =  pegawai.nip");
$html = '<center><h3>LAPORAN DATA KESEHATAN</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th>No</th>
 <th>Id Kesehatan</th>
 <th>NIP</th>
 <th>Nama</th>
 <th>Status Kesehatan</th>
 <th>Deskripsi</th>
 <th>Tanggal Periksa</th>
 </tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr>
 <td>".$no."</td>
 <td>".$row['id_kesehatan']."</td>
 <td>".$row['nip']."</td>
 <td>".$row['nama']."</td>
 <td>".$row['status_kesehatan']."</td>
 <td>".$row['deskripsi']."</td>
 <td>".$row['tgl_periksa']."</td>
 </tr>";
 $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_kesehatan.pdf');
?>