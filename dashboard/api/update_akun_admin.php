<?php
include '../../koneksi/cf.php';

if (isset($_POST['secure'])) {
    $secure     = $_POST['secure'];

    $nm         = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['nm']);
    $jk         = $_POST['jk'];
    $email      = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pw         = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['pw']);

    $sql = $conn->prepare("UPDATE akun_admin SET nm=?, jk=?, email=?, pw=? WHERE secure=?");
    $sql->bind_param('sssss', $nm, $jk, $email, $pw, $secure);
    $sql->execute();
    if ($sql) {
        // echo json_encode(array('RESPONSE' => 'SUCCESS'));
        session_start();
        $_SESSION["success"] = '<div class=" container alert alert-success" role="alert" >Berhasil Update Akun. Silahkan Logout & Login Lagi Untuk Melihat Perubahan.</div>';
        // echo
        // "<script type='text/javascript'>
        //     window.location='selamat-datang-admin';
        // </script>";
        echo
        "<script type='text/javascript'>
             window.history.back()
        </script>";
    } else {
        echo json_encode(array('RESPONSE' => 'FAILED'));
    }
} else {
    echo "GAGAL";
}
