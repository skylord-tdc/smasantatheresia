<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Fontfaces CSS-->
    <link href="login_admin/css/font-face.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="login_admin/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="login_admin/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="login_admin/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="login_admin/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="login_admin/images/logo-ypr.png" style="width: 140px; height:auto;" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">

                            <!-- notifkasi ketika gagal login -->
                            <?php
                            session_start();
                            if (isset($_SESSION['pesan1'])) {
                                echo '<p style="color: black ; text-align: center;">' . $_SESSION['pesan1'] . '<br>' . '<br>' . '</p>';
                                unset($_SESSION['pesan1']);
                            }
                            ?>
                            <form action="check-admin" method="post">


                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="pw" placeholder="Password">
                                </div>

                                <input type="submit" name="submit" class="au-btn au-btn--block au-btn--green m-b-20" value="sign in">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="login_admin/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="login_admin/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="login_admin/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="login_admin/vendor/slick/slick.min.js">
    </script>
    <script src="login_admin/vendor/wow/wow.min.js"></script>
    <script src="login_admin/vendor/animsition/animsition.min.js"></script>
    <script src="login_admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="login_admin/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="login_admin/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="login_admin/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="login_admin/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="login_admin/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="login_admin/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="login_admin/js/main.js"></script>

</body>

</html>
<!-- end document-->