<?php
// Make sure to update the database connection settings if needed
require '../service/connect.php';

// Create a database connection
// Query to fetch distinct dispfrmnme values from the dispform table
$sql = "SELECT DISTINCT edulevnme FROM edulev";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error fetching data: " . $conn->error);
}

// Create an array to store the distinct dispfrmnme values
$dispfrmnmeValues = array();

// Loop through the query result and add the dispfrmnme values to the array
while ($row = $result->fetch_assoc()) {
    $dispfrmnmeValues[] = $row['edulevnme'];
}

// Close the database connection
$conn->close();

// Return the dispfrmnme values as a JSON response
header('Content-Type: application/json');
echo json_encode($dispfrmnmeValues);
?>
