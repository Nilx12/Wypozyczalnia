<?php
require_once 'conn.php';
session_start();

$filmne1=$date->prepare('select id from konta where login=:nick');
$filmne1->bindValue(":nick",$_SESSION['nick'],PDO::PARAM_STR);
$filmne1->execute();
$lel=$filmne1->fetch();
$work=$lel['id'];
 

$fi=$date->prepare('select ocena from oceny where id_k=:d and id_f=:nr');
$fi->bindValue(":d",$work,PDO::PARAM_STR);
$fi->bindValue(":nr",$_POST['idk'],PDO::PARAM_STR);
$fi->execute();
$your=$fi->rowCount();

if($your==0)
{
$filmne=$date->prepare('insert into oceny values (NULL,:nr, :idk,:ner)');
$filmne->bindValue(":ner",$_POST['klucz_ajax'],PDO::PARAM_STR);
$filmne->bindValue(":nr",$_POST['idk'],PDO::PARAM_STR);
$filmne->bindValue(":idk",$work,PDO::PARAM_STR);
$filmne->execute();
}


?>