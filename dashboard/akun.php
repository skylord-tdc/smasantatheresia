<?php
session_start(); //memulai session

// cek user yg login
if (!isset($_SESSION['secure'])) { //jika session tidak terdeteksi
    header('location: silahkan-login-dahulu-admin'); //mengarahkan kembali ke halaman login
    exit; //menghentikan eksekusi script selanjutnya
}

unset($_SESSION['uuid']);

function http_request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// menampilkan data
$d1 = http_request("http://localhost/smasantatheresia/dashboard/api/tampil.php");
$d1 = json_decode($d1, TRUE);
// menampilkan data end

// mengedit data 
$d3 = http_request("http://localhost/smasantatheresia/dashboard/api/tampil_edit_akun.php?secure=$_SESSION[secure]");
$d3 = json_decode($d3, TRUE);
// mengedit data end
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SMA SANTA THERESIA</title>

    <link rel="stylesheet" href="dashboard/assets/css/bootstrap.css">

    <link rel="stylesheet" href="dashboard/assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="dashboard/assets/css/app.css">
    <link rel="shortcut icon" href="dashboard/assets/images/favicon.ico" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="dashboard/assets/images/logo-ypr.png" style="width: 99px ; height:auto;" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class='sidebar-title'>Main Menu</li>



                        <li class="sidebar-item">

                            <a href="menu-dashboard" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>


                        </li>


                        <li class="sidebar-item active">

                            <a href="menu-akun-pengguna" class='sidebar-link'>
                                <i data-feather="user" width="20"></i>
                                <span>Akun Pengguna</span>
                            </a>


                        </li>



                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="dashboard/assets/images/avatar/<?php echo $_SESSION['jk']; ?>.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $_SESSION['nm']; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <button class="dropdown-item" type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#seting-akun">
                                    <i data-feather="user"></i> Account</a>
                                </button>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="log-out"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Selamat Datang Admin</h3>
                            <p class="text-subtitle text-muted">Olah Data Akun Pengguna Pada Laman ini.</p>
                        </div>

                    </div>
                </div>
                <section class="section">

                    <div class="card">

                        <div class="card-body">
                            <a href="../ppdb/last_active.txt" target="_blank">Lihat History Akses Pengguna</a>
                        </div>

                        <div class="container-fluid p-3">
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

                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($d1 as $d1) { ?>
                                        <tr>
                                            <td>

                                                <div style="
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: space-between;
                                                ">
                                                    <div style="margin-right: 5px;">
                                                        <!-- button trigger for  Vertically Centered modal -->
                                                        <button type="button" class="btn btn-sm btn-outline-primary" style="width: 100% ;" data-bs-toggle="modal" data-bs-target="#view<?php echo $d1['id'] ?>">
                                                            Detail
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <!-- Button trigger for BorderLess Modal -->
                                                        <button type="button" class="btn btn-sm btn-outline-danger" style="width: 100% ;" data-bs-toggle="modal" data-bs-target="#del<?php echo $d1['id'] ?>">
                                                            Delete
                                                        </button>
                                                    </div>

                                                </div>

                                                <!-- Vertically Centered modal Modal -->
                                                <div class="modal fade" id="view<?php echo $d1['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $d1['nm'] ?></h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- // Basic multiple Column Form section start -->
                                                                <section id="multiple-column-form">
                                                                    <div class="row match-height">
                                                                        <div class="col-12">
                                                                            <div class="">
                                                                                <div class="card-header">
                                                                                    <h4 class="card-title">Profil Akun</h4>
                                                                                </div>
                                                                                <div class="card-content">
                                                                                    <div class="card-body">
                                                                                        <form class="form">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="first-name-column">Tanggal Lahir</label>
                                                                                                        <input type="text" id="first-name-column" class="form-control" disabled value="<?php echo $d1['tgl_lhr'] ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="last-name-column">Jenis Kelamin</label>
                                                                                                        <input type="text" id="first-name-column" class="form-control" disabled value="<?php echo $d1['jk'] ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="city-column">Email</label>
                                                                                                        <input type="email" id="first-name-column" class="form-control" disabled value="<?php echo $d1['email'] ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="country-floating">No Handphone</label>
                                                                                                        <input type="number" id="first-name-column" class="form-control" disabled value="<?php echo $d1['no_hp'] ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-12 col-12">
                                                                                                    <div class="form-group has-icon-left">
                                                                                                        <label for="password-id-icon">Password</label>
                                                                                                        <div class="position-relative">
                                                                                                            <input type="text" class="form-control" disabled value="<?php echo $d1['uuid'] ?>" id="password-id-icon">
                                                                                                            <div class="form-control-icon">
                                                                                                                <i data-feather="lock"></i>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <!-- // Basic multiple Column Form section end -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary ml-1" data-bs-dismiss="modal">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--BorderLess Modal Modal -->
                                                <div class="modal fade text-left modal-borderless" id="del<?php echo $d1['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Peringatan</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <p>
                                                                    Akun bernama <b><?php echo $d1['nm'] ?></b> ini akan di hapus beserta berkas yang sudah pernah di upload oleh pengguna ini.
                                                                    Data yang dimaksud adalah :
                                                                    <b>formulir pendaftaran, dan berkas upload</b>. Dimohon untuk lebih teliti lagi, jika
                                                                    sudah yakin maka anda bisa melanjutkan tindakan hapus pada akun ini beserta isinya.
                                                                </p>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <a href="menu-akun-pengguna/format-data/<?php echo $d1['uuid'] ?>" class="btn btn-primary ml-1">Accept</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $d1['nm'] ?></td>
                                            <td><?php echo $d1['email'] ?></td>
                                            <td><?php echo $d1['jk'] ?></td>
                                            <td>
                                                <?php
                                                $st = $d1['status'];

                                                if ($st == 'online') {
                                                    echo "<span class='badge bg-success'>$d1[status]</span>";
                                                } else {
                                                    echo "<span class='badge bg-danger'>$d1[status]</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

        </div>
    </div>

    <!--update form Modal -->
    <div class="modal fade text-left" id="seting-akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Akun Admin </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="update-akun" method="post">
                    <div class="modal-body">
                        <label>Nama: </label>
                        <div class="form-group">
                            <input type="text" name="nm" value="<?= $d3["nm"] ?>" class="form-control">
                            <input type="hidden" name="secure" value="<?php echo $_SESSION['secure'] ?>">
                        </div>
                        <label>Jenis Kelamin: </label>
                        <div class="form-group">
                            <select name="jk" id="" class="form-control">
                                <option value="<?= $d3["jk"] ?>"><?= $d3["jk"] ?></option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <label>Email: </label>
                        <div class="form-group">
                            <input type="email" name="email" value="<?= $d3["email"] ?>" class="form-control">
                        </div>
                        <label>Password: </label>
                        <div class="form-group">
                            <input type="password" name="pw" value="<?= $d3["pw"] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="dashboard/assets/js/feather-icons/feather.min.js"></script>
    <script src="dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="dashboard/assets/js/app.js"></script>

    <script src="dashboard/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="dashboard/assets/js/vendors.js"></script>

    <script src="dashboard/assets/js/main.js"></script>


</body>

</html>