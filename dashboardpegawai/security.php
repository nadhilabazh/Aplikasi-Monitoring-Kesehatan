<?php
if (!isset($_SESSION['data_user'])) {
        header('location:logout.php');
} else {
        $akun = $_SESSION['data_user'];
        $admin = mysqli_fetch_array(mysqli_query($conect, "SELECT * FROM user where username='$akun'"));
}