<?php
include '../../koneksi/cf.php';

$uuid = $_POST['uuid'];
$now = date("Y");

// Cek apakah ada file yang diupload
if (isset($_FILES['files'])) {
    $errors = array();

    // Looping through each file
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {

        // ubah nama file tidak boleh ada spasi
        $file_name = preg_replace('/\s+/', '_', $_FILES['files']['name'][$key]);
        $file_name_1 = preg_replace('/\./', '', $file_name);

        $file_size = $_FILES['files']['size'][$key];
        $file_tmp = $_FILES['files']['tmp_name'][$key];
        $file_type = $_FILES['files']['type'][$key];

        // Check if file is an image and the format is allowed (JPG, JPEG, PNG, GIF)
        $allowed_formats = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
        if ($file_size > 10000000) {
            $errors[] = 'File ' . $file_name . ' terlalu besar. Ukuran file maksimum adalah 10 MB.';
        } elseif (!in_array($file_type, $allowed_formats)) {
            $errors[] = 'File ' . $file_name . ' tidak diperbolehkan. Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.';
        } else {
            // Move uploaded file to designated directory
            $upload_dir = "../uploads/";
            $file_path = $upload_dir . $uuid . $now . $file_name_1;
            move_uploaded_file($file_tmp, $file_path);

            // Simpan nama file ke database
            $query = "INSERT INTO upload_berkas (uuid, thn_dibuat, name, size, type) VALUES ('$uuid', '$now', '$uuid$now$file_name_1', '$file_size', '$file_type')";
            $result = mysqli_query($conn, $query);
        }
    }

    // Display success or error message
    if (empty($errors)) {
        session_start();
        $_SESSION["success"] = '<div class="alert alert-success" role="alert" >Upload Berhasil.</div>';
        echo
        "<script type='text/javascript'>
            window.location='hi-selamat-datang';
        </script>";
    } else {
        foreach ($errors as $error) {
            // echo $error . "<p>Gagal Upload</p><br>";

            session_start();
            $_SESSION["warning"] = '<div class="alert alert-warning" role="alert" >' . $error . '</div>';
            echo
            "<script type='text/javascript'>
                window.location='hi-selamat-datang';
            </script>";
        }
    }
}
