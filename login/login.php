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
    <title>LOGIN</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="login/images/favicon.ico" />

    <!-- Icons font CSS-->
    <link href="login/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="login/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="login/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="login/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="login/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-20 p-b-20 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">LOGIN UNTUK PPDB</h2>

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

                    <!-- notifkasi ketika gagal login -->
                    <?php
                    if (isset($_SESSION['pesan'])) {
                        echo '<p style="color: white ;">' . $_SESSION['pesan'] . '<br>' . '<br>' . '</p>';
                        unset($_SESSION['pesan']);
                    }
                    ?>

                    <form method="POST" action="check">
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Alamat Email" name="email">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Kata Sandi" name="pw">
                        </div>
                        <div class="">
                            <input type="submit" name="submit" class="btn btn--green" style="width: 100%;" value="Masuk"><br><br>

                            <a class="btn btn--green" style="text-decoration: none; width: 100%; text-align: center;" href="start">Kembali</a>
                        </div>
                        <br><br>
                        <p style="color: aliceblue;">Belum punya akun ? <a style="color: cyan; text-decoration: none;" href="sign-up">Daftar</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="login/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="login/vendor/select2/select2.min.js"></script>
    <script src="login/vendor/datepicker/moment.min.js"></script>
    <script src="login/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="login/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->