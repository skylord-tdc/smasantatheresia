<?php
// load the PhpSpreadsheet classes
require '../phpexcel/vendor/autoload.php';

// create new Spreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

// set default font
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);

// create the header row
$sheet = $spreadsheet->getActiveSheet();
$sheet
    ->setCellValue('A1', 'NISN')
    ->setCellValue('B1', 'NAMA')
    ->setCellValue('C1', 'THN PPDB')
    ->setCellValue('D1', 'JURUSAN')
    ->setCellValue('E1', 'TMPT LAHIR')
    ->setCellValue('F1', 'TNGL LAHIR')
    ->setCellValue('G1', 'AGAMA')
    ->setCellValue('H1', 'ALAMAT')
    ->setCellValue('I1', 'NO HP')
    ->setCellValue('J1', 'NAMA AYAH')
    ->setCellValue('K1', 'PEND TERAKHIR AYAH')
    ->setCellValue('L1', 'PEKERJAAN AYAH')
    ->setCellValue('M1', 'NO HP AYAH')
    ->setCellValue('N1', 'NAMA IBU')
    ->setCellValue('O1', 'PEND TERAKHIR IBU')
    ->setCellValue('P1', 'PEKERJAAN IBU')
    ->setCellValue('Q1', 'NO HP IBU');

// get data from MySQL database
include '../../koneksi/cf.php';
$result = mysqli_query($conn, 'SELECT * FROM form_ppdb');

// set row counter to start from row 2
$row = 2;

// loop through each row of data and add it to the Excel sheet
while ($data = mysqli_fetch_array($result)) {
    $sheet
        ->setCellValue('A' . $row, $data['nisn'])
        ->setCellValue('B' . $row, $data['nm_peserta'])
        ->setCellValue('C' . $row, $data['thn_dibuat'])
        ->setCellValue('D' . $row, $data['jurusan'])
        ->setCellValue('E' . $row, $data['tmpt_lhr'])
        ->setCellValue('F' . $row, $data['tgl_lhr'])
        ->setCellValue('G' . $row, $data['agama'])
        ->setCellValue('H' . $row, $data['alamat'])
        ->setCellValue('I' . $row, $data['no_hp'])
        ->setCellValue('J' . $row, $data['nm_ayah'])
        ->setCellValue('K' . $row, $data['pend_ayah'])
        ->setCellValue('L' . $row, $data['pek_ayah'])
        ->setCellValue('M' . $row, $data['no_hp_ayah'])
        ->setCellValue('N' . $row, $data['nm_ibu'])
        ->setCellValue('O' . $row, $data['pend_ibu'])
        ->setCellValue('P' . $row, $data['pek_ibu'])
        ->setCellValue('Q' . $row, $data['no_hp_ibu']);
    $row++;
}

// set the worksheet title
$sheet->setTitle('My Worksheet');

// create a new writer instance
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

// redirect output to a client’s web browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="REPORT-PPDB-SMA-SANTA-THERSIA.xlsx"');
header('Cache-Control: max-age=0');

// write the spreadsheet data to a file
$writer->save('php://output');
exit;
