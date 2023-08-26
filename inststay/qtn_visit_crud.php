<?php
@session_start();
require '../service/connect.php';

$act = $_POST["act"];

if ($act === "save") {
    $qtn_visid = $_POST["qtn_visid"] ?? '';
    $perid = trim($_POST["perid"]);
    $qtn_assessor = trim($_POST["qtn_assessor"]);
    $pos_ofcid = $_POST["pos_ofcid"];
    $qtn_round = $_POST["qtn_round"] ?? '';

    $qtn_date = $_POST["qtn_date"];
    // You might need to handle the date format conversion here if needed

    $weight = trim($_POST["weight"]);
    $height = trim($_POST["height"]);
    $waistline = trim($_POST["waistline"]);
    $blood_pressure = trim($_POST["blood_pressure"]);

    $help1 = isset($_POST["help1"]) ? 1 : 0;
    $help2 = isset($_POST["help2"]) ? 1 : 0;
    $help3 = isset($_POST["help3"]) ? 1 : 0;
    $help4 = isset($_POST["help4"]) ? 1 : 0;
    $help5 = isset($_POST["help5"]) ? 1 : 0;
    $help6 = isset($_POST["help6"]) ? 1 : 0;
    $help7 = isset($_POST["help7"]) ? 1 : 0;
    $helpoth = trim($_POST["helpoth"]);
    $help = "$help1,$help2,$help3,$help4,$help5,$help6,$help7";

    $qtnvs1 = $_POST["qtnvs1"];
    $qtnvs2 = $_POST["qtnvs2"];
    $qtnvs3 = $_POST["qtnvs3"];
    $qtnvs4 = $_POST["qtnvs4"];
    $qtnvs5 = $_POST["qtnvs5"];
    $qtnvs6 = $_POST["qtnvs6"];
    $qtnvs7 = $_POST["qtnvs7"];
    $qtnvs8 = $_POST["qtnvs8"];
    $qtnvs_sum = $_POST["qtnvs_sum"];
    $qtnvsoth = trim($_POST["qtnvsoth"]);

    // Insert or Update data to table
    if (empty($qtn_visid)) {
        $sql = "INSERT INTO questionnaire_visit (
            perid, qtn_assessor, pos_ofcid, qtn_round, qtn_date,
            weight, height, waistline, blood_pressure, help, helpoth,
            qtnvs1, qtnvs2, qtnvs3, qtnvs4, qtnvs5, qtnvs6, qtnvs7, qtnvs8, qtnvs_sum, qtnvsoth,
            savofc, savdte, updofc, upddte
        ) VALUES (
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?
        )";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss", 
            $perid, $qtn_assessor, $pos_ofcid, $qtn_round, $qtn_date, 
            $weight, $height, $waistline, $blood_pressure, $help, $helpoth, 
            $qtnvs1, $qtnvs2, $qtnvs3, $qtnvs4, $qtnvs5, $qtnvs6, $qtnvs7, $qtnvs8, $qtnvs_sum, $qtnvsoth, 
            $ofcid, $savdte, $ofcid, $upddte
        );
    } else {
        $sql = "UPDATE questionnaire_visit SET 
            perid=?, qtn_assessor=?, pos_ofcid=?, qtn_round=?, qtn_date=?, 
            weight=?, height=?, waistline=?, blood_pressure=?, help=?, helpoth=?, 
            qtnvs1=?, qtnvs2=?, qtnvs3=?, qtnvs4=?, qtnvs5=?, qtnvs6=?, qtnvs7=?, qtnvs8=?, qtnvs_sum=?, qtnvsoth=?, 
            updofc=?, upddte=? 
            WHERE qtn_visid=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssi", 
            $perid, $qtn_assessor, $pos_ofcid, $qtn_round, $qtn_date, 
            $weight, $height, $waistline, $blood_pressure, $help, $helpoth, 
            $qtnvs1, $qtnvs2, $qtnvs3, $qtnvs4, $qtnvs5, $qtnvs6, $qtnvs7, $qtnvs8, $qtnvs_sum, $qtnvsoth, 
            $ofcid, $upddte, $qtn_visid
        );
    }

    if (mysqli_stmt_execute($stmt)) {
        $returnValue = array("checkSave" => "yes", "qtn_visid0" => $qtn_visid);
        $output = json_encode($returnValue);
        echo $output;
    }
} elseif ($act === "delete") {
    $qtn_visid = $_POST["qtn_visid"];
    $sql = "DELETE FROM questionnaire_visit WHERE qtn_visid=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $qtn_visid);
    if (mysqli_stmt_execute($stmt)) {
        // Additional code to handle success or error after deletion
    }
}
?>
