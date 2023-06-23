<?php
include '../../koneksi/cf.php';
$uuid = $_GET['uuid'];
$myArray = array();
if ($result = mysqli_query($conn, "SELECT * FROM upload_berkas WHERE uuid='$uuid' ORDER BY id ASC")) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $myArray[] = $row;
    }
    mysqli_close($conn);
    echo json_encode($myArray);
}
