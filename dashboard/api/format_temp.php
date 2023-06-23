<?php
$files = glob("../hasil_ppdb/*xls");
foreach ($files as $value) {
    if (is_file($value)) {
        unlink($value);
    }
}

echo
"   <script type='text/javascript'>
    window.location='menu-dashboard'; </script>"; // Redirect ke halaman awal