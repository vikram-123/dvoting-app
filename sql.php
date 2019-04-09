<?php

$user_name = "root";
$password = "Root@localhost1";
$database = "votedb";
$server = "localhost";
$db_handle = mysqli_connect($server, $user_name, $password);
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) 
{
	die("DATABASE not found!");
}

?>
