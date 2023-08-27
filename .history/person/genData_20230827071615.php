<?php
// Path: person/genData.php

require '../service/connect.php';
// Query to fetch province data
$sql = "SELECT prvidgen, prvnmegen FROM const_plcnmegen";
$result = $conn->query($sql);

$provinces = array();

if ($result->num_rows > 0) {
    // Fetch data and populate the provinces array
    while($row = $result->fetch_assoc()) {
        $provinces[] = array(
            "prvidgen" => $row["prvidgen"],
            "prvnmegen" => $row["prvnmegen"]
        );
    }
}

// Close the database connection
$conn->close();

// Output the provinces array as JSON
echo json_encode($provinces);