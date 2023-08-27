<?php

require '../service/connect.php';
// Query to fetch village data
// Set UTF-8 charset
mysqli_set_charset($conn, "utf8");
	// #	Name	Type	Collation	Attributes	Null	Default	Comments	Extra	Action
	// 1	prvidgen Primary	varchar(2)	utf8_general_ci		No	None	รหัสจังหวัด		Change Change	Drop Drop	
	// 2	ampidgen Primary	varchar(2)	utf8_general_ci		No	None	รหัสอำเภอ		Change Change	Drop Drop	
	// 3	tmbidgen Primary	varchar(2)	utf8_general_ci		No	None	รหัสตำบล		Change Change	Drop Drop	
	// 4	vllidgen Primary	varchar(2)	utf8_general_ci		No	None	รหัสหมู่บ้าน		Change Change	Drop Drop	
	// 5	vllnmegen	varchar(110)	utf8_general_ci		Yes	NULL	ชื่อหมู่บ้าน		Change Change	Drop Drop	
	// 6	plcid	varchar(10)	utf8_general_ci		Yes	NULL			Change Change	Drop Drop	


$sql = "SELECT prvidgen,ampidgen, tmbidgen, vllidgen, vllnmegen,plcid FROM const_vllnmegen"; // Replace with your table name
$result = $conn->query($sql);

$villages = array();

if ($result->num_rows > 0) {
    // Fetch data and populate the villages array
    while($row = $result->fetch_assoc()) {
        $villages[] = array(
            "prvidgen" => $row["prvidgen"],
            "ampidgen" => $row["ampidgen"],
            "tmbidgen" => $row["tmbidgen"],

            "vllidgen" => $row["vllidgen"],
            "vllnmegen" => $row["vllnmegen"],
            "plcid" => $row["plcid"],
           
        );
    }
}

// Close the database connection
$conn->close();

// Output the villages array as JSON
echo "villages: " . json_encode($villages, JSON_UNESCAPED_UNICODE);
?>
