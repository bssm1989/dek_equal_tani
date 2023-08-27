<?php

require '../service/connect.php';
// Query to fetch village data
// Set UTF-8 charset
mysqli_set_charset($conn, "utf8");

$sql = "SELECT vllidgen, vllnmegen, tmbidgen FROM const_vllnmegen"; // Replace with your table name
$result = $conn->query($sql);

$villages = array();

if ($result->num_rows > 0) {
    // Fetch data and populate the villages array
    while($row = $result->fetch_assoc()) {
        $villages[] = array(
            "vllidgen" => $row["vllidgen"],
            "vllnmegen" => $row["vllnmegen"],
            "tmbidgen" => $row["tmbidgen"]
        );
    }
}

// Close the database connection
$conn->close();

// Output the villages array as JSON
echo "villages: " . json_encode($villages, JSON_UNESCAPED_UNICODE);
?>
