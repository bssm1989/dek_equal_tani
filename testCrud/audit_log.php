<?php
$conn = new mysqli("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani");

function logAction($action, $table, $recordId, $userId) {
    $logQuery = "INSERT INTO audit_log (action, table_name, record_id, user_id) VALUES ('$action', '$table', '$recordId', '$userId')";
    $logResult = mysqli_query($conn, $logQuery);

    return $logResult;
}
//close the connection
mysqli_close($conn);
