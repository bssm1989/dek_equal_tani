<?php

require '../service/connect.php';
// Query to fetch province data
// Set UTF-8 charset
mysqli_set_charset($conn, "utf8");

$sql = "SELECT DISTINCT  prvidgen, prvnmegen FROM const_plcnmegen";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output JSON start
    echo "[";
    
    $firstRow = true;
    
    // Fetch data and output as JSON
    while($row = $result->fetch_assoc()) {
        if (!$firstRow) {
            echo ",";
        }
        echo json_encode(array(
            "prvidgen" => $row["prvidgen"],
            "prvnmegen" => $row["prvnmegen"]
        ), JSON_UNESCAPED_UNICODE);
        
        $firstRow = false;
    }
    
    // Output JSON end
    echo "]";
}

// Close the database connection
$conn->close();
?>
