<?php

require '../service/connect.php';
// Query to fetch amphur data
// Set UTF-8 charset
mysqli_set_charset($conn, "utf8");

$sql = "SELECT ampidgen, ampnmegen, prvidgen FROM const_plcnmegen";
$result = $conn->query($sql);

$amphurs = array();

if ($result->num_rows > 0) {
    // Fetch data and populate the amphurs array
    while($row = $result->fetch_assoc()) {
        $amphurs[] = array(
            "ampidgen" => $row["ampidgen"],
            "ampnmegen" => $row["ampnmegen"],
            "prvidgen" => $row["prvidgen"]
        );
    }
}

// Close the database connection
$conn->close();

// Output the amphurs array as JSON
echo "amphurs: " . json_encode($amphurs, JSON_UNESCAPED_UNICODE);
?>
