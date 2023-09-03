<?php
// Your database connection code here
require '../service/connect.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//$conn = @mysqli_connect("localhost", "root", "root", "dek_equal_tani") or die(mysqli_connect_error());
//change to pdo
$conn = new PDO('mysql:host=localhost;dbname=dek_equal_tani', 'root', 'root');
// $dbh = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');

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
    'phone_number',
    'dispform',
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

        // echo "SQL Query3: $sql<br>";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo ("Prepare failed: " . $conn->error);
        } else {
            // echo "Prepared Statement: ";
            // var_dump($stmt); // Use var_dump instead of print_r
            // echo "<br>";
        }
        // echo "Before Insertion: Last Inserted ID: " . $conn->lastInsertId() . "<br>";
        if ($stmt->execute()) {
            // echo "Insertion successful!<br>";
            // Debugging statement to print the inserted data
            // $temp =  $conn->lastInsertId();
            //
            // echo "Inserted Data: ";
            //

            //    var_dump($temp);
            // Debugging statement to print the inserted ID
            // echo "Inserted ID: " . $conn->lastInsertId() . "<br>";

            return $conn->lastInsertId(); // Return the inserted ID
            // return true;
        } else {
            echo "Insertion failed.<br>";
            // print_r($stmt->errorInfo()); // Print detailed error info
            return false;
        }

        // return $conn->lastInsertId(); // Return the inserted ID

    } catch (PDOException $e) {
        // Debugging statement to print the error message
        echo "Error Message: " . $e->getMessage() . "<br>";
        exit();
        return false; // Return false on error
    }

    // ... Your code after

}
function updateData($table, $data, $condition, $conn, $personid)
{
    try {
        $updateFields = array();
        foreach ($data as $key => $value) {
            $updateFields[] = "$key = :$key";
        }
        $updateFieldsString = implode(', ', array_keys($data));
        $values = ':' . implode(', :',array_keys($data));
var_dump($updateFields);
        $sql = "UPDATE $table SET $updateFields WHERE $condition";
        $valuesString = '"' . implode('", "', array_map('addslashes', array_values($data))) . '"';
        $sql = str_replace($values, $valuesString, $sql);


        // $updateFields = array();
        // foreach ($data as $key => $value) {
        //     $updateFields[] = "$key = :$key";
        // }
        // $updateFieldsString = implode(', ', $updateFields);

        // $sql = "UPDATE $table SET $updateFieldsString WHERE $condition";
        // $valuesString = '"' . implode('", "', array_map('addslashes', array_values($data))) . '"';
        // $sql = str_replace($updateFieldsString, $valuesString, $sql);
        // //str_replace personid
        // $valuesString = '"' . implode('", "', array_map('addslashes', array_values($personid))) . '"';
      




        
        echo "SQL Query: $sql<br>";

        $stmt = $conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true; 
        } else {
            echo "Update failed.<br>";
            print_r($stmt->errorInfo()); 
            return false;
        }
    } catch (PDOException $e) {
        echo "Error Message: " . $e->getMessage() . "<br>";
        exit();
        return false; 
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'insert') {
        // Insert data function

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
        if ($personInsert !== false && $personInsert !== null) {
            // child	ตารางข้อมูลเฉพาะเด็ก				
            // ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
            // perid	bigint		รหัสเด็ก	PK FK	
            // chiphoto	image		รูปถ่ายเด็ก		เก็บ 1 รูป
            // chiord	int	2	เป็นบุตรคนที่เท่าไหร่		
            // livewid	int	2	นักเรียนอาศัยอยู่กับใคร	FK	มีตารางย่อย
            // famsttid	int	2	รหัสสถานภาพครอบครัว	FK	มีตารางย่อย
            // distschkm	int	3	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร		หน่วย:: กิโลเมตร
            // distschm	int	3	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร		หน่วย:: เมตร
            // distschhrs	int	2	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที		หน่วย:: ชั่วโมง
            // distschmin	int	2	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที		หน่วย:: นาที
            // farepay	int	4	ค่าใช้จ่ายในการเดินทางไป-กลับกี่บาท/เดือน		หน่วย:: บาท/เดือน
            // schmethid	int	2	รหัสวิธีเดินทางหลัก	FK	มีตารางย่อย
            // chidetail	varchar	1000	รายละเอียดเชิงคุณภาพ		
            // Insert child data

            //             Type: select Name: title_id Value: 2
            // VM40596:16 Type: input Name: name Value: bassam.u
            // VM40596:16 Type: input Name: surname Value: e
            // VM40596:16 Type: input Name: national_id Value: 22222222222
            // VM40596:16 Type: select Name: gender_id Value: 1
            // VM40596:16 Type: select Name: religion_id Value: 1
            // VM40596:16 Type: input Name: religion_other Value: 
            // VM40596:16 Type: input Name: birth_date Value: 
            // VM40596:16 Type: input Name: age Value: 2
            // VM40596:16 Type: input Name: postcode Value: 94000
            // VM40596:16 Type: input Name: address Value: 52 m.3, T.talubo a.muang
            // VM40596:16 Type: input Name: street Value: erererere
            // VM40596:16 Type: input Name: place_id Value: 10040300
            // VM40596:16 Type: select Name: undefined Value: 10
            // VM40596:16 Type: select Name: undefined Value: 04
            // VM40596:16 Type: select Name: undefined Value: 03
            // VM40596:16 Type: input Name: phone_number Value: 2
            // VM40596:16 Type: input Name: child_order Value: 2
            // VM40596:16 Type: select Name: livew_id Value: 3
            // VM40596:16 Type: select Name: family_status Value: 5
            // VM40596:16 Type: input Name: distance_to_school_km Value: 2
            // VM40596:16 Type: input Name: distance_to_school_m Value: 3
            // VM40596:16 Type: input Name: travel_time_to_school_hour Value: 4
            // VM40596:16 Type: input Name: travel_time_to_school_minute Value: 5
            // VM40596:16 Type: input Name: fare_per_month Value: 2
            // VM40596:16 Type: select Name: main_transportation_id Value: 4
            // VM40596:16 Type: select Name: dispform Value: 1
            $childData = array(
                'perid' => $personInsert,
                'chiord' => $_POST['child_order'],
                'livewid' => $_POST['livew_id'],
                'famsttid' => $_POST['family_status'],
                'distschkm' => $_POST['distance_to_school_km'],
                'distschm' => $_POST['distance_to_school_m'],
                'distschhrs' => $_POST['travel_time_to_school_hours'],
                'distschmin' => $_POST['travel_time_to_school_minutes'],
                'farepay' => $_POST['fare_per_month'],
                'schmethid' => $_POST['main_transportation_id'],
                'chidetail' => $_POST['child_details'],


                // ... add more fields as needed
            );
            $childData = array_filter($childData, function ($value) {
                return $value !== null;
            });
            $childInsert = insertData('child', $childData, $conn);

            if ($childInsert !== false && $childInsert !== null) {
                // Insert dispform data
                $dispformData = array(
                    'perid' => $personInsert,
                    'dispfrmid' => $_POST['dispform'],
                    // ... other fields
                );

                $dispformInsert = insertData('disptyp', $dispformData, $conn);

                if ($dispformInsert !== false && $dispformInsert !== null) {
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

        // Rest of your code...

    } elseif ($action === 'update') {
        $peridToUpdate = isset($_POST['perid']) ? $_POST['perid'] : '';

        if (!empty($peridToUpdate)) {
            $personDataToUpdate = array(
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

                // ... other fields to update
            );
        }

        $personDataToUpdate = array_filter($personDataToUpdate, function ($value) {
            return $value !== null;
        });
        // foreach ($personDataToUpdate as $key => $value) {
        //     if ($value === '') {
        //         $personDataToUpdate[$key] = null;
        //     }
        // }

        $updatePersonCondition = "perid = :perid";
        $personid['perid'] = $peridToUpdate;
        
        $updatedPerson = updateData('person', $personDataToUpdate, $updatePersonCondition, $conn, $personid);

        if ($updatedPerson) {
            // Update child data
            $childDataToUpdate = array(
                    'chiord' => $_POST['child_order'],
                    'livewid' => $_POST['livew_id'],
                    'famsttid' => $_POST['family_status'],
                    'distschkm' => $_POST['distance_to_school_km'],
                    'distschm' => $_POST['distance_to_school_m'],
                    'distschhrs' => $_POST['travel_time_to_school_hours'],
                    'distschmin' => $_POST['travel_time_to_school_minutes'],
                    'farepay' => $_POST['fare_per_month'],
                    'schmethid' => $_POST['main_transportation_id'],
                    'chidetail' => $_POST['child_details'],
    
    
                    // ... add more fields as needed
             

            );

            // Convert fields with empty values to null for child data
            foreach ($childDataToUpdate as $key => $value) {
                if ($value === '') {
                    $childDataToUpdate[$key] = null;
                }
            }

            $updateChildCondition = "perid = :perid"; // Use the appropriate condition for updating child data
            $childDataToUpdate['perid'] = $peridToUpdate;

            $updatedChild = updateData('child', $childDataToUpdate, $updateChildCondition, $conn);

            if ($updatedChild) {
                // Update dispform data
                $dispformDataToUpdate = array(
                    'dispfrmid' => $_POST['dispform'],

                    // ... other dispform fields to update
                );

                $updateDispformCondition = "perid = :perid"; // Use the appropriate condition for updating dispform data
                $dispformDataToUpdate['perid'] = $peridToUpdate;

                // Convert fields with empty values to null for dispform data
                foreach ($dispformDataToUpdate as $key => $value) {
                    if ($value === '') {
                        $dispformDataToUpdate[$key] = null;
                    }
                }

                $updatedDispform = updateData('disptyp', $dispformDataToUpdate, $updateDispformCondition, $conn);

                if ($updatedDispform) {
                    $response['success'] = true;
                    $response['message'] = 'Data updated successfully.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Error updating dispform data.';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Error updating child data.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Error updating person data.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
