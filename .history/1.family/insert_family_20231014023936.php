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

// var_dump($_SESSION);
// var_dump($_SESSION);


function insertData($table, $data, $conn)
{
    // ... Your code before

    try {
        $columns = implode(', ', array_keys($data));
        $values = '"' . implode('", "', array_values($data)) . '"';
        // add session "staffid" to recorded_by and put datetime to recorded_date
        $columns .= ', recorded_by, recorded_date';
        $values .= ', "' . $_SESSION['staffid'] . '", "' . date('Y-m-d H:i:s') . '"';


        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        echo "SQL Query: $sql<br>";
        $user_id = $_SESSION['staffid'];
        mysqli_query($conn,"SET @user_id =$user_id");
        // mysqli_query($conn,"SET @query_value =$values");
        $result = mysqli_query($conn, $sql);
        // SET @user_id = $user_id"
       
        echo "SET @user_id = $user_id";
       

        if ($result) {
            // echo "Inserted ID: " . mysqli_insert_id($conn) . "<br>";
            return true; // Return the inserted ID
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
function updateData($table, $data, $condition, $conn, $id)
{
    // ... Your code before
    try {
        $updateString = '';
        foreach ($data as $key => $value) {
            $updateString .= "$key = '$value', ";
        }
        $updateString = rtrim($updateString, ', ');

        $sql = "UPDATE $table SET $updateString WHERE $condition";

        // echo $sql;

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


    */
        // Insert person data
        $personData = array(
            // 'hholdid' => $_POST['hholdid'],
            'adr' => $_POST['adr'],
            'soi' => $_POST['soi'],
            'vllid' => $_POST['vllid'],
            'plcid' => $_POST['plcid'],
            'postcode' => $_POST['plcid'],
            'memno' => $_POST['memno'],

            'hhdeponid' => $_POST['hhdeponid'],
            'hhtypid' => $_POST['hhtypid'],
            'hhrent' => $_POST['hhrent'],
            'hhflrid' => $_POST['hhflrid'],
            'hhwallid' => $_POST['hhwallid'],
            'hhrfid' => $_POST['hhrfid'],
            'hhtoilet' => $_POST['hhtoilet'],
            'havagrland' => $_POST['havagrland'],
            'agrlandid' => $_POST['agrlandid'],
            'hhwaterid' => $_POST['hhwaterid'],
            'havelect' => $_POST['havelect'],
            'hhelectid' => $_POST['hhelectid'],
            'vhcar' => $_POST['vhcar'],
            'vhcarage' => $_POST['vhcarage'],
            'vhtruck' => $_POST['vhtruck'],
            'vhtruckage' => $_POST['vhtruckage'],
            'vhtractor' => $_POST['vhtractor'],
            'vhtractorage' => $_POST['vhtractorage'],
            'vhmbike' => $_POST['vhmbike'],
            'vhno' => $_POST['vhno'],
            'hitemcomputer' => $_POST['hitemcomputer'],
            'hitemaircon' => $_POST['hitemaircon'],
            'hitemtvflat' => $_POST['hitemtvflat'],
            'hitemwashmachine' => $_POST['hitemwashmachine'],
            'hitemrefrige' => $_POST['hitemrefrige'],
            'hitemno' => $_POST['hitemno'],
            'hhimg1' => $_POST['hhimg1'],
            'hhimg2' => $_POST['hhimg2'],




        );

        // Remove null values from personData array
        $personData = array_filter($personData, function ($value) {
            return $value !== null;
        });

        $personInsert = insertData('hhold', $personData, $conn);
        if ($personInsert) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error inserting  data.';
        }

        // Rest of your code...

    } elseif ($action === 'update') {
        $peridToUpdate = isset($_POST['hholdid']) ? $_POST['hholdid'] : '';

        if (!empty($peridToUpdate)) {
            $personDataToUpdate = array(
               'hholdid' => $_POST['hholdid'],
            'adr' => $_POST['adr'],
            'soi' => $_POST['soi'],
            'vllid' => $_POST['vllid'],
            'plcid' => $_POST['plcid'],
            'postcode' => $_POST['plcid'],
            'memno' => $_POST['memno'],

            'hhdeponid' => $_POST['hhdeponid'],
            'hhtypid' => $_POST['hhtypid'],
            'hhrent' => $_POST['hhrent'],
            'hhflrid' => $_POST['hhflrid'],
            'hhwallid' => $_POST['hhwallid'],
            'hhrfid' => $_POST['hhrfid'],
            'hhtoilet' => $_POST['hhtoilet'],
            'havagrland' => $_POST['havagrland'],
            'agrlandid' => $_POST['agrlandid'],
            'hhwaterid' => $_POST['hhwaterid'],
            'havelect' => $_POST['havelect'],
            'hhelectid' => $_POST['hhelectid'],
            'vhcar' => $_POST['vhcar'],
            'vhcarage' => $_POST['vhcarage'],
            'vhtruck' => $_POST['vhtruck'],
            'vhtruckage' => $_POST['vhtruckage'],
            'vhtractor' => $_POST['vhtractor'],
            'vhtractorage' => $_POST['vhtractorage'],
            'vhmbike' => $_POST['vhmbike'],
            'vhno' => $_POST['vhno'],
            'hitemcomputer' => $_POST['hitemcomputer'],
            'hitemaircon' => $_POST['hitemaircon'],
            'hitemtvflat' => $_POST['hitemtvflat'],
            'hitemwashmachine' => $_POST['hitemwashmachine'],
            'hitemrefrige' => $_POST['hitemrefrige'],
            'hitemno' => $_POST['hitemno'],
            'hhimg1' => $_POST['hhimg1'],
            'hhimg2' => $_POST['hhimg2'],


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
        $personid = $_POST['hholdid'];
        $updatePersonCondition = "hholdid = $personid";


        $updatedPerson = updateData('hhold', $personDataToUpdate, $updatePersonCondition, $conn, $personid);

        if ($updatedPerson) {
            $response['success'] = true;
            $response['message'] = 'Data updated successfully.';
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
