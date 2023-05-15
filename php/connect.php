<?php
$host = "localhost";
$db_name = "recipe_app";
$user = "root";
$password = "";


$conn = new PDO("mysql:host=$host;dbname=$db_name;", $user, $password);

if (!$conn) {
	echo "Connection failed!";
}

 
?>