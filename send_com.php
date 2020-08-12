<?php
require_once 'conn.php';
session_start();
$vc=true;
$movie=$_POST['film'];
$comment=$_POST['komentarz'];

if($comment=="")
    $vc=false;
if(strlen($comment)>500)
    $vc=false;
$comment=htmlentities($comment);
    $comment=str_replace("kurwa","k*rwa",$comment);
    $comment=str_replace("jeb","je*",$comment);
    $comment=str_replace("dziwka","dzi*ka",$comment);
   $comment=str_replace("pierdo","pier*o",$comment);
if($vc){
$now_coment=$date->prepare("INSERT INTO komentarze values(NULL,:nick,:mo,:com)");
$now_coment->bindValue(":nick",$_SESSION['user'], PDO::PARAM_STR);
$now_coment->bindValue(":com",$comment, PDO::PARAM_STR);
$now_coment->bindValue(":mo",$movie, PDO::PARAM_STR);
$now_coment->execute();
}

?>
