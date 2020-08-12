<?php
require 'classes.php';
$kl=new Wypozyczenie($date);
$mod=$_POST['mode'];
$g=$_POST['id'];
switch($mod){
    case 1:
        {$kl->wyslane($g);
         print($mod);
         break;}
    case 2:{
        $kl->anulowane($g);print($mod);
        break;}
        case 3:{
            $kl->zwrot($g);print($mod);
            break;}

        }   

?>