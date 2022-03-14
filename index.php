<?php
    include 'parser.php';
    include 'warpper.php';

    $url = 'google.com.vn';
    $demo = new DataHandler($url);
    $string = $demo->getData();
    if($string){
        $string = json_decode($string);
        var_dump($string);
    }