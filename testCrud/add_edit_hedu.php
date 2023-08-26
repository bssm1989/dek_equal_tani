<?php
$conn = new mysqli("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $perid = $_POST['perid'];
    $eduid = $_POST['eduid'];
    $edusemester = $_POST['edusemester'];
    $edugrade = $_POST['edugrade'];
    $edudetail = $_POST['edudetail'];

    $insertQuery = "INSERT INTO hedu (perid, eduid, edusemester, edugrade, edudetail) VALUES ('$perid', '$eduid', '$edusemester', '$edugrade', '$edudetail')";
    $result = mysqli_query($conn, $insertQuery);

    if ($result) {
        $logQuery = "INSERT INTO audit_log (action, table_name, record_id, user_id) VALUES ('INSERT', 'hedu', LAST_INSERT_ID(), <user_id>)";
        $logResult = mysqli_query($conn, $logQuery);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $heduid = $_POST['heduid'];
    $edusemester = $_POST['edusemester'];
    $edugrade = $_POST['edugrade'];
    $edudetail = $_POST['edudetail'];

    $updateQuery = "UPDATE hedu SET edusemester='$edusemester', edugrade='$edugrade', edudetail='$edudetail' WHERE heduid='$heduid'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        $logQuery = "INSERT INTO audit_log (action, table_name, record_id, user_id) VALUES ('UPDATE', 'hedu', '$heduid', <user_id>)";
        $logResult = mysqli_query($conn, $logQuery);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $heduid = $_POST['heduid'];

    $deleteQuery = "DELETE FROM hedu WHERE heduid='$heduid'";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        $logQuery = "INSERT INTO audit_log (action, table_name, record_id, user_id) VALUES ('DELETE', 'hedu', '$heduid', <user_id>)";
        $logResult = mysqli_query($conn, $logQuery);
    }
}
//close the connection
mysqli_close($conn);
