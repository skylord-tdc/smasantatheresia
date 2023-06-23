<?php

session_start(); //memulai session

// cek user yg login
if (!isset($_SESSION['uuid'])) { //jika session tidak terdeteksi
    header('location: silahkan-login-dahulu'); //mengarahkan kembali ke halaman login
    exit; //menghentikan eksekusi script selanjutnya 
}

unset($_SESSION['secure']);

// simpan ket online or offline
$username = $_SESSION['email'];
$file_path = "last_active.txt";
// Tuliskan waktu akses ke dalam file "last_active.txt"
file_put_contents($file_path, "$username " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);


function http_request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// mengedit data 
$d2 = http_request("http://localhost/smasantatheresia/ppdb/api/tampil_edit.php?uuid=$_SESSION[uuid]");
$d2 = json_decode($d2, TRUE);
// mengedit data end

// menampilkan data
$d1 = http_request("http://localhost/smasantatheresia/ppdb/api/tampil.php?uuid=$_SESSION[uuid]");
$d1 = json_decode($d1, TRUE);
// menampilkan data end
?>

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
    <title>FORM PPDB</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="ppdb/images/icon/favicon.ico" />

    <!-- Fontfaces CSS-->
    <link href="ppdb/css/font-face.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="ppdb/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="ppdb/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="ppdb/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="ppdb/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo mt-3" href="form.php">
                            <img src="ppdb/images/icon/logo.png" alt="logo sekolah" />
                        </a>

                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">

                        <li>
                            <a href="pendaftaran-peserta-didik-baru">
                                <i class="far fa-check-square"></i>Form PPDB</a>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="pendaftaran-peserta-didik-baru">
                    <img src="ppdb/images/icon/logo.png" alt="logo sekolah" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li class="active">
                            <a href="pendaftaran-peserta-didik-baru">
                                <i class="far fa-check-square"></i>Forms PPDB</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div></div>

                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="ppdb/images/icon/<?php echo $_SESSION['jk']; ?>.png" alt="<?php echo $_SESSION['nm']; ?>" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['nm']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="ppdb/images/icon/<?php echo $_SESSION['jk']; ?>.png" alt="<?php echo $_SESSION['nm']; ?>" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['nm']; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['email']; ?></span>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer">
                                                <a href="out">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div>
                            <?php

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
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card" style="width: 100% ;">
                                    <div class="card-header">Data Diri</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Calon Siswa</h3>
                                        </div>
                                        <hr>

                                        <div>

                                            <?php
                                            include '../koneksi/cf.php';
                                            $sql1 = mysqli_query($conn, "SELECT DISTINCT uuid FROM form_ppdb where uuid='$_SESSION[uuid]' ");
                                            $cek1 = mysqli_num_rows($sql1);
                                            if ($cek1 == 0) {
                                                echo "
                                                <div class='alert alert-warning'>
                                                    <strong>Silahkan Lengkapi Data Diri Kamu.</strong>
                                                </div>

                                                <form action='form-ppdb' method='post'>
                                                

                                                <div class='form-group'>
                                                    <label for='cc-payment' class='control-label mb-1'>NISN</label>
                                                    <input id='cc-pament' name='nisn' type='number' class='form-control' required>
                                                    <input type='hidden' name='uuid' value='$_SESSION[uuid]'>
                                                </div>
                                                <div class='form-group has-success'>
                                                    <label for='cc-name' class='control-label mb-1'>Nama Peserta</label>
                                                    <input id='cc-name' name='nm_peserta' type='text' class='form-control cc-name valid' data-val='true' data-val-required='Please enter the name' autocomplete='cc-name' aria-required='true' aria-invalid='false' aria-describedby='cc-name-error' required>
                                                    <span class='help-block field-validation-valid' data-valmsg-for='cc-name' data-valmsg-replace='true'></span>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='cc-number' class='control-label mb-1'>Tempat Lahir</label>
                                                    <input id='cc-number' name='tmpt_lhr' type='text' class='form-control cc-number identified visa' value='' data-val='true' data-val-required='Please enter the card number' data-val-cc-number='Please enter a valid card number' autocomplete='cc-number' required>
                                                    <span class='help-block' data-valmsg-for='cc-number' data-valmsg-replace='true'></span>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Tanggal Lahir</label>
                                                            <input id='cc-exp' name='tgl_lhr' type='date' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <label for='cc-exp' class='control-label mb-1'>Agama</label>
                                                        <select name='agama' id='select' class='form-control' required>
                                                            <option value='' selected disabled>Pilih Agama</option>
                                                            <option value='Kristen'>Kristen</option>
                                                            <option value='Islam'>Islam</option>
                                                            <option value='Katolik'>Katolik</option>
                                                            <option value='Hindu'>Hindu</option>
                                                            <option value='Buddha'>Buddha</option>
                                                            <option value='Konghucu'>Konghucu</option>
                                                        </select>
    
                                                    </div>
                                                    <div class='col-12'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Alamat</label>
                                                            <input id='cc-exp' name='alamat' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>No Telepon</label>
                                                            <input id='cc-exp' name='no_hp' type='number' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
    
    
                                                    </div>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Jurusan</label>
                                                            <select name='jurusan' id='select' class='form-control' required>
                                                                <option value='' selected disabled>Pilih Jurusan</option>
                                                                <option value='IPA'>IPA</option>
                                                                <option value='IPS'>IPS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class='card-title'>
                                                    <h3 class='text-center title-2'>Ayah</h3>
                                                </div>
                                                <hr>
    
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nama Ayah</label>
                                                            <input id='cc-exp' name='nm_ayah' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pendidikan Terakhir Ayah</label>
                                                            <input id='cc-exp' name='pend_ayah' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pekerjaan Ayah</label>
                                                            <input id='cc-exp' name='pek_ayah' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nomor Telepon Ayah</label>
                                                            <input id='cc-exp' name='no_hp_ayah' type='number' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                                <br>
                                                <div class='card-title'>
                                                    <h3 class='text-center title-2'>Ibu</h3>
                                                </div>
                                                <hr>
    
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nama Ibu</label>
                                                            <input id='cc-exp' name='nm_ibu' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pendidikan Terakhir Ibu</label>
                                                            <input id='cc-exp' name='pend_ibu' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pekerjaan Ibu</label>
                                                            <input id='cc-exp' name='pek_ibu' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nomor Telepon Ibu</label>
                                                            <input id='cc-exp' name='no_hp_ibu' type='number' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                </div>
    
    
    
                                                <div>
                                                    <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block'>
                                                        <i class='fa fa-floppy-o'></i>&nbsp;
                                                        <span id='payment-button-amount'>SIMPAN</span>
                                                        <span id='payment-button-sending' style='display:none;'>Sending…</span>
                                                    </button>
                                                </div>
                                            </form>
                                                ";
                                            } else {
                                                echo "
                                                <form action='update' method='post' novalidate='novalidate'>

                                                <div class='form-group'>
                                                    <label for='cc-payment' class='control-label mb-1'>NISN</label>
                                                    <input id='cc-pament' name='nisn' value='$d2[nisn]' type='number' class='form-control' aria-required='true' aria-invalid='false' required>
                                                    <input type='hidden' name='uuid' value='$d2[uuid]'>
                                                </div>
                                                <div class='form-group has-success'>
                                                    <label for='cc-name' class='control-label mb-1'>Nama Peserta</label>
                                                    <input id='cc-name' name='nm_peserta' value='$d2[nm_peserta]' type='text' class='form-control cc-name valid' data-val='true' data-val-required='Please enter the name' autocomplete='cc-name' aria-required='true' aria-invalid='false' aria-describedby='cc-name-error' required>
                                                    <span class='help-block field-validation-valid' data-valmsg-for='cc-name' data-valmsg-replace='true'></span>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='cc-number' class='control-label mb-1'>Tempat Lahir</label>
                                                    <input id='cc-number' name='tmpt_lhr' value='$d2[tmpt_lhr]' type='text' class='form-control cc-number identified visa' value='' data-val='true' data-val-required='Please enter the card number' data-val-cc-number='Please enter a valid card number' autocomplete='cc-number' required>
                                                    <span class='help-block' data-valmsg-for='cc-number' data-valmsg-replace='true'></span>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Tanggal Lahir</label>
                                                            <input id='cc-exp' name='tgl_lhr' value='$d2[tgl_lhr]' type='date' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <label for='cc-exp' class='control-label mb-1'>Agama</label>
                                                        <select name='agama' id='select' class='form-control' required>
                                                            <option selected value='$d2[agama]'>$d2[agama]</option>
                                                            <option value='Kristen'>Kristen</option>
                                                            <option value='Islam'>Islam</option>
                                                            <option value='Katolik'>Katolik</option>
                                                            <option value='Hindu'>Hindu</option>
                                                            <option value='Buddha'>Buddha</option>
                                                            <option value='Konghucu'>Konghucu</option>
                                                        </select>
    
                                                    </div>
                                                    <div class='col-12'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Alamat</label>
                                                            <input id='cc-exp' name='alamat' value='$d2[alamat]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>No Telepon</label>
                                                            <input id='cc-exp' name='no_hp' value='$d2[no_hp]' type='number' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
    
                                                    </div>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Jurusan</label>
                                                            <select name='jurusan' id='select' class='form-control' required>
                                                                <option selected value='$d2[jurusan]'>$d2[jurusan]</option>
                                                                <option value='IPA'>IPA</option>
                                                                <option value='IPS'>IPS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class='card-title'>
                                                    <h3 class='text-center title-2'>Ayah</h3>
                                                </div>
                                                <hr>
    
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nama Ayah</label>
                                                            <input id='cc-exp' name='nm_ayah' value='$d2[nm_ayah]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pendidikan Terakhir Ayah</label>
                                                            <input id='cc-exp' name='pend_ayah' value='$d2[pend_ayah]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pekerjaan Ayah</label>
                                                            <input id='cc-exp' name='pek_ayah' value='$d2[pek_ayah]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nomor Telepon Ayah</label>
                                                            <input id='cc-exp' name='no_hp_ayah' value='$d2[no_hp_ayah]' type='number' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                                <br>
                                                <div class='card-title'>
                                                    <h3 class='text-center title-2'>Ibu</h3>
                                                </div>
                                                <hr>
    
                                                <div class='row'>
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nama Ibu</label>
                                                            <input id='cc-exp' name='nm_ibu' value='$d2[nm_ibu]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pendidikan Terakhir Ibu</label>
                                                            <input id='cc-exp' name='pend_ibu' value='$d2[pend_ibu]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Pekerjaan Ibu</label>
                                                            <input id='cc-exp' name='pek_ibu' value='$d2[pek_ibu]' type='text' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                    <div class='col-6'>
                                                        <div class='form-group'>
                                                            <label for='cc-exp' class='control-label mb-1'>Nomor Telepon Ibu</label>
                                                            <input id='cc-exp' name='no_hp_ibu' value='$d2[no_hp_ibu]' type='number' class='form-control cc-exp' value='' data-val='true' data-val-required='Please enter the card expiration' data-val-cc-exp='Please enter a valid month and year' autocomplete='cc-exp' required>
                                                            <span class='help-block' data-valmsg-for='cc-exp' data-valmsg-replace='true'></span>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                                <div>
                                                    <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block'>
                                                        <i class='fa fa-pencil-square-o'></i>&nbsp;
                                                        <span id='payment-button-amount'>UPDATE</span>
                                                        <span id='payment-button-sending' style='display:none;'>Sending…</span>
                                                    </button>
                                                </div>
                                            </form>                                                
                                            ";
                                            }
                                            ?>

                                        </div>

                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <?php

                                $sql2 = mysqli_query($conn, "SELECT DISTINCT uuid FROM upload_berkas where uuid='$_SESSION[uuid]' ");
                                $cek2 = mysqli_num_rows($sql2);
                                if ($cek2 == 0) {
                                    echo "
                                    <div class='alert alert-warning'>
                                        <strong>Belum Ada Unggahan.</strong>
                                    </div>

                                    <div class='card' style='width: 100% ;'>
                                    <div class='card-header'>Upload Berkas Scan</div>
                                    <div class='card-body'>

                                            <form action='up-berkas' method='post' enctype='multipart/form-data'>
                                                <div class='row form-group'>
                                                    <div class='col col-md-12'>
                                                        <label for='file-multiple-input' class=' form-control-label'>Ijazah, KK, Akta, Scan Rapor</label>
                                                        <p style='font-style: italic ;'>*Silahkan Pilih Berkas Sekaligus</>
                                                    </div>
                                                    <div class='mt-5 col-12 col-md-9'>
                                                        <input type='file' name='files[]' multiple class='form-control-file' required>
                                                        <input type='hidden' name='uuid' value='$_SESSION[uuid]'>
                                                    </div>
                                                </div>

                                                <div>
                                                    <button id='payment-button' type='submit' class='btn btn-lg btn-info btn-block'>
                                                        <i class='fa fa-cloud'></i>&nbsp;
                                                        <span id='payment-button-amount'>UPLOAD</span>
                                                        <span id='payment-button-sending' style='display:none;'>Sending…</span>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                            ";
                                } else {

                                    echo "
                                        <div class='table-responsive table--no-card m-b-40'>
                                            <table class='table table-borderless table-striped table-earning'>
                                                <thead>

                                                    <tr>
                                                        <th>Berkas</th>
                                                        <th>
                                                           Action
                                                        </th>
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody> 
                                        ";

                                    foreach ($d1 as $d1) {

                                        echo "
                                                    <tr>
                                                        <td >
                                                            <img src='ppdb/uploads/$d1[name]' alt='$d1[name]' style='width: 100%; height: 100px; object-fit: cover;'>
                                                        </td>

                                                        <td >
                                                            <a class='btn btn-danger btn-block' href='pendaftaran-peserta-didik-baru/hapus-berkas/$d1[name]'>Hapus</a>
                                                        </td>
                                                    </tr> 
                                            ";
                                    }

                                    echo "
                                                </tbody>
                                            </table>
                                        </div>
                                     ";
                                }
                                ?>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src=" ppdb/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="ppdb/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="ppdb/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="ppdb/vendor/slick/slick.min.js">
    </script>
    <script src="ppdb/vendor/wow/wow.min.js"></script>
    <script src="ppdb/vendor/animsition/animsition.min.js"></script>
    <script src="ppdb/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="ppdb/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="ppdb/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="ppdb/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="ppdb/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="ppdb/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="ppdb/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="ppdb/js/main.js"></script>

</body>

</html>
<!-- end document-->