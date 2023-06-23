<?php
//memulai session
session_start();

// cek user yg login
if (!isset($_SESSION['secure'])) {
    header('location: silahkan-login-dahulu-admin');
    exit;
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
$d1 = http_request("http://localhost/smasantatheresia/dashboard/api/tampil_peserta.php");
$d1 = json_decode($d1, TRUE);
// menampilkan data end

// menampilkan data
$d2 = http_request("http://localhost/smasantatheresia/dashboard/api/tampil_hasil_seleksi.php");
$d2 = json_decode($d2, TRUE);
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



                        <li class="sidebar-item active ">

                            <a href="menu-dashboard" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>


                        </li>


                        <li class="sidebar-item">

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
                            <p class="text-subtitle text-muted">Olah Data Pendaftaran Peserta Didik Baru Pada Laman ini.</p>
                        </div>

                    </div>
                </div>
                <section class="section">
                    <div class="row mb-2">
                        <div class="col-12 col-md-9">
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <?php
                                            include '../koneksi/cf.php';
                                            // Query untuk menghitung jumlah total data pada tabel
                                            $sql = "SELECT COUNT(*) as total FROM form_ppdb";

                                            // Menjalankan query dan menyimpan hasilnya pada variabel $result
                                            $result = mysqli_query($conn, $sql);

                                            // Mengambil data hasil query pada variabel $result
                                            $data = mysqli_fetch_assoc($result);

                                            // Menampilkan jumlah total data pada tabel
                                            // echo "Jumlah total data pada tabel adalah: " . $data['total'];
                                            ?>
                                            <h3 class='card-title'><?php echo $data['total']; ?> PESERTA DIDIK BARU</h3><br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-md-3">

                            <!-- button trigger for  Vertically Centered modal -->
                            <button type="button" class="btn btn-sm btn-outline-primary block mb-2" style="width: 100% ;" data-bs-toggle="modal" data-bs-target="#lihat-hasil-seleksi">
                                Lihat Hasil Seleksi
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary block" style="width: 100% ;" data-bs-toggle="modal" data-bs-target="#tambah-hasil-seleksi">
                                Tambah Hasil Seleksi
                            </button>
                            <!-- Vertically Centered modal Modal -->
                            <div class="modal fade" id="tambah-hasil-seleksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Import File Excel (.xls)</h5>
                                                <button type="button" class="close btn--block" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12 col-md-12">
                                                    <a href="Template_Hasil_Nilai.xls">Download Template</a>
                                                    <div class="mt-3 form-file">
                                                        <input type="file" name="file" class="form-file-input" id="customFile" required>
                                                        <label class="form-file-label" for="customFile">
                                                            <span class="form-file-text">Choose file...</span>
                                                            <span class="form-file-button btn-primary "><i data-feather="upload"></i></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="clear-temp" class="btn btn-danger ml-1">Hapus Temporary</a>

                                                <input type="submit" class="btn btn-primary ml-1" value="Preview" name="preview">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="">
                        <?php
                        // Load file autoload.php
                        require 'phpexcel/vendor/autoload.php';

                        // Include librari PhpSpreadsheet
                        use PhpOffice\PhpSpreadsheet\Spreadsheet;
                        use PhpOffice\PhpSpreadsheet\Reader\Xls;

                        // Jika user telah mengklik tombol Preview
                        if (isset($_POST['preview'])) {
                            $tgl_sekarang = date('YmdHis'); // Ini akan mengambil waktu sekarang dengan format yyyymmddHHiiss
                            $nama_file_baru = 'data' . $tgl_sekarang . '.xls';

                            // Cek apakah terdapat file data.xls pada folder tmp
                            if (is_file('hasil_ppdb/' . $nama_file_baru)) // Jika file tersebut ada
                                unlink('hasil_ppdb/' . $nama_file_baru); // Hapus file tersebut

                            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
                            $tmp_file = $_FILES['file']['tmp_name'];

                            // Cek apakah file yang diupload adalah file Excel 2003 (.xls)
                            if ($ext == "xls") {
                                // Upload file yang dipilih ke folder tmp
                                // dan rename file tersebut menjadi data{tglsekarang}.xls
                                // {tglsekarang} diganti jadi tanggal sekarang dengan format yyyymmddHHiiss
                                // Contoh nama file setelah di rename : data20210814192500.xls
                                move_uploaded_file($tmp_file, 'hasil_ppdb/' . $nama_file_baru);

                                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                                $spreadsheet = $reader->load('hasil_ppdb/' . $nama_file_baru); // Load file yang tadi diupload ke folder kls
                                $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                                // Buat sebuah tag form untuk proses import data ke database
                                echo "<form method='post' action='import-hasil'>";

                                // Disini kita buat input type hidden yg isinya adalah nama file excel yg diupload
                                // ini tujuannya agar ketika import, kita memilih file yang tepat (sesuai yg diupload)
                                echo "<input type='hidden' name='namafile' value='" . $nama_file_baru . "'>";

                                // Buat sebuah div untuk alert validasi kosong
                                // echo "<div id='kosong' style='color: red;margin-bottom: 10px;'>
                                // 			Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                                //         </div>";

                                // Buat sebuah tombol untuk mengimport data ke database

                                echo "<div class=''> <center> <button type='submit' class='btn btn-outline-primary btn-sm btn-block mb-2' name='import'>Simpan Ke Dalam Database</button> </center> </div>";

                                echo "<div class='card container w3-responsive'> <table cellpadding='5' class='mt-2 mb-2 mr-2 ml-2 table-sm table table-bordered'>
                                        <tr>
                                            <th colspan='11' class='text-center'>Preview Data</th>
                                        </tr>
                                        <tr>
                                            <th>NISN</th>
                                            <th>NAMA</th>
                                            <th>NILAI</th>
                                            <th>TAHUN PPDB</th>
                                        </tr>";

                                $numrow = 1;
                                $kosong = 0;
                                foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
                                    // Ambil data pada excel sesuai Kolom
                                    $nisn = $row['A'];
                                    $nama = $row['B'];
                                    $nilai = $row['C'];
                                    $thn_ppdb = $row['D'];

                                    // Cek jika semua data tidak diisi
                                    if ($nisn == "" && $nama == "" && $nilai == "" && $nama == "" && $nilai == "" && $thn_ppdb == "")
                                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                                    // Cek $numrow apakah lebih dari 1
                                    // Artinya karena baris pertama adalah nama-nama kolom
                                    // Jadi dilewat saja, tidak usah diimport
                                    if ($numrow > 1) {
                                        // Validasi apakah semua data telah diisi
                                        $nisn_td = (!empty($nisn)) ? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                                        $nama_td = (!empty($nama)) ? "" : " style='background: #E07171;'";
                                        $nilai_td = (!empty($nilai)) ? "" : " style='background: #E07171;'";
                                        $thn_ppdb_td = (!empty($thn_ppdb)) ? "" : " style='background: #E07171;'";

                                        // Jika salah satu data ada yang kosong
                                        if ($nisn == "" or $nama == "" or $nilai == "" or $thn_ppdb == "") {
                                            $kosong++; // Tambah 1 variabel $kosong
                                        }

                                        echo "<tr>";
                                        echo "<td" . $nisn_td . ">" . $nisn . "</td>";
                                        echo "<td" . $nama_td . ">" . $nama . "</td>";
                                        echo "<td" . $nilai_td . ">" . $nilai . "</td>";
                                        echo "<td" . $thn_ppdb_td . ">" . $thn_ppdb . "</td>";
                                        echo "</tr>";
                                    }

                                    $numrow++; // Tambah 1 setiap kali looping
                                }

                                echo "</table> </div>";

                                // Cek apakah variabel kosong lebih dari 0
                                // Jika lebih dari 0, berarti ada data yang masih kosong
                                if ($kosong > 0) {
                        ?>

                        <?php
                                }

                                echo "</form>";
                            } else { // Jika file yang diupload bukan File Excel 2003 (.xls)
                                // Munculkan pesan validasi
                                echo "<div class='container card bg-danger'>
                                        <h4 class='mt-2 mb-2 text-center text-white'>
                                            Hanya File Excel 2003 (.xls) yang diperbolehkan
                                        </h4>
                                     </div>";
                            }
                        }
                        ?>
                    </div>

                    <div class="card">

                        <div class="container card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    Calon Peserta Didik Baru Yang Sudah Menggisi Formulir.
                                </div>
                                <div class="col-sm-6 d-flex flex-row-reverse bd-highlight">
                                    <a href="cetak-xls" class="btn btn-sm btn-success">Unduh Ke Dalam Format Excel</a>
                                </div>
                            </div>
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
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Tahun</th>
                                        <th>Berkas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($d1 as $d1) { ?>
                                        <tr>
                                            <td><?php echo $d1['nisn'] ?></td>
                                            <td><?php echo $d1['nm_peserta'] ?></td>
                                            <td><?php echo $d1['thn_dibuat'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Button trigger for scrolling content modal -->
                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#berkas-file-user-<?php echo $d1['uuid'] ?>">
                                                        <i data-feather="file-text" width="20"></i>
                                                    </button>
                                                </div>

                                                <!--scrolling content Modal -->
                                                <div class="modal fade" id="berkas-file-user-<?php echo $d1['uuid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">

                                                    <?php
                                                    // menampilkan data
                                                    $d4 = http_request("http://localhost/smasantatheresia/dashboard/api/tampil_join_berkas.php?uuid=$d1[uuid]");
                                                    $d4 = json_decode($d4, TRUE);
                                                    // menampilkan data end
                                                    ?>

                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Berkas File</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form class="form form-horizontal">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label>NISN</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['nisn'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Nama Peserta</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['nm_peserta'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Tempat Lahir</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['tmpt_lhr'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Tanggal Lahir</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="date" class="form-control" value="<?php echo $d1['tgl_lhr'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Agama</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['agama'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Alamat</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['alamat'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>No Hp</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['no_hp'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Jurusan</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['jurusan'] ?>" disabled>
                                                                            </div>

                                                                            <hr>

                                                                            <div class="col-md-4">
                                                                                <label>Nama Ayah</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['nm_ayah'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Pendidikan Terakhir Ayah</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['pend_ayah'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Pekerjaan Ayah</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['pek_ayah'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>No Telepon Ayah</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['no_hp_ayah'] ?>" disabled>
                                                                            </div>

                                                                            <hr>

                                                                            <div class="col-md-4">
                                                                                <label>Nama Ibu</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['nm_ibu'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Pendidikan Terakhir Ibu</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['pend_ibu'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>Pekerjaan Ibu</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['pek_ibu'] ?>" disabled>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <label>No Telepon Ibu</label>
                                                                            </div>
                                                                            <div class="col-md-8 form-group">
                                                                                <input type="text" class="form-control" value="<?php echo $d1['no_hp_ibu'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                                <hr>

                                                                <div class="mt-3">
                                                                    <table class="table table-sm table-borderless table-light">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center">File scan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($d4 as $d4) { ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex justify-content-center">
                                                                                            <a href="../ppdb/uploads/<?php echo $d4['name'] ?>" target="_blank">
                                                                                                <img src="../ppdb/uploads/<?php echo $d4['name'] ?>" alt="<?php echo $d4['name'] ?>" style="width: 400px; height: 100px; object-fit: cover;">
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>


            <!--scrolling content Modal -->
            <div class="modal fade" id="lihat-hasil-seleksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Hasil Seleksi PPDB</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php

                            $sql = mysqli_query($conn, "select * from hasil_ppdb");
                            $cek = mysqli_num_rows($sql);
                            if ($cek == 0) {
                                echo "
                                        <p>Data akan muncul setelah anda menambah data hasil seleksi.</p>
                                    ";
                            } else {
                                echo "
                                <table class='table table-sm table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Tahun</th>
                                        <th>Hasil</th>
                                    </tr>
                                </thead>
                                <tbody> ";
                                foreach ($d2 as $d2) {
                                    echo "  
                                      <tr>
                                            <td>$d2[nisn]</td>
                                            <td>$d2[nm]</td>
                                            <td>$d2[thn]</td>
                                            <td>
                                            ";

                                    $nilai = $d2['nilai'];
                                    if ($nilai >= 90) {
                                        echo $grade = 'A+';
                                        echo '&nbsp';
                                        echo $keterangan = 'LULUS';
                                    } elseif ($nilai >= 80) {
                                        echo $grade = 'A';
                                        echo '&nbsp';
                                        echo  $keterangan = 'LULUS';
                                    } elseif ($nilai >= 70) {
                                        echo $grade = 'B';
                                        echo '&nbsp';
                                        echo $keterangan = 'LULUS';
                                    } elseif ($nilai >= 60) {
                                        echo $grade = 'C';
                                        echo '&nbsp';
                                        echo $keterangan = 'LULUS';
                                    } else {
                                        echo $grade = 'D';
                                        echo '&nbsp';
                                        echo $keterangan = 'TIDAK LULUS';
                                    }

                                    echo "
                                            </td>
                                        </tr> ";
                                }
                                echo "  
                              </tbody>
                            </table>
                                    ";
                            }
                            ?>

                        </div>

                        <div class="modal-footer">

                            <a href="cetak-pdf" class="btn btn-primary ml-1">Simpan Ke PDF</a>

                            <a href="format-hasil-ppdb" class="btn btn-danger ml-1">Format</a>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>

                        </div>
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

            <script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>

</body>

</html>