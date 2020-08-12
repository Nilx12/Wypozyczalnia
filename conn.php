<?php

$cfr=require_once 'database.php';

try{
	$date=new PDO("mysql:hos={$cfr['host']};dbname={$cfr['database']};charse=utf-8",
	$cfr['user'],$cfr['password'],
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

}

	catch (PDOException $er) {
	exit('Data error');
}
?>