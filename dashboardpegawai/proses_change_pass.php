<?php

//panggil koneksi database
include "../assets/koneksi/koneksi.php";

//enkripsi inputan password lama
$password_lama = md5($_POST['pass_lama']);

//panggil username
$data_user = $_POST['data_user'];

//uji jika password lama sesuai
$query="select * from user where  username = '$data_user' and password =
                                    '$password_lama'";
$sql = mysqli_query($conect,$query);
$data = mysqli_fetch_array($sql);


//jika data ditemukan, maka password sesuai
if ($data) {
    //uji jika password baru dan konfirmasi password sama
    $password_baru = $_POST['pass_baru'];
    $konfirmasi_password = $_POST['konfirmasi_pass'];

    if($password_baru == $konfirmasi_password){
        //proses ganti password
        //enkripsi password baru
        $pass_ok = md5($konfirmasi_password);
        $ubah = mysqli_query($conect, "UPDATE user set password = '$pass_ok'
                                        WHERE id = '$data[id]' ");
        if ($ubah){
            echo "<script>alert('Password anda berhasil diubah, silahkan logout untuk menguji password baru anda.!);
            document.location='change_pass.php'</script>";
        }
    }else {
        echo "<script>alert('Maaf, Password Baru & Konfirmasi password anda inputkan tidak sama!');
    document.location='change_pass.php'</script>";
    }
} else{
    echo "<script>alert('Password anda berhasil diubah, silahkan logout untuk menguji password baru anda.!');
    document.location='change_pass.php'</script>";
}

?>