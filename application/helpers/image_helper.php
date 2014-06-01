<?php
    class image {
        protected $_text = "";
        
        function _getUrlImage($image) {
            preg_match('/img src="([^"]*?).jpg"/', $image, $val);
            
            if($val) {
                $this->_text =  $val[0];
                $this->_text =  str_replace('img src="','',$this->_text);
                $this->_text =  str_replace('"','',$this->_text);	
            }

            return $this->_text;
        }

        function _removeImageUrl($image) {
            $content = preg_replace("/<img[^>]+\>/i", "", $image);

            return $content;
        }
    }
?>
