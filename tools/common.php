<?php

setlocale(LC_ALL, "fr_FR");

try{
	$db = new PDO('mysql:host=localhost;dbname=blog_soraya;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
	die( 'Erreur : ' . $exception->getMessage() );
}

session_start();

