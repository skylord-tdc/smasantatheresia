<?php
include '../../koneksi/cf.php';

// generate_uuid
function generate_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
$uuid = generate_uuid();

// akun ppdb
$nm        = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['nm']);
$tgl_lhr   = $_POST['tgl_lhr'];
$jk        = $_POST['jk'];
$email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$no_hp     = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['no_hp']);
$pw        = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['pw']);

$query = "INSERT INTO akun_ppdb (uuid, nm, tgl_lhr, jk, email, no_hp, pw) VALUES ('$uuid', '$nm', '$tgl_lhr', '$jk', '$email', '$no_hp', '$pw')";
$result = mysqli_query($conn, $query);

if ($result) {
    // echo "Data berhasil disimpan";

    // alert boostrap
    session_start();
    $_SESSION["success"] = '<div class="alert alert-success" role="alert" style="color: white;">Berhasil. Silahkan Login.<br><br></div>';
    //   end alert
    echo
    "<script type='text/javascript'>
        window.location='autentikasi';
    </script>";
} else {
    if (mysqli_errno($conn) == 1062) {
        // echo "Email sudah terdaftar";

        // alert boostrap
        session_start();
        $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" style="color: white;">Terjadi kesalahan. Email Sudah Digunakan.<br><br></div>';
        //   end alert
        echo
        "<script type='text/javascript'>
        window.location='sign-up';
        </script>";
    } else {
        echo "Data gagal disimpan: " . mysqli_error($conn);
    }
}
