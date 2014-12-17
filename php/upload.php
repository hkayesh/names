<?php
if(is_array($_FILES)) {
    if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $arrAllowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $strDetectedType = exif_imagetype($_FILES['userImage']['tmp_name']);
        $blnInValidFormat = !in_array($strDetectedType, $arrAllowedTypes);

        if($blnInValidFormat) {
            echo 'error';
            exit;
        }

        $strLetter = $_POST['letter'];
        $strSourcePath = $_FILES['userImage']['tmp_name'];
        $strImageUrl = "images/letters/" . $strLetter. '/' . $_FILES['userImage']['name'];
        $strTargetPath = '../' . $strImageUrl;
        if(move_uploaded_file($strSourcePath, $strTargetPath)) {
            echo 'success';
        }
    }
    else {
        echo 'error';
    }
}
