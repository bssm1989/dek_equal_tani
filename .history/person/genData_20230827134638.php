<?php

require '../service/connect.php';
// Query to fetch amphur data
// Set UTF-8 charset
mysqli_set_charset($conn, "utf8");
// 1	prvidgen	varchar(2)	utf8	utf8_general_ci	NO	NULL			รหัสจังหวัด
// 2	ampidgen	varchar(2)	utf8	utf8_general_ci	NO	NULL			รหัสอำเภอ
// 3	tmbidgen	varchar(2)	utf8	utf8_general_ci	NO	NULL			รหัสตำบล
// 4	vllidgen	varchar(2)	utf8	utf8_general_ci	NO	NULL			รหัสหมู่บ้าน
// 5	vllnmegen	varchar(110)	utf8	utf8_general_ci	YES	NULL			ชื่อหมู่บ้าน
// 6	plcid	varchar(10)	utf8	utf8_general_ci	YES	NULL			


$sql = "SELECT DISTINCT prvidgen, ampidgen, tmbidgen, tmbnmegen FROM const_plcnmegen";
$result = $conn->query($sql);

$amphurs = array();




if ($result->num_rows > 0) {
    // Fetch data and populate the amphurs array
    while($row = $result->fetch_assoc()) {
        $amphurs[] = array(

            "prvidgen" => $row["prvidgen"],
            "ampidgen" => $row["ampidgen"],
            "tmbidgen" => $row["tmbidgen"],
            "tmbnmegen" => $row["tmbnmegen"]

        );
    }
}

// Close the database connection
$conn->close();

// Output the amphurs array as JSON
echo "amphurs: " . json_encode($amphurs, JSON_UNESCAPED_UNICODE);
?>
