<?php
session_start();

// cek user yg login
if (!isset($_SESSION['uuid'])) { //jika session tidak terdeteksi
    header('location: silahkan-login-dahulu'); //mengarahkan kembali ke halaman login
    exit; //menghentikan eksekusi script selanjutnya
}

// Set session sebagai online
$_SESSION['online'] = true;

// Menampilkan status online pada halaman user
echo "<script type='text/javascript'>
window.location='hi-selamat-datang';
</script>";

// Mengambil data user dari database
include '../koneksi/cf.php';
$result = mysqli_query($conn, "SELECT * FROM akun_ppdb WHERE uuid = '$_SESSION[uuid]'");
$user = mysqli_fetch_assoc($result);

// Memperbarui status online user pada database
if ($_SESSION['online']) {
    mysqli_query($conn, "UPDATE akun_ppdb SET status = 'online' WHERE uuid = '$_SESSION[uuid]'");
}
