<?php
$str = "2019-08-02 00:00:00";
$date = strtotime($str);
$newformat = date('Y-m-d',$date);
echo "<pre>";
var_dump($newformat);
echo "</pre>";

//date()