<?php
include '../../koneksi/cf.php';

if (isset($_POST['submit'])) {

    //bypas karakter
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $pw             = mysqli_real_escape_string($conn, $_POST['pw']);
    //end bypas karakter

    $q = mysqli_query($conn, "SELECT * FROM akun_ppdb WHERE email = '$email' AND pw = '$pw'");


    if ($q->num_rows > 0) {
        $d = $q->fetch_assoc();

        // cek role user
        if ($_SESSION['role'] = $d['role'] == 1) {
            header('Location: pendaftaran-peserta-didik-baru');
            session_start();
            $_SESSION['role'] = $d['role'];
            $_SESSION['uuid'] = $d['uuid'];
            $_SESSION['nm'] = $d['nm'];
            $_SESSION['jk'] = $d['jk'];
            $_SESSION['email'] = $d['email'];
        }
    } else {
        // session untuk pesan 
        session_start();
        $_SESSION['pesan'] = "Username atau Password tidak valid";
        echo
        "<script type='text/javascript'>
         window.location='autentikasi';
         </script>";
    }
}
