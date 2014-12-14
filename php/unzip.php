<?php

$zip = new ZipArchive;
$res = $zip->open('names.zip');
if ($res === TRUE) {
    $zip->extractTo('my_extract_to_dir/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
?> 