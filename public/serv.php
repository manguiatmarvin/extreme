<?php
define('ROOT_PATH', dirname(__DIR__));


$fullPath =  dirname(__DIR__)."/data/videos/2014/10/video_1.mp4";


if ($fd = fopen ($fullPath, "r")) {

    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);

    header("Content-type: video/mp4");
    header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");            
    header("Content-length: $fsize");
    header("Cache-control: private");

    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}

fclose ($fd);
exit;

?>