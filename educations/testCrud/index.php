<?php
$connection = new mysqli("localhost", "dsrd", "L;=9,vxo", "dek_equal_tani");
// check connection error
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    exit();
}
include 'audit_log.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the form has fields like 'perid', 'eduid', 'edusemester', 'edugrade', 'edudetail'
    $perid = $_POST['perid'];
    $eduid = $_POST['eduid'];
    $edusemester = $_POST['edusemester'];
    $edugrade = $_POST['edugrade'];
    $edudetail = $_POST['edudetail'];

    // Insert the data into the 'hedu' table without specifying 'heduid'
    $insertQuery = "INSERT INTO hedu (heduid,perid, eduid, edusemester, edugrade, edudetail) VALUES (10,'$perid', '$eduid', '$edusemester', '$edugrade', '$edudetail')";
    $insertResult = mysqli_query($connection, $insertQuery);

    if ($insertResult) {
        // Get the last inserted record ID
        $recordId = mysqli_insert_id($connection);
        
        // Log the 'INSERT' action to the audit log
        $userId = 1; // Replace with the actual user ID
        logAction('INSERT', 'hedu', $recordId, $userId);
        
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Educational Record CRUD</title>
</head>
<body>
    <h2>Add Educational Record</h2>
    <form method="post">
        <label for="perid">Person ID:</label>
        <input type="text" name="perid" value="1" required><br>

        <label for="eduid">Education Level:</label>
        <input type="text" name="eduid"  value="1"  required><br>

        <label for="edusemester">Semester:</label>
        <input type="text" name="edusemester"  value="1"  required><br>

        <label for="edugrade">Grade:</label>
        <input type="text" name="edugrade"  value="1"  required><br>

        <label for="edudetail">Details:</label>
        <input type="text" name="edudetail"  required><br>

        <button type="submit">Add Record</button>
    </form>


<!-- show table data -->
<h2>Educational Record List</h2>
<table border="1">
    <tr>
        <th>Person ID</th>
        <th>Education Level</th>
        <th>Semester</th>
        <th>Grade</th>
        <th>Details</th>
        <th>Action</th>
    </tr>
    <?php
    $selectQuery = "SELECT * FROM hedu";
    $selectResult = mysqli_query($conn, $selectQuery);
    var_dump($selectResult);

    if (mysqli_num_rows($selectResult) > 0) {
        while ($row = mysqli_fetch_assoc($selectResult)) {
            echo "<tr>";
            echo "<td>" . $row['perid'] . "</td>";
            echo "<td>" . $row['eduid'] . "</td>";
            echo "<td>" . $row['edusemester'] . "</td>";
            echo "<td>" . $row['edugrade'] . "</td>";
            echo "<td>" . $row['edudetail'] . "</td>";
            echo "<td>";
            echo "<a href='edit_hedu.php?heduid=" . $row['heduid'] . "'>Edit</a> | ";
            echo "<a href='delete_hedu.php?heduid=" . $row['heduid'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found.</td></tr>";
    }
    ?>
</body>
</html>
