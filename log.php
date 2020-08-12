<?php
require_once 'classes.php';


	if(!isset($_POST['login']) || !isset($_POST['password']))
	{
		header('location:logowanie.php');
	exit();
	}
       $login=filter_input(INPUT_POST, 'login');
       $haslo=filter_input(INPUT_POST, 'password');
        
        $us=new User($date);
        $us->logUser($login,$haslo);
?>