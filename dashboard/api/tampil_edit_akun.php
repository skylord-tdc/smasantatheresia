<?php
include '../../koneksi/cf.php';
$secure = $_GET["secure"];
if (isset($_GET['secure'])) {
    $secure = $_GET['secure'];
    $SQL = $conn->prepare("SELECT * FROM akun_admin WHERE secure=?");
    $SQL->bind_param("i", $secure);
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
