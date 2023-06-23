<?php
// Load file koneksi.php
include '../../koneksi/cf.php';

// Load file autoload.php
require '../phpexcel/vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

if (isset($_POST['import'])) { // Jika user mengklik tombol Import
    $nama_file_baru = $_POST['namafile'];
    $path = '../hasil_ppdb/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $numrow = 1;
    foreach ($sheet as $row) {
        // Ambil data pada excel sesuai Kolom
        $nisn = $row['A'];
        $nama = $row['B'];
        $nilai = $row['C'];
        $thn_ppdb = $row['D'];

        // Cek jika semua data tidak diisi
        if ($nisn == "" && $nama == "" && $nilai == "" && $thn_ppdb == "")
            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

        // validasi anti duplikat
        $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hasil_ppdb WHERE (nisn='$nisn' and nm='$nama' and nilai='$nilai' and thn='$thn_ppdb') "));
        if ($cek > 0) {

            // alert boostrap
            session_start();
            $_SESSION["warning"] = '<div class="alert alert-warning" role="alert">
                                        Peringatan Ada Data Yang Sudah Tersedia, Tapi Data Yang Belum Masuk Tetap Di Tambahkan !!
                                  </div>';
            //   end alert

            echo "<script>window.location='menu-dashboard';</script>";
        } else {
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if ($numrow > 1) {
                // Buat query Insert

                $result = mysqli_query($conn, "INSERT INTO hasil_ppdb(nisn,nm,nilai,thn) 
            VALUES(
            '$nisn',
            '$nama',
            '$nilai',
            '$thn_ppdb'
            )");
            }

            $numrow++; // Tambah 1 setiap kali looping

            // unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file
            if (is_file($path)) {
                unlink($path);
            }

            echo
            "   <script type='text/javascript'>
                window.location='menu-dashboard'; </script>";
        }
    }
}
