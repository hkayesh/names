<?php
if($_POST['strLetter']) {
    $strLetter = $_POST['strLetter'];
    $strDirectory = "../images/letters/". $strLetter ."/";
    $arrImages = array_diff(scandir($strDirectory, 1), array('..', '.'));
    sort($arrImages);
    $strOutPut = '';
    $strToReplaceIndex = $_POST['strToReplaceIndex'];
    foreach($arrImages as $intKey => $strImage) {
        $strOutPut .= "<a href='javascript:void(0);'><img class='letter-image img-thumbnail js-replace-with' data-to-replace-index='$strToReplaceIndex' src='images/letters/". $strLetter . "/" . $strImage ."' name='$strImage' alt='$strImage' data-dismiss='modal' data-letter-index='".($intKey+1)."' data-letter='$strLetter'/></a>";
    }
    if($strOutPut == '') {
        $strOutPut = "<div class='text-center col-lg-12'>No image to remove</div>";
    }
    echo $strOutPut;
}