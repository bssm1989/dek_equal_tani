<?php
// Connect to the database
require '../service/connect.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['query'])) {

    $term = $_GET['query'];
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
    // Query to fetch matching person names

    // For the initial load, limit the results to 20
    $query = "SELECT p.*
                  FROM person p
                  LEFT JOIN child c ON p.perid = c.perid
                  LEFT JOIN htraining h ON p.perid = h.perid
                  WHERE c.perid IS NOT NULL AND h.perid IS NULL 
                  AND CONCAT(p.name, ' ', p.sname) LIKE '%$term%'
              
                  LIMIT 20";

    $result = mysqli_query($conn, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        // Format data for Select2
        $data[] = array(
            'id' => $row['perid'],
            'text' => $row['name'] . ' ' . $row['sname']
        );
    }

    // Return JSON response
    echo json_encode($data);
}
