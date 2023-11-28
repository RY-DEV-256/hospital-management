<?php
include("../parts/db-con.php");

// Get the selected specialization from the query string
$selectedRoom = $_GET['room_id'];

// Query the database for doctors with the selected specialization
$beds = $connection->query("SELECT * FROM beds WHERE room_id = '$selectedRoom'");

// Create an array to hold the results
$results = [];

// Loop through each doctor and add their information to the results array
while ($row = $beds->fetch_assoc()) {
  $results[] = [
    'id' => $row['bed_id'],
    'name' => $row['bed_number']
  ];
}

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($results);
