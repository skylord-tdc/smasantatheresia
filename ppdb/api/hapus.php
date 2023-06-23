<?php
include '../../koneksi/cf.php';
$name = $_GET["name"];
$i = mysqli_query($conn, "SELECT * FROM upload_berkas WHERE name ='$name' ");
$u = mysqli_fetch_array($i);

if (is_file("../uploads/" . $u['name'])) unlink("../uploads/" . $u['name']);
mysqli_query($conn, "DELETE FROM upload_berkas WHERE name='$name' ");
echo
"<script type='text/javascript'>
        window.history.back()
</script>";
