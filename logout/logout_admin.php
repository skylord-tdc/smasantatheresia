<?php
session_start();

// hapus session jika user sudah login
if (isset($_SESSION['secure'])) {
    unset($_SESSION['secure']); // menghapus session user

    // echo "Session berhasil dihapus.";
    header("location:start");
} else {
    echo "Session tidak ditemukan.";
}
