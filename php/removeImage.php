<?php
if(isset($_POST['strPath'])) {
    $strPath = $_POST['strPath'];
    if(unlink($strPath)) {
        echo 'success';
    }
}