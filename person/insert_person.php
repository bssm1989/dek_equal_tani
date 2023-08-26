<?php
// Your database connection code here
require '../service/connect.php';
require '../service/commonFns.php';
$response = array();

// Insert data function
function insertData($table, $data, $conn) {
    try {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);

        return $conn->lastInsertId(); // Return the inserted ID
    } catch (PDOException $e) {
        return false; // Return false on error
    }
}

// Insert person data
$personData = array(
    'pid' => $_POST['national_id'],
    'titid' => $_POST['title_id'],
    'name' => $_POST['name'],
    'sname' => $_POST['surname'],
    'genid' => $_POST['gender_id'],
    'religid' => $_POST['religion_id'],
    'religoth' => $_POST['religion_other'],
    'brtdte' => $_POST['birth_date'],
    'age' => $_POST['age'],
    'adr' => $_POST['address'],
    'soi' => $_POST['street'],
    'vllid' => $_POST['village_id'],
    'plcid' => $_POST['place_id'],
    'postcode' => $_POST['postcode'],
    'pertel' => $_POST['phone_number'],
    'hholdid' => $_POST['household_id'],
    // ... other fields
);

$personInsert = insertData('person', $personData, $conn);

if ($personInsert) {
    // Insert child data
    $childData = array(
        'perid' => $personInsert,
        'chiord' => $_POST['child_order'],
        'livewid' => $_POST['living_with'],
        // ... other fields
    );

    $childInsert = insertData('child', $childData, $conn);

    if ($childInsert) {
        // Insert dispform data
        $dispformData = array(
            'perid' => $personInsert,
            'dispfrmid' => $_POST['display_form'],
            // ... other fields
        );

        $dispformInsert = insertData('disptyp', $dispformData, $conn);

        if ($dispformInsert) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error inserting dispform data.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Error inserting child data.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Error inserting person data.';
}

// Return JSON response
echo json_encode($response);
?>
