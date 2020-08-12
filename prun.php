<?php
require 'classes.php';
if(!$_POST['film'])
header('location:index.php');
if($_GTE['code']=='koszyk'){
require 'classes.php';
$wid=new Koszyk($date);
$wid->options();    
}




        ?>