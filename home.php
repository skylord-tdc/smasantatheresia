<?php
include 'logout/all_user_ppdb_offline.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Official - SMA SANTA THERESIA AIR MOLEK</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container">
            <a class="navbar-brand" href="start">SMA SANTA THERESIA AIR MOLEK</a>
            <a class="btn btn-primary" href="autentikasi">Daftar</a>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <!-- Page heading-->

                        <h1 class="mb-5">CEK HASIL SELEKSI KAMU DISINI</h1>


                        <!-- notifkasi ketika gagal mencari nisn -->
                        <?php

                        if (isset($_SESSION['pesan_nisn'])) {
                            echo '<p style="color: white ;">' . $_SESSION['pesan_nisn'] . '<br>' . '<br>' . '</p>';
                            unset($_SESSION['pesan_nisn']);
                        }
                        ?>
                        <form action="cari-nisn" class="form-subscribe" id="contactForm" data-sb-form-api-token="API_TOKEN" method="get">
                            <!-- Email address input-->
                            <div class="row">

                                <div class="col">
                                    <input class="form-control form-control-lg" name="nisn" type="number" placeholder="Masukkan NISN" required />
                                </div>
                                <div class="col-auto"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Cari</button></div>

                            </div>
                            <p class="mt-3">Ketika NISN kamu terdaftar saat melakukan pencarian maka secara otomatis akan mengunduh file dalam bentuk PDF.</p>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Icons Grid-->

    <!-- Image Showcases-->
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-1.jpg')"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>TATA CARA PENDAFTARAN</h2>

                    <ol>
                        <li>Pendaftar membuat akun dengan mengisikan email yang valid, nomor Handpone (HP) yang aktif, NISN nama Ibu Kandung dan password.</li>
                        <li>Memilih Jurusan yang diminati.</li>
                        <li>Melengkapi Biodata Pribadi</li>

                    </ol>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-6 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-2.jpg')"></div>
                <div class="col-lg-6 my-auto showcase-text">
                    <h2>CARA MELIHAT HASIL SELEKSI</h2>
                    <ol>
                        <li>Buka Laman Sekolah ini</li>
                        <li>Masukkan NISN sesuai data saat melakukan pendaftaran</li>
                        <li>Website akan menampilkan keterangan lulus atau tidak lulusnya</li>
                    </ol>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-3.jpg')"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>PROSES SELEKSI</h2>
                    <ol>
                        <li>Mengikuti ujian yang diadakan oleh sekolah</li>
                        <li>Melihat hasil seleksi melalui website ini</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials-->
    <section class="testimonials text-center bg-light">
        <div class="container">
            <h2 class="mb-5">CONTACT US</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="assets/img/testimonials-1.png" alt="..." />
                        <h5>KEPALA SEKOLAH</h5>
                        <p class="font-weight-light mb-0">"Ferdinandus Nipa"</p>
                        <p>No Telepon 085643567654</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="assets/img/testimonials-2.png" alt="..." />
                        <h5>BIDANG KURIKULUM</h5>
                        <p class="font-weight-light mb-0">"Efayanti Pardede S.Pd"</p>
                        <p>No Telepon 085643567654</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="assets/img/testimonials-3.png" alt="..." />
                        <h5>BIDANG KESISWAAN</h5>
                        <p class="font-weight-light mb-0">"Helentina Tarigan S.Pd!"</p>
                        <p>No Telepon 085643567654</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action-->

    <!-- Footer-->
    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="autentikasi-admin">Login</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; SMA SANTA THERESIA AIR MOLEK.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-4">
                            <a href="https://www.facebook.com/SMASanTher/"><i class="bi-facebook fs-3"></i></a>
                        </li>
                        <!-- <li class="list-inline-item me-4">
                            <a href="#!"><i class="bi-twitter fs-3"></i></a>
                        </li> -->
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/smasanther/?hl=id"><i class="bi-instagram fs-3"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

</body>

</html>