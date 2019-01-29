<?php
$host = 'localhost';
$db = 'foo';
$username = 'eddy';
$pw = '1';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

	try
	{
		$conn = new PDO($dsn, $username, $pw);
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
	        echo $e->getMessage();
	}
?>
