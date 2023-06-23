<?php
session_start();

// Set session sebagai offline
$_SESSION['offline'] = true;

// Mengambil data user dari database
include '../koneksi/cf.php';
$result = mysqli_query($conn, "SELECT * FROM akun_ppdb WHERE uuid = '$_SESSION[uuid]'");
$user = mysqli_fetch_assoc($result);

// Memperbarui status offlineuser pada database
if ($_SESSION['offline']) {
    mysqli_query($conn, "UPDATE akun_ppdb SET status = 'offline' WHERE uuid = '$_SESSION[uuid]'");
}

// hapus session jika user sudah login
if (isset($_SESSION['uuid'])) {
    unset($_SESSION['uuid']); // menghapus session user

    // echo "Session berhasil dihapus.";
    header("location:start");
} else {
    echo "Session tidak ditemukan.";
}
