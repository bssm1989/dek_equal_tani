<?php
// Your database connection code here
require '../service/connect.php';
$conn = mysqli_connect("localhost", "root", "root", "dek_equal_tani");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$response = array();
$requiredFields = array(
    'national_id',
    'title_id',
    'name',
    'surname',
    'gender_id',
    'religion_id',
    'religion_other',
    // 'birth_date',
    'age',
    'address',
    'street',
    // 'village_id',
    'place_id',
    'postcode',
    'phone_number'
);

$missingFields = array();
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    $response['success'] = false;
    $response['message'] = 'Required fields are not set: ' . implode(', ', $missingFields);
    echo json_encode($response);
    exit(); // Stop further processing
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'insert') {
        // Insert data function
        function insertData($table, $data, $conn)
        {
            // ... Your code before
            // person	ตารางบุคคล				
            // ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
            // perid	bigint		รหัสบุคคล	PK	ลองดูว่าจะรันตัวเลขอย่างไร เช่น ปีเดือนวันเวลาวินาที หรือรันตัวเลขไปเรื่อยๆ
            // pid	varchar	13	เลขบัตรประชาชน		
            // titid	int	2	รหัสคำนำหน้าชื่อ	FK	มีตารางย่อย
            // name	varchar	50	ชื่อ		
            // sname	varchar	50	สกุล		
            // genid	int	1	รหัสเพศ	FK	มีตารางย่อย
            // religid	int	2	รหัสศาสนา	FK	มีตารางย่อย
            // religoth	varchar	30	กรณีศาสนาอื่น ๆ		
            // brtdte	varchar	8	ปีเดือนวันเกิด		เก็บ 8 หลัก เช่น 25660426
            // age	int	1	อายุ		กรณีระบุแค่อายุ ไม่ได้ระบุวันเดือนปีเกิด
            // adr	varchar	20	ที่อยู่ปัจจุบัน บ้านเลขที่		
            // soi	varchar	30	ถนน ซอย		
            // vllid	varchar	2	หมู่ที่		มีตารางย่อย เก็บ 2 หลัก เช่น 01, 02, 03
            // plcid	varchar	6	จังหวัดอำเภอตำบล		มีตารางย่อย 940101 เก็บ 6 หลัก
            // postcode	int	5	รหัสไปรษณีย์		
            // pertel	varchar	30	เบอร์โทรศัพท์		
            // hholdid	bigint	2	รหัสครัวเรือน	FK	มีตารางย่อย

            try {
                $columns = implode(', ', array_keys($data));
                $values = ':' . implode(', :', array_keys($data));

                $sql = "INSERT INTO $table ($columns) VALUES ($values)";
                $valuesString = '"' . implode('", "', array_map('addslashes', array_values($data))) . '"';
                $sql = str_replace($values, $valuesString, $sql);

                echo "SQL Query3: $sql<br>";

                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    echo ("Prepare failed: " . $conn->error);
                } else {
                    echo "Prepared Statement: ";
                    // var_dump($stmt); // Use var_dump instead of print_r
                    echo "<br>";
                }

                if($stmt->execute()){
                    echo "Inserted ID: " . $conn->lastInsertId() . "<br>";
                    return $conn->lastInsertId(); // Return the inserted ID
                } else {
                    echo "No rows were inserted.<br>";
                    return false;
                }
                exit();
                return $conn->lastInsertId(); // Return the inserted ID

                // Debugging statement to print the SQL query
                echo "SQL Query2: $sql<br>";

                $stmt = $conn->prepare($sql);

                // Debugging statement to print the prepared statement
                // echo "Prepared Statement: ";
                // var_dump($stmt); // Use var_dump instead of print_r
                // echo "<br>";

                //excuting the query if error show error message
                if ($stmt->execute()) {
                    echo "Inserted ID: " . $conn->lastInsertId() . "<br>";
                    return $conn->lastInsertId(); // Return the inserted ID
                } else {
                    echo "No rows were inserted.<br>";
                    return false;
                }
                // $stmt->execute();


                // Debugging statement to print the inserted ID
                echo "Inserted ID: " . $conn->lastInsertId() . "<br>";
                exit();
                return $conn->lastInsertId(); // Return the inserted ID
            } catch (PDOException $e) {
                // Debugging statement to print the error message
                echo "Error Message: " . $e->getMessage() . "<br>";
                exit();
                return false; // Return false on error
            }

            // ... Your code after

        }

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                $_POST[$field] = null;
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
            // 'vllid' => $_POST['village_id'],
            'plcid' => $_POST['place_id'],
            'postcode' => $_POST['postcode'],
            'pertel' => $_POST['phone_number'],
            'hholdid' => $_POST['household_id'],
            // ... other fields
        );

        // Remove null values from personData array
        $personData = array_filter($personData, function ($value) {
            return $value !== null;
        });

        $personInsert = insertData('person', $personData, $conn);

        // Rest of your code...

    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

// Return JSON response
echo json_encode($response);

// Close database connection
$conn->close();
