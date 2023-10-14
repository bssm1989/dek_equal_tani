<?php
// Your database connection code here
require '../service/connect.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//$conn = @mysqli_connect("localhost", "root", "root", "dek_equal_tani") or die(mysqli_connect_error());
//change to pdo
// $conn = new PDO('mysql:host=localhost;dbname=dek_equal_tani', 'root', 'root');
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
function insertData2($table, $data, $conn)
{
    /*

adr: 123 ถนนเมนe
soi: ถนนเมน2
vllid: 012
plcid: 11020100
memno: 52
hhdeponid: 4
hhtypid: 4
hhrent: 102
hhflrid: 5
hhwallid: 5
hhrfid: 5
hhtoilet: 12
havagrland: 21
agrlandid: 2
hhwaterid: 3
havelect: 12
hhelectid: 2
vhcar: 2
vhcarage: 22
vhtruck: 1
vhtruckage: 1
vhtractor: 1
vhtractorage": 1
vhmbike: 1
vhno: 1
hitemcomputer: 2
hitemaircon: 2
hitemtvflat: 2
hitemwashmachine: 2
hitemrefrige: 2
hitemno: 2


hhold	ข้อมูลครัวเรือน/ครอบครัว				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hholdid	bigint		รหัสครัวเรือน	PK	
adr	varchar	20	ที่อยู่ปัจจุบัน บ้านเลขที่		ต้องตรงกันกับที่อยู่ในตาราง person
soi	varchar	30	ถนน ซอย		ต้องตรงกันกับที่อยู่ในตาราง person
vllid	varchar	2	หมู่ที่		มีตารางย่อย เก็บ 2 หลัก เช่น 01, 02, 03 ต้องตรงกันกับที่อยู่ในตาราง person
plcid	varchar	6	จังหวัดอำเภอตำบล		มีตารางย่อย 940101 เก็บ 6 หลัก ต้องตรงกันกับที่อยู่ในตาราง person
postcode	int	5	รหัสไปรษณีย์		
memno	int	2	จำนวนสมาชิกในครัวเรือน (รวมตัวนักเรียน)		
hhdeponid	int	2	รหัสครัวเรือนมีภาระพึ่งพิง	FK	มีตารางย่อย
hhtypid	int	2	รหัสการอยู่อาศัย	FK	มีตารางย่อย
hhrent	int	5	กรณีอยู่บ้านเช่า เช่าเดือนละกี่บาท	
hhflrid	int	2	รหัสวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)	FK	มีตารางย่อย
hhwallid	int	2	รหัสวัสดุที่ใช้ทำฝาบ้าน	FK	มีตารางย่อย
hhrfid	int	2	รหัสวัสดุที่ใช้ทำหลังคา	FK	มีตารางย่อย
hhtoilet	int	1	มีห้องส้วมในที่อยู่อาศัย/บริเวณบ้าน		1=yes, 0=no
havagrland	int	1	มีดินทำการเกษตรได้(รวมเช่า)		0=ไม่ทำเกษตร, 1=ทำเกษตร
agrlandid	int	2	กรณีทำการเกษตร มีที่ดินจำนวนกี่ไร่	FK	มีตารางย่อย
hhwaterid	int	2	รหัสแหล่งน้ำดื่ม	FK	มีตารางย่อย
havelect	int	1	มีไฟฟ้าใช้หรือไม่		0=ไม่มีไฟฟ้า/ไม่มีเครื่องกำเนิดไฟฟ้าชนิดอื่น ๆ, 1=มีไฟฟ้า
hhelectid	int	2	กรณีมีไฟฟ้าใช้ ให้ระบุแหล่งไฟฟ้า	FK	มีตารางย่อย
vhcar	int	1	ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถยนต์นั่งส่วนบุคคล		1=yes, 0=no
vhcarage	int	1	อายุ:: รถยนต์นั่งส่วนบุคคล		1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี
vhtruck	int	1	ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้		1=yes, 0=no
vhtruckage	int	1	อายุ:: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้		1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี
vhtractor	int	1	ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน		1=yes, 0=no
vhtractorage	int	1	อายุ:: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน		1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี
vhmbike	int	1	ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถมอเตอร์ไซต์/เรือประมงพื้นบ้าน (ขนาดเล็ก) 		1=yes, 0=no
vhno	int	1	ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: ไม่มียานพาหนะในครัวเรือน		1=yes, 0=no
hitemcomputer	int	1	ของใช้ในครัวเรือน (ที่ใช้งานได้):: คอมพิวเตอร์		1=yes, 0=no
hitemaircon	int	1	ของใช้ในครัวเรือน (ที่ใช้งานได้):: แอร์		1=yes, 0=no
hitemtvflat	int	1	ของใช้ในครัวเรือน (ที่ใช้งานได้):: ทีวีจอแบน		1=yes, 0=no
hitemwashmachine	int	1	ของใช้ในครัวเรือน (ที่ใช้งานได้):: เครื่องซักผ้า		1=yes, 0=no
hitemrefrige	int	1	ของใช้ในครัวเรือน (ที่ใช้งานได้):: ตู้เย็น		1=yes, 0=no
hitemno	int	1	ของใช้ในครัวเรือน (ที่ใช้งานได้):: ไม่มีของใช้ดังกล่าว		1=yes, 0=no
hhimg1	image		กรุณาถ่ายให้เห็น หลังคาและฝาผนังของที่พักอาศัยทั้งหลัง		เก็บ 1 รูป
hhimg2	image		กรุณาถ่ายให้เห็น พื้นและบริเวณภายในของที่พักอาศัย		เก็บ 1 รูป


    *?
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
   function insertData($table, $data, $conn)
        {
            // ... Your code before

            try {
                $columns = implode(', ', array_keys($data));
                $values = '"' . implode('", "', array_values($data)) . '"';
                $sql = "INSERT INTO $table ($columns) VALUES ($values)";

                // echo "SQL Query: $sql<br>";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    // echo "Inserted ID: " . mysqli_insert_id($conn) . "<br>";
                    return mysqli_insert_id($conn); // Return the inserted ID
                } else {
                    // echo "Query execution failed.<br>";
                    return false;
                }
            } catch (Exception $e) {
                // echo "Error Message: " . $e->getMessage() . "<br>";
                return false; // Return false on error
            }

            // ... Your code after

        }
        function updateData($table, $data, $condition, $conn,$id)
        {
            // ... Your code before
            try {
                $updateString = '';
                foreach ($data as $key => $value) {
                    $updateString .= "$key = '$value', ";
                }
                $updateString = rtrim($updateString, ', ');

                $sql = "UPDATE $table SET $updateString WHERE $condition";

                // echo "SQL Query: $sql<br>";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    // echo "Updated ID: " .$id;
                    return $id; // Return the updated ID
                } else {
                    // echo "Query execution failed.<br>";
                    return false;
                }
            } catch (Exception $e) {
                // echo "Error Message: " . $e->getMessage() . "<br>";
                return false; // Return false on error
            }

            // ... Your code after

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
                'distschhrs' => $_POST['travel_time_to_school_hour'],
                'distschmin' => $_POST['travel_time_to_school_minute'],
                'farepay' => $_POST['fare_per_month'],
                'schmethid' => $_POST['main_transportation_id'],
                'chidetail' => $_POST['child_details'],


                // ... add more fields as needed
            );
            // var_dump($childData);
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
//make  get perid to make condition in update
        $personid = $_POST['perid'];
        $updatePersonCondition = "perid =$personid"; // Use the appropriate condition for updating person data  
               
        
        $updatedPerson = updateData('person', $personDataToUpdate, $updatePersonCondition, $conn,$personid);

        if ($updatedPerson) {
            // Update child data
            $childDataToUpdate = array(
                    'chiord' => $_POST['child_order'],
                    'livewid' => $_POST['livew_id'],
                    'famsttid' => $_POST['family_status'],
                    'distschkm' => $_POST['distance_to_school_km'],
                    'distschm' => $_POST['distance_to_school_m'],
                    // if distschhrs' ==0 is null
                    'distschhrs' => $_POST['travel_time_to_school_hour'],

                    'distschmin' => $_POST['travel_time_to_school_minute'],
                    'farepay' => $_POST['fare_per_month'],
                    'schmethid' => $_POST['main_transportation_id'],
                    'chidetail' => $_POST['child_details'],
    
    
                    // ... add more fields as needed
             

            );
            // var_dump($childDataToUpdate);

            // Convert fields with empty values to null for child data
            foreach ($childDataToUpdate as $key => $value) {
                if ($value === '') {
                    $childDataToUpdate[$key] = null;
                }
            }

            $updateChildCondition ="perid = $personid"; // Use the appropriate condition for updating child data

           

            $updatedChild = updateData('child', $childDataToUpdate, $updateChildCondition, $conn,$personid);

            if ($updatedChild) {
                // Update dispform data
                $dispformDataToUpdate = array(
                    'dispfrmid' => $_POST['dispform'],

                    // ... other dispform fields to update
                );

                $updateDispformCondition = "perid = $personid"; // Use the appropriate condition for updating dispform data

                // Convert fields with empty values to null for dispform data
                foreach ($dispformDataToUpdate as $key => $value) {
                    if ($value === '') {
                        $dispformDataToUpdate[$key] = null;
                    }
                }


                $updatedDispform = updateData('disptyp', $dispformDataToUpdate, $updateDispformCondition, $conn,$personid);

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
