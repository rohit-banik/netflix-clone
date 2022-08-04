<?php

class FormSanitizer {

    public static function sanitizeString($inputText) {
        $inputText = strip_tags($inputText); // prevent any html tags
        $inputText = str_replace(" ", "", $inputText); // deletes any space within the string
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText);
        return $inputText;    
    }
    
    public static function sanitizeUserName($inputText) {
        $inputText = strip_tags($inputText); // prevent any html tags
        $inputText = str_replace(" ", "", $inputText); // deletes any space within the string
        return $inputText;    
    }

    public static function sanitizePassword($inputText) {
        $inputText = strip_tags($inputText); // prevent any html tags
        return $inputText;    
    }

    public static function sanitizeEmail($inputText) {
        $inputText = strip_tags($inputText); // prevent any html tags
        $inputText = str_replace(" ", "", $inputText); // deletes any space within the string
        return $inputText;    
    }

}

?>