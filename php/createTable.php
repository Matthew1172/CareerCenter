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
    CREATE TABLE `user_occupations` (
      `user_id` int(11) NOT NULL,
      `medical` tinytext NOT NULL,
      `IT` tinytext NOT NULL,
      `healthcare` tinytext NOT NULL,
      `business` tinytext NOT NULL,
      `foodservice` tinytext NOT NULL,
      `hospitality` tinytext NOT NULL,
      `culinary` tinytext NOT NULL,
      KEY `user_id` (`user_id`),
      FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");
  $stm->execute();

  $stm = $conn->prepare("
    CREATE TABLE `job_occupations` (
      `job_id` int(11) NOT NULL,
      `medical` tinytext NOT NULL,
      `IT` tinytext NOT NULL,
      `healthcare` tinytext NOT NULL,
      `business` tinytext NOT NULL,
      `foodservice` tinytext NOT NULL,
      `hospitality` tinytext NOT NULL,
      `culinary` tinytext NOT NULL,
      KEY `job_id` (`job_id`),
      FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");
  $stm->execute();

  $stm = $conn->prepare("
    CREATE TABLE `event_occupations` (
      `event_id` int(11) NOT NULL,
      `medical` tinytext NOT NULL,
      `IT` tinytext NOT NULL,
      `healthcare` tinytext NOT NULL,
      `business` tinytext NOT NULL,
      `foodservice` tinytext NOT NULL,
      `hospitality` tinytext NOT NULL,
      `culinary` tinytext NOT NULL,
      KEY `event_id` (`event_id`),
      FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ");
  $stm->execute();
?>
