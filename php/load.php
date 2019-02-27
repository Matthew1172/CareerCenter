<?php
require 'connect.php';

$data = array();

$query = "SELECT * FROM events ORDER BY event_id";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
     'id'           => $row["event_id"],
     'title'        => $row["title"],
     'description'  => $row["description"],
     'location'     => $row["location"],
     'dateStamp'    => $row["dateStamp"],
     'start'        => $row["startTime"],
     'end'          => $row["endTime"],
     'type'         => $row["type"]
 );
}

echo json_encode($data);

 ?>
