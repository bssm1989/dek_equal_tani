<?php

require '../service/connect.php';
// Query to fetch amphur data
// Set UTF-8 charset
mysqli_set_charset($conn, "utf8");
	// #	Name	Type	Collation	Attributes	Null	Default	Comments	Extra	Action
	// 1	prvidgen Primary	varchar(2)	utf8_general_ci		No		รหัสจังหวัด		Change Change	Drop Drop	
	// 2	ampidgen Primary	varchar(2)	utf8_general_ci		No	None	รหัสอำเภอ		Change Change	Drop Drop	
	// 3	tmbidgen Primary	varchar(2)	utf8_general_ci		No	None	รหัสตำบล		Change Change	Drop Drop	
	// 4	prvnmegen	varchar(30)	utf8_general_ci		Yes	NULL	ชื่อจังหวัด		Change Change	Drop Drop	
	// 5	ampnmegen	varchar(24)	utf8_general_ci		Yes	NULL	ชื่ออำเภอ		Change Change	Drop Drop	
	// 6	tmbnmegen	varchar(20)	utf8_general_ci		Yes	NULL	ชื่อตำบล		Change Change	Drop Drop	
	// 7	plcidgen PrimaryIndex	varchar(6)	utf8_general_ci		No	None			Change Change	Drop Drop	
	// 8	plcnmegen	varchar(82)	utf8_general_ci		Yes	NULL			Change Change	Drop Drop	
	// 9	regionnme	varchar(30)	utf8_general_ci		Yes	NULL			Change Change	Drop Drop	


$sql = "SELECT DISTINCT prvidgen, ampidgen, tmbidgen, tmbnmegen FROM const_plcnmegen";
$result = $conn->query($sql);

$amphurs = array();



if ($result->num_rows > 0) {
    // Fetch data and populate the amphurs array
    while($row = $result->fetch_assoc()) {
        $amphurs[] = array(

            "ampidgen" => $row["prvidgen"]+$row["ampidgen"],
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
