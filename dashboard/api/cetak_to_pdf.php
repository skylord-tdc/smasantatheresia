<?php
// Koneksi ke database
include '../../koneksi/cf.php';

// Query untuk mengambil data dari database
$query = "SELECT * FROM hasil_ppdb";
$result = mysqli_query($conn, $query);

// Inisialisasi variabel $tahun dengan nilai kolom thn pada baris pertama hasil query
$row = mysqli_fetch_assoc($result);
$tahun = $row['thn'];

// Memuat library FPDF
require('../FPDF/fpdf.php');

// Membuat objek PDF
$pdf = new FPDF();
$pdf->AddPage();

// Menambahkan judul pada halaman
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'HASIL SELEKSI PPDB PADA', 0, 1, 'C');
$pdf->Cell(0, 10, 'Tahun ' . $tahun, 0, 1, 'C'); // Menambahkan garis baru
$pdf->Cell(0, 10, ' ', 0, 1, 'C'); // Menambahkan garis baru

// Menambahkan header pada tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'NISN', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama Peserta', 1, 0, 'C');
$pdf->Cell(80, 10, 'Nilai', 1, 1, 'C');



// Menambahkan konten dari database pada halaman
$pdf->SetFont('Arial', '', 12);
do {
    // validasi LULUS atau TIDAK LULUS
    $nilai =  $row['nilai'];
    if ($nilai >= 90) {
        $grade = 'A+';
        $keterangan = 'LULUS';
    } elseif ($nilai >= 80) {
        $grade = 'A';
        $keterangan = 'LULUS';
    } elseif ($nilai >= 70) {
        $grade = 'B';
        $keterangan = 'LULUS';
    } elseif ($nilai >= 60) {
        $grade = 'C';
        $keterangan = 'LULUS';
    } else {
        $grade = 'D';
        $keterangan = 'TIDAK LULUS';
    }

    $pdf->Cell(40, 10, $row['nisn'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['nm'], 1, 0, 'C');
    $pdf->MultiCell(80, 10, $grade . ' ' . $keterangan, 1, 'C');
} while ($row = mysqli_fetch_assoc($result));

// Men-download file PDF
$pdf->Output('PPDB-SMA-SANTA-THERESIA-AIR-MOLEK-TAHUN-' . $tahun . '.pdf', 'D');
