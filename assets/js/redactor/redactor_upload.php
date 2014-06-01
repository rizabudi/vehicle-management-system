<?php
    error_reporting(0);
    
    copy($_FILES['file']['tmp_name'], '../media/uploaded/'.$_FILES['file']['name']);
    $array = array(
        'filelink' => "assets/media/uploaded/".$_FILES['file']['name'],
        'filename' => $_FILES['file']['name']
    );

    echo stripslashes(json_encode($array));	
?>