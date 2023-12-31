
<?php
// Your database connection code here
require '../service/connect.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

                        
   
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

                  echo  $sql;

                $user_id = $_SESSION['staffid'];
        mysqli_query($conn,"SET @user_id =$user_id,@query_value ='$sql'");
        $result = mysqli_query($conn, $sql);

                if ($result) {
                    // echo "Inserted ID: " . mysqli_insert_id($conn) . "<br>";
                    return true;// Return the inserted ID
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
               $updateString .= 'modified_by = "' . $_SESSION['staffid'] . '", modified_date = "' . date('Y-m-d H:i:s') . '"';
        $updateString = rtrim($updateString, ', ');

                $sql = "UPDATE $table SET $updateString WHERE $condition";

                // echo $sql;

                $user_id = $_SESSION['staffid'];
        mysqli_query($conn,"SET @user_id =$user_id,@query_value ='$sql'");
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
        hwrkid: 
perid: 4
occid: 1
prvid: 25
wrknme: ำพำพำพำพ
wrkstarty: 2
work_period_years: 1
work_period_months: 1
wrkendy: 2564
wrkendreas: กดกดกดกดกดกด
workplace_position: กด�
*/
/*hwork	ประวัติการประกอบอาชีพ				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hwrkid	bigint		รหัสประวัติการประกอบอาชีพ	PK	
perid	bigint		รหัสบุคคล --> รหัสเด็ก	FK	
occid	int	2	รหัสอาชีพ	FK	มีตารางย่อย
wrknme	varchar	30	ชื่อสถานประกอบการ		
prvid	varchar	2	จังหวัดที่ทำงาน	FK	มีตารางย่อย
wrkpos	varchar	30	ทำงานในตำแหน่ง		
wrkstarty	int	4	ปีที่เริ่มประกอบอาชีพ		เก็บ 4 หลัก เช่น 2566
wrkperiody	int	2	ทำงานเป็นระยะเวลกี่ปีกี่เดือน		หน่วย:: ปี
wrkperiodm	int	2	ทำงานเป็นระยะเวลกี่ปีกี่เดือน		หน่วย:: เดือน
wrkendy	int	4	ปีที่ลาออก		เก็บ 4 หลัก เช่น 2566
wrkendreas	varchar	200	เหตุผลที่ลาออก		
*/
        // Insert person data
        $hwrkidData = array(
            'perid'=> $_POST['perid'],
            'occid' => $_POST['occid'],
            'prvid' => $_POST['prvid'],
            'wrknme' => $_POST['wrknme'],
            'wrkstarty' => $_POST['wrkstarty'],
          'wrkperiody' => $_POST['work_period_years'],
            'wrkperiodm' => $_POST['work_period_months'],
            'wrkendy' => $_POST['wrkendy'],
            'wrkendreas' => $_POST['wrkendreas'],
            'wrkpos' => $_POST['workplace_position'],
            // ... other fields to insert


          
        );
       
        // Remove null values from personData array
        $hwrkidData = array_filter($hwrkidData, function ($value) {
            return $value !== null;
        });
   
        $personInsert = insertData('hwork', $hwrkidData, $conn);
        if ($personInsert) {
            $response['success'] = true;
            $response['message'] = 'Data inserted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error inserting  data.';
        }
       
        // Rest of your code...
/*
hwrkid: 4
perid: 4
occid: 3
prvid: 00
wrknme: สถานประกอบการที่ 4
workplace_position: ตำแหน่งงานที่ 4
wrkstarty: 2563
work_period_years: 4
work_period_months: 8
wrkendy: 2567
wrkendreas: เหตุผลลาออกที่ 4

hwork	ประวัติการประกอบอาชีพ				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hwrkid	bigint		รหัสประวัติการประกอบอาชีพ	PK	
perid	bigint		รหัสบุคคล --> รหัสเด็ก	FK	
occid	int	2	รหัสอาชีพ	FK	มีตารางย่อย
wrknme	varchar	30	ชื่อสถานประกอบการ		
prvid	varchar	2	จังหวัดที่ทำงาน	FK	มีตารางย่อย
wrkpos	varchar	30	ทำงานในตำแหน่ง		
wrkstarty	int	4	ปีที่เริ่มประกอบอาชีพ		เก็บ 4 หลัก เช่น 2566
wrkperiody	int	2	ทำงานเป็นระยะเวลกี่ปีกี่เดือน		หน่วย:: ปี
wrkperiodm	int	2	ทำงานเป็นระยะเวลกี่ปีกี่เดือน		หน่วย:: เดือน
wrkendy	int	4	ปีที่ลาออก		เก็บ 4 หลัก เช่น 2566
wrkendreas	varchar	200	เหตุผลที่ลาออก		
*/

    } elseif ($action === 'update') {

        $peridToUpdate = isset($_POST['perid']) ? $_POST['perid'] : '';

        if (!empty($peridToUpdate)) {
            $personDataToUpdate = array(
                'perid' => $_POST['perid'],
                'occid' => $_POST['occid'],
                'prvid' => $_POST['prvid'],
                'wrknme' => $_POST['wrknme'],
                'wrkstarty' => $_POST['wrkstarty'],
                'wrkperiody' => $_POST['work_period_years'],
                'wrkperiodm' => $_POST['work_period_months'],
                'wrkendy' => $_POST['wrkendy'],
                'wrkendreas' => $_POST['wrkendreas'],
                'wrkpos' => $_POST['workplace_position'],
                

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
        $personid = $_POST['hwrkid'];
        $updatePersonCondition = "hwrkid = $personid";
               
        
        $updatedPerson = updateData('hwork', $personDataToUpdate, $updatePersonCondition, $conn,$personid);

        if ($updatedPerson) {
            $response['success'] = true;
            $response['message'] = 'Person data updated successfully.';
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
