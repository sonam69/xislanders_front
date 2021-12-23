<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/adders/upload_img.php");

include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/header.php");
sessionStart();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true
    && isset($_FILES['fileToUpload']) ) {

    if(is_valid_img()) {
        $new_name = date('YmdHis',time()).mt_rand() . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        $path_to_be_uploaded_to = $_SERVER['DOCUMENT_ROOT'] . "/uploaded_imgs/" . $new_name;
        $path_to_display = "/uploaded_imgs/" . $new_name;
        if(!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path_to_be_uploaded_to) ||
            !chmod($path_to_be_uploaded_to, 0744)
        ) {
            echo json_encode(false);
        } else {
            $data["display_url"] = $path_to_display;
            $data["upload_url"] = $path_to_be_uploaded_to;
            echo json_encode($data);
        }
    }
    else echo json_encode(false);
}

function is_valid_img() {
    $img = $_FILES['fileToUpload'];
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $allowedExts = array('png', 'jpeg', 'jpg', 'svg');
    $allowedExts2 = array('image/png', 'image/jpg', 'image/jpeg', 'image/svg');
    $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
    if( !in_array($ext, $allowedExts) ) { return [false, "Only PNG JPEG JPG SVG images are allowed"]; }
    if(!file_exists($img['tmp_name']) || !is_uploaded_file($img['tmp_name'])) { return [false, "File doesn't exists, try again"]; }
    if(!exif_imagetype($img['tmp_name'])) { return [false, "Only images allowed"]; }
    if(filesize($img['tmp_name']) < 12) { return [false, "All images has to be more than 11 bytes"]; }
    if (!in_array(finfo_file($fileinfo, $img['tmp_name']), $allowedExts2)) { return [false, "Only PNG JPEG JPG images are allowed"]; }
    if($img['error'] !== 0) { return [false, "File error"]; }
    if($img['size'] > 4000000) { return [false, "Maximum image size allowed is 1GB"]; }
    return true;
}