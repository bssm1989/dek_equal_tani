<?php
// Make sure the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection file
    require '../service/connect.php';
    require '../service/commonFns.php';
    $ofcid = $_SESSION['ofcid'];
    $ofcnme = $_SESSION['ofcnme'];
    // Function to sanitize input data
    function sanitizeInput($data)
    {
        return htmlspecialchars(trim($data));
    }

    // Sanitize and get POST data
    $action = sanitizeInput($_POST["action"]);
    $instid = sanitizeInput($_POST["instid"]);
    $instnme = sanitizeInput($_POST["instnme"]);
    $prvid = sanitizeInput($_POST["prvid"]);
    $instname = sanitizeInput($_POST["instname"]);
    $inssname = sanitizeInput($_POST["inssname"]);
    $inststdno = sanitizeInput($_POST["inststdno"]);
    $instinc = sanitizeInput($_POST["instinc"]);
    $instlandrai = sanitizeInput($_POST["instlandrai"]);
    $instlandngan = sanitizeInput($_POST["instlandngan"]);
    $instbulding = sanitizeInput($_POST["instbulding"]);
    $instvehicle = sanitizeInput($_POST["instvehicle"]);

    // Response array to send back to the client
    $response = array();

    if ($action === "add") {
        // Insert data into the institute table
        $sql = "INSERT INTO institute (instnme, prvid, instname, inssname, inststdno, instinc, instlandrai, instlandngan, instbulding, instvehicle) 
                VALUES ('$instnme', '$prvid', '$instname', '$inssname', '$inststdno', '$instinc', '$instlandrai', '$instlandngan', '$instbulding', '$instvehicle')";

        if (mysqli_query($conn, $sql)) {
            // Insert successful
            $response["success"] = true;
            $response["message"] = "Institute added successfully.";
        } else {
            // Insert failed
            $response["success"] = false;
            $response["message"] = "Failed to add institute. Please try again.";
        }
    } elseif ($action === "update") {
        // Update data in the institute table
        $sql = "UPDATE institute SET instnme='$instnme', prvid='$prvid', instname='$instname', inssname='$inssname', inststdno='$inststdno', instinc='$instinc', instlandrai='$instlandrai', instlandngan='$instlandngan', instbulding='$instbulding', instvehicle='$instvehicle' 
                WHERE instid='$instid'";

        if (mysqli_query($conn, $sql)) {
            // Update successful
            $response["success"] = true;
            $response["message"] = "Institute updated successfully.";
        } else {
            // Update failed
            $response["success"] = false;
            $response["message"] = "Failed to update institute. Please try again.";
        }
    } elseif ($action === "delete") {
        // Delete data from the institute table
        $sql = "DELETE FROM institute WHERE instid='$instid'";

        if (mysqli_query($conn, $sql)) {
            // Delete successful
            $response["success"] = true;
            $response["message"] = "Institute deleted successfully.";
        } else {
            // Delete failed
            $response["success"] = false;
            $response["message"] = "Failed to delete institute. Please try again.";
        }
    } else {
        // Invalid action
        $response["success"] = false;
        $response["message"] = "Invalid action.";
    }

    // Close the database connection
    mysqli_close($conn);

    // Send the response back as JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}
