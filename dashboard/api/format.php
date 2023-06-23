<?php
include '../../koneksi/cf.php';

$uuid = $_GET["uuid"];


function http_request($url)
{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
}
// menampilkan data join
$d2 = http_request("http://localhost/smasantatheresia/dashboard/api/tampil_join_hapus.php?uuid=$uuid");
$d2 = json_decode($d2, TRUE);

foreach ($d2 as $d2) {
        if (is_file("../../ppdb/uploads/" . $d2['name'])) unlink("../../ppdb/uploads/" . $d2['name']);
}
mysqli_query($conn, "DELETE FROM upload_berkas WHERE uuid='$uuid' ");
mysqli_query($conn, "DELETE FROM form_ppdb WHERE uuid='$uuid' ");
mysqli_query($conn, "DELETE FROM akun_ppdb WHERE uuid='$uuid' ");
echo
"<script type='text/javascript'>
        window.history.back()
</script>";
