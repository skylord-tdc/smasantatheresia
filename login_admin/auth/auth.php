<?php
include '../../koneksi/cf.php';

if (isset($_POST['submit'])) {

    //bypas karakter
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $pw             = mysqli_real_escape_string($conn, $_POST['pw']);
    //end bypas karakter 

    $q1 = mysqli_query($conn, "SELECT * FROM akun_admin WHERE email = '$email' AND pw = '$pw'");

    if ($q1->num_rows > 0) {
        $d1 = $q1->fetch_assoc();

        // cek role user
        if ($_SESSION['aktor'] = $d1['aktor'] == 0) {
            echo
            "<script type='text/javascript'>
                window.location='selamat-datang-admin';
             </script>";
            session_start();
            $_SESSION['aktor'] = $d1['aktor'];
            $_SESSION['secure'] = $d1['secure'];
            $_SESSION['nm'] = $d1['nm'];
            $_SESSION['jk'] = $d1['jk'];
            $_SESSION['email'] = $d1['email'];
        }
    } else {
        // session untuk pesan 
        session_start();
        $_SESSION['pesan1'] = "Username atau Password tidak valid";
        echo
        "<script type='text/javascript'>
         window.location='autentikasi-admin';
         </script>";
    }
}
