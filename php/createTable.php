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

  $stm = $conn->prepare("
    CREATE TABLE timesheets(
			sheet_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			sheet_dateStamp DATETIME NOT NULL,
			sheet_data blob NOT NULL,
			sheet_type varchar(255) NOT NULL,
			sheet_name varchar(255) NOT NULL)
 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");
  $stm->execute();

?>
