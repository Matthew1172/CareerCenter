<?php
$host = 'localhost';
$db = 'test';

$username = 'root';
$pw = '123';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

try
{
	$conn = new PDO($dsn, $username, $pw);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if($conn)
	{
		echo("connected");
	}
}
catch (PDOException $e)
{
	echo $e->getMessage();
}

$sql = $conn->prepare("
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` tinytext NOT NULL,
  `user_last` tinytext NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `user_uid` tinytext NOT NULL,
  `user_pw` longtext NOT NULL,
  `user_type` tinytext NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `dateStamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `employers` (
  `employer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employer_company` tinytext NOT NULL,
  `employer_tax` varchar(30) NOT NULL,
  `employer_unemployNum` varchar(30) NOT NULL,
  `employer_web` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `description` longtext NOT NULL,
  `location` tinytext NOT NULL,
  `dateStamp` datetime NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `type` tinytext NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `job_title` tinytext NOT NULL,
  `job_description` longtext NOT NULL,
  `job_position` tinytext NOT NULL,
  `job_location` tinytext NOT NULL,
  `isMedical` tinytext,
  `isIT` tinytext,
  `isHealthcare` tinytext,
  `isBusiness` tinytext,
  `isFoodservice` tinytext,
  `isHospitality` tinytext,
  `isCulinary` tinytext,
  PRIMARY KEY (`job_id`),
  KEY `employer_id` (`employer_id`),
  CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `occupations` (
  `user_id` int(11) NOT NULL,
  `medical` tinytext NOT NULL,
  `IT` tinytext NOT NULL,
  `healthcare` tinytext NOT NULL,
  `business` tinytext NOT NULL,
  `foodservice` tinytext NOT NULL,
  `hospitality` tinytext NOT NULL,
  `culinary` tinytext NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `occupations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `seekers` (
  `seeker_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_stateNum` int(11) NOT NULL,
  PRIMARY KEY (`seeker_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `seekers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();

$sql = $conn->prepare("
CREATE TABLE `user_event` (
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `user_event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `user_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$sql->execute();
$result = $sql->fetch();
?>
