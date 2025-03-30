<?php

function uploadFile(): bool|string
{
    if (isset($_FILES)) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileTmpPath = $_FILES[array_key_first($_FILES)]['tmp_name'];
        $fileName = $_FILES[array_key_first($_FILES)]['name'];
        $fileSize = $_FILES[array_key_first($_FILES)]['size'];
        $fileType = $_FILES[array_key_first($_FILES)]['type'];

        if (!in_array($fileType, $allowedTypes)) {
            return false;
        }

        $maxFileSize = 8 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            return false;
        }

        $uploadDir = __ROOT__ . '/images/';
        $fileNameNoSpaces = str_replace(' ', '_', $fileName); // Remove spaces for better compatibility
        $newFileName = uniqid() . '-' . $fileNameNoSpaces;
        $name = $newFileName;
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            return $name;
        } else {
            echo "Error occurred while uploading the file.";
            return false;
        }
    } else {

        return false;
    }
}
