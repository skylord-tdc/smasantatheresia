<?php

// Mengambil data user dari database
// include 'koneksi/cf.php';

// Memperbarui status offline all user ppdb pada database
// mysqli_query($conn, "UPDATE akun_ppdb SET status = 'offline'");

// Memulai session
session_start();

// Mengecek apakah session UUID tersedia
if (isset($_SESSION['uuid'])) {
    // Mengambil data user dari database
    include 'koneksi/cf.php';
    // Memperbarui status offline all user ppdb pada database
    mysqli_query($conn, "UPDATE akun_ppdb SET status = 'offline'");

    // Menutup koneksi database
    mysqli_close($conn);
}
