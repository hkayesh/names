<?php
class NameGenerator {

    private $strWord;

    public function __construct($strWord) {
        $this->strWord = str_replace('*', '1', $strWord);
    }

    public function getImages() {
        $arrLetters = str_split(strtolower($this->strWord));
        $strResponse = '';
        if(count($arrLetters) > 9) {
            $strImageSizeClass = 'letter-image-small';
        }
        else {
            $strImageSizeClass = 'letter-image';
        }

        $intCount = 0;
        foreach($arrLetters as $strLetter) {
            $arrFiles = array_diff(scandir("../images/letters/". $strLetter ."/", 1), array('..', '.'));
            $intNumberOfImages = count($arrFiles);
            $intRandomNumber = rand(0, $intNumberOfImages-1);
            if($intNumberOfImages > 0) {
                $strSource = "images/letters/".$strLetter . "/" .$arrFiles[$intRandomNumber];
                $strResponse .= "<a href='javascript:void(0)'><img class='$strImageSizeClass img-thumbnail js-letter-image' src='" . $strSource . "' data-letter='$strLetter' data-index = '$intCount' id='$arrFiles[$intRandomNumber]' data-toggle='modal' data-target='#myModal'/></a>";
            }
            else {
                $strSource = "images/no-image-found.jpg";
                $strResponse .= "<img class='$strImageSizeClass img-thumbnail' src='" . $strSource . "' />";
            }
            $intCount++;
        }
        $strResponse .= "<input class='js-hidden-word' type='hidden' value='".$this->strWord ."'>";
        echo $strResponse;
    }
}

$objNameGenerator = new NameGenerator($_POST['strWord']);
$objNameGenerator->getImages();
