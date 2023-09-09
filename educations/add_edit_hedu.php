

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $perid = $_POST['perid'];
    $eduid = $_POST['eduid'];
    $edusemester = $_POST['edusemester'];
    $edugrade = $_POST['edugrade'];
    $edudetail = $_POST['edudetail'];

    $insertQuery = "INSERT INTO hedu (perid, eduid, edusemester, edugrade, edudetail) VALUES ('$perid', '$eduid', '$edusemester', '$edugrade', '$edudetail')";
    $result = mysqli_query($connection, $insertQuery);

    if ($result) {
        $logQuery = "INSERT INTO audit_log (action, table_name, record_id, user_id) VALUES ('INSERT', 'hedu', LAST_INSERT_ID(), <user_id>)";
        $logResult = mysqli_query($connection, $logQuery);
    }
}
