<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>PPDB SMA SANTA THERESIA AIR MOLEK</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="registrasi/images/favicon.ico" />

    <!-- Icons font CSS-->
    <link href="registrasi/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="registrasi/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="registrasi/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="registrasi/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="registrasi/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-20 p-b-20 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">PENDAFTARAN AKUN</h2>

                    <!-- notifkasi pembuatan akun -->
                    <?php
                    session_start();

                    if (!empty($_SESSION["success"])) {
                        echo $_SESSION["success"];
                        unset($_SESSION["success"]);
                    }
                    ?>
                    <?php
                    if (!empty($_SESSION["warning"])) {
                        echo $_SESSION["warning"];
                        unset($_SESSION["warning"]);
                    }
                    ?>
                    <?php

                    if (!empty($_SESSION["danger"])) {
                        echo $_SESSION["danger"];
                        unset($_SESSION["danger"]);
                    } ?>

                    <form method="POST" action="register">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Nama" name="nm" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3 js-datepicker" type="text" placeholder="Tanggal Lahir" name="tgl_lhr" required>
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="jk" required>
                                    <option disabled="disabled" selected="selected">Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Alamat Email" name="email" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="number" placeholder="No Telepon" name="no_hp" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Kata Sandi" name="pw" required>
                        </div>
                        <div class="">
                            <button class="btn btn--green" style="width: 100%;" type="submit">Daftar</button> <br><br>
                            <a class="btn btn--green" style="text-decoration: none; width: 100%; text-align: center;" type="submit" href="start">Kembali</a>
                        </div>
                        <br><br>
                        <p style="color: aliceblue;">Sudah punya akun ? <a style="color: cyan; text-decoration: none;" href="autentikasi">Masuk</a> </p>
                    </form>

                </div>
                <br><br>
            </div>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="registrasi/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="registrasi/vendor/select2/select2.min.js"></script>
    <script src="registrasi/vendor/datepicker/moment.min.js"></script>
    <script src="registrasi/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="registrasi/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->