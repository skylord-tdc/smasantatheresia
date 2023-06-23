<?php
include '../../koneksi/cf.php';
mysqli_query($conn, "TRUNCATE table hasil_ppdb ");

echo
"<script type='text/javascript'>
        window.history.back()
</script>";
