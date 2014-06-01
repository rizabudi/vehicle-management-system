<?php
error_reporting(0);

$default_url = "http://localhost/himitpens/";
$dir         = $default_url.'assets/media/uploaded';

$_FILES['file']['type'] = strtolower($_FILES['file']['type']);

if ($_FILES['file']['type'] == 'image/png' 
    || $_FILES['file']['type'] == 'image/jpg' 
    || $_FILES['file']['type'] == 'image/gif' 
    || $_FILES['file']['type'] == 'image/jpeg')
{
    // setting file's mysterious name
    $filename = md5(date('YmdHis')).'.jpg';
    $file     = '../../media/uploaded/'.$filename;

    // copying
    copy($_FILES['file']['tmp_name'], $file);

    // displaying file    
    $array = array(
        'filelink' => $default_url.'assets/media/uploaded/'.$filename
    );

    echo stripslashes(json_encode($array));   
}
?>