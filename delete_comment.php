<?php
require 'classes.php';
if(!isset($_POST['kom']) || !isset($_GET['code']))
    header('location:index.php');
if($_GET['code']=='delete'){
    $kom = new Komentarz($date);
    $kom->deleteComment($_POST['kom']);
}

?>