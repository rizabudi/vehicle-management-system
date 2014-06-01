<?php
    function resize($width, $height , $filename){
	list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
        
	$ratio = max($width/$w, $height/$h);
	$h     = ceil($height / $ratio);
	$x     = ($w - $width / $ratio) / 2;
	$w     = ceil($width / $ratio);

        $path = './assets/media/thumb/'.$filename;
	$imgString = file_get_contents($_FILES['image']['tmp_name']);
        
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp   = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
        
	/* Save image */
	switch ($_FILES['image']['type']) {
            case 'image/jpeg':
                imagejpeg($tmp, $path, 100);
                break;
            case 'image/png':
                imagepng($tmp, $path, 0);
                break;
            case 'image/gif':
                imagegif($tmp, $path);
                break;
            default:
                exit;
                break;
	}
        
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}
?>
