<?php
$filename = basename($_GET['file']);
$filepath = __DIR__ . "../../../uploads/documents/" . $filename;

if (file_exists($filepath)) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $filepath);
    finfo_close($finfo);

    header("Content-Type: $mime");
    header("Content-Disposition: inline; filename=\"$filename\"");
    readfile($filepath);
} else {
    http_response_code(404);
    echo "File not found.";
}
