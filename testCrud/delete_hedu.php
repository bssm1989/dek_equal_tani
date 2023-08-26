<?php
$conn = new mysqli("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $heduid = $_POST['heduid'];
    $deleteQuery = "DELETE FROM hedu WHERE heduid='$heduid'";
    $result = mysqli_query($conn, $deleteQuery);
    if($result) {
        $logQuery = "INSERT INTO audit_log (action, table_name, record_id, user_id) VALUES ('DELETE', 'hedu', '$heduid', <user_id>)";
        $logResult = mysqli_query($conn, $logQuery);
    }
}