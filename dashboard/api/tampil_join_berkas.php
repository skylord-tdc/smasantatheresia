<?php
include '../../koneksi/cf.php';
$uuid = $_GET["uuid"];
$myArray = array();
if ($result = mysqli_query($conn, "SELECT DISTINCT akun_ppdb.uuid, akun_ppdb.nm, akun_ppdb.email, akun_ppdb.jk, upload_berkas.name
FROM akun_ppdb
JOIN upload_berkas
ON akun_ppdb.uuid = upload_berkas.uuid
WHERE akun_ppdb.uuid = '$uuid'")) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $myArray[] = $row;
    }
    mysqli_close($conn);
    echo json_encode($myArray);
}
