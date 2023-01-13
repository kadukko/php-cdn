<?php
include('config.php');

function uploadFile($file, $path, $name) {
    $targetDirectory = __DIR__ . "/uploads/" . $path;

    if (!is_dir($targetDirectory)) {
        if (!mkdir($targetDirectory, 0755, true)) {
            throw new Exception('MKDIR_FAILED');
        }
    }

    if (!isset($file)) {
        throw new Exception('INVALID_FILE');
    }

    $filePath = $file['tmp_name'];
    $fileSize = filesize($filePath);
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($fileInfo, $filePath);

    if ($fileSize > $GLOBALS['CONFIG']['MAX_FILE_SIZE']) { 
        throw new Exception('FILE_TOO_LARGE');
    }

    $newFilePath = $targetDirectory . "/" . $name;

    if (!rename($filePath, $newFilePath)) { 
        throw new Exception('UPLOAD_FAILED');
    } 

    chmod($newFilePath, 0755);
    
    return "uploads/" . $path . "/" . $name;
}

function printJSON($json) {
    header('Content-Type: application/json');
    echo json_encode($json, JSON_PRETTY_PRINT);
}