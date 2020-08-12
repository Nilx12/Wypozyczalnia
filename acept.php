<?php
require_once 'conn.php';
session_start();
$a=$_GET['login'];
$b=$_GET['code'];


    $ac=$date->prepare("select aktywacja from konta where login=:a;");
    $ac->bindValue(':a', $a, PDO::PARAM_STR);
    $ac->execute();
    $ar=$ac->fetch();

if($b==$ar['aktywacja'])
{
   echo "tak";
    $ele=$date->prepare("update konta set aktywacja='aktywne' where login=:a");
    $ele->bindValue(':a', $a, PDO::PARAM_STR);
    $ele->execute();
}

    header('location:index.php');




?>