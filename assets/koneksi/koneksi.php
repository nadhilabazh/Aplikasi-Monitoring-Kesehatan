 <?php
  date_default_timezone_set('Asia/Jakarta');

  $server = "localhost";
  $user = "root";
  $pass = "";
  $database = "uas";

  $conect = mysqli_connect($server, $user, $pass, $database) or die('Error Connection Network');
  $hostname = "http://localhost/WEB/uas_NR1";

  ?>