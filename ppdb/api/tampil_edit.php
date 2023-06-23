<?php
include '../../koneksi/cf.php';

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];
    $SQL = $conn->prepare("SELECT * FROM form_ppdb WHERE uuid=? ORDER BY uuid ASC");
    $SQL->bind_param("i", $uuid);
    $SQL->execute();
    $hasil = $SQL->get_result();
    $myArray = array();
    while ($users = $hasil->fetch_array(MYSQLI_ASSOC)) {
        $myArray = $users;
    }
    echo json_encode($myArray);
} else {
    echo "data tidak ditemukan";
}
