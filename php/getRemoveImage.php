<?php
if($_POST['strLetter']) {
    $strLetter = $_POST['strLetter'];
    $strDirectory = "../images/letters/". $strLetter ."/";
    $arrImages = array_diff(scandir($strDirectory, 1), array('..', '.'));
    sort($arrImages);
    $strOutPut = '';
    foreach($arrImages as $strImage) {
        $strOutPut .= "<a href='javascript:void(0);'><img class='letter-image-thumb img-thumbnail' onClick='removeImage(\"".$strDirectory.$strImage."\", \"$strImage\")' src='images/letters/". $strLetter . "/" . $strImage ."' name='$strImage' alt='$strImage'/></a>";
    }
    if($strOutPut == '') {
        $strOutPut = "<div class='text-center col-lg-12'>No image to remove</div>";
    }
    echo $strOutPut;
}