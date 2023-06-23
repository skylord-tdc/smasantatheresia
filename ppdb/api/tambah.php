<?php
include '../../koneksi/cf.php';
$now = date("Y");
// form 
$uuid       = ($_POST['uuid']);
$nisn       = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['nisn']);
$nm_peserta = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['nm_peserta']);
$tmpt_lhr   = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['tmpt_lhr']);
$tgl_lhr    = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['tgl_lhr']);
$agama      = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['agama']);
$alamat     = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['alamat']);
$no_hp      = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['no_hp']);
$jurusan    = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['jurusan']);
$nm_ayah    = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['nm_ayah']);
$pend_ayah  = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['pend_ayah']);
$pek_ayah   = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['pek_ayah']);
$no_hp_ayah = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['no_hp_ayah']);
$nm_ibu     = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['nm_ibu']);
$pend_ibu   = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['pend_ibu']);
$pek_ibu    = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['pek_ibu']);
$no_hp_ibu  = preg_replace('/[^a-zA-Z0-9\s]/', '', $_POST['no_hp_ibu']);

$query = "INSERT INTO form_ppdb (uuid, thn_dibuat, nisn, nm_peserta, tmpt_lhr, tgl_lhr, agama, alamat, no_hp, jurusan, nm_ayah, pend_ayah, pek_ayah, no_hp_ayah, nm_ibu, pend_ibu, pek_ibu, no_hp_ibu) VALUES ('$uuid', '$now', '$nisn', '$nm_peserta', '$tmpt_lhr', '$tgl_lhr', '$agama', '$alamat', '$no_hp', '$jurusan', '$nm_ayah', '$pend_ayah', '$pek_ayah', '$no_hp_ayah', '$nm_ibu', '$pend_ibu', '$pek_ibu', '$no_hp_ibu')";
$result = mysqli_query($conn, $query);

if ($result) {
    // echo "Data berhasil disimpan";

    session_start();
    $_SESSION["success"] = '<div class="alert alert-success" role="alert" >Data Diri Berhasil Ditambahkan.</div>';
    echo
    "<script type='text/javascript'>
        window.location='pendaftaran-peserta-didik-baru';
    </script>";
} else {
    if (mysqli_errno($conn) == 1062) {
        // echo "Data sudah terdaftar";

        session_start();
        $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >Terjadi kesalahan. Data Sudah Tersedia.</div>';
        echo
        "<script type='text/javascript'>
        window.location='hi-selamat-datang';
        </script>";
    } else {
        echo "Data gagal disimpan: " . mysqli_error($conn);
    }
}
