<?php
$hwrkid = $_GET["id"]; // Get hwrkid from page showing the list of hwork
if ($hwrkid) {
    // Construct your SQL query to fetch hwork details and related information
    $sql = "SELECT p.perid AS person_id, p.pid AS national_id, p.titid AS title_id,
    t.titnme AS title_name, p.name, p.sname AS surname, p.genid AS gender_id,
    g.gennme AS gender_name, p.religid AS religion_id, r.relignme AS religion_name,
    p.brtdte AS birth_date, p.age, p.adr AS address, p.soi AS street,
    p.vllid AS village_id, v.vllnme AS village_name, p.plcid AS place_id,
    plc.plcnme AS place_name, p.postcode, p.pertel AS phone_number,
    p.hholdid AS household_id, c.chiord AS child_order, l.livewnme AS living_with,
    f.famsttnme AS family_status, c.distschkm AS distance_km_m,
    c.distschm AS distance_m, c.distschhrs AS distance_hours,
    c.distschmin AS distance_minutes, c.farepay AS fare_per_month,
    m.schmethid AS main_transportation_id, m.schmethnme AS main_transportation,
    c.chidetail AS child_detail, df.dispfrmnme AS display_form
FROM person p
LEFT JOIN titname t ON p.titid = t.titid
LEFT JOIN gender g ON p.genid = g.genid
LEFT JOIN relig r ON p.religid = r.religid
LEFT JOIN vll v ON p.vllid = v.vllid
LEFT JOIN plc ON p.plcid = plc.plcid
LEFT JOIN child c ON p.perid = c.perid
LEFT JOIN livew l ON c.livewid = l.livewid
LEFT JOIN famstt f ON c.famsttid = f.famsttid
LEFT JOIN schmethod m ON c.schmethid = m.schmethid
LEFT JOIN disptyp dt ON p.perid = dt.perid
LEFT JOIN dispform df ON df.dispfrmid = dt.dispfrmid
WHERE p.perid = $perid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $perid = $row["person_id"];
        $national_id = $row["national_id"];
        $title_id = $row["title_id"];
        $title_name = $row["title_name"];
        $name = $row["name"];
        $regional_id = $row["regional_id"];
        $regional_name = $row["regional_name"];
        $birth_date = $row["birth_date"];
        $age = $row["age"];
        $address = $row["address"];
        $street = $row["street"];
        $village_id = $row["village_id"];
        $village_name = $row["village_name"];
        $place_id = $row["place_id"];
        $place_name = $row["place_name"];
        $postcode = $row["postcode"];
        $phone_number = $row["phone_number"];
        $household_id = $row["household_id"];
        $child_order = $row["child_order"];
        $living_with = $row["living_with"];

        $family_status = $row["family_status"];
        $distance_km_m = $row["distance_km_m"];
        $distance_m = $row["distance_m"];
        $distance_hours = $row["distance_hours"];
        $distance_minutes = $row["distance_minutes"];
        $fare_per_month = $row["fare_per_month"];
        $main_transportation_id = $row["main_transportation_id"];
        $main_transportation = $row["main_transportation"];
        $child_detail = $row["child_detail"];
        $display_form = $row["display_form"];
    }
}

// Query to fetch titname options for dropdown
$titnameQuery = "SELECT * FROM titname";
$titnameResult = mysqli_query($conn, $titnameQuery);



// Query to fetch gender options for dropdown
$genderQuery = "SELECT * FROM gender";
$genderResult = mysqli_query($conn, $genderQuery);

// Query to fetch relig options for dropdown
$religQuery = "SELECT * FROM relig";
$religResult = mysqli_query($conn, $religQuery);

// Query to fetch vll options for dropdown
$vllQuery = "SELECT * FROM vll";
$vllResult = mysqli_query($conn, $vllQuery);
// Query to fetch family status options for dropdown
$familyStatusQuery = "SELECT * FROM famstt";
$familyStatusResult = mysqli_query($conn, $familyStatusQuery);

// Query to fetch vulnerability codes for dropdown
$dispformQuery = "SELECT * FROM dispform";
$dispformCodeResult = mysqli_query($conn, $dispformQuery);

$schmethodQuery = "SELECT * FROM schmethod";
$schmethodResult = mysqli_query($conn, $schmethodQuery);


$livewQuery = "SELECT * FROM livew";
$livewResult = mysqli_query($conn, $livewQuery);


?>

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">จัดการข้อมูลประวัติการประกอบอาชีพ</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <h5 class="app-page-title mb-0 text-info text-center mt-3 pt-4 mt-md-0 pt-md-0 mb-3">
                    <b>จัดการข้อมูลประวัติการประกอบอาชีพ</b>
                </h5>

                <!-- รหัสบุคคล
• เลขบัตรประชาชน
• รหัสค าน าหน้าชื่อ
• ชื่อ
• สกุล
• รหัสเพศ
• รหัสศาสนา
• กรณีศาสนาอื่น ๆ
• ปีเดือนวันเกิด
• อายุ
• ที่อยู่ปัจจุบัน บ้านเลขที่
• ถนน ซอย
• หมู่ที่
• จังหวัดอ าเภอต าบล
• รหัสไปรษณีย์
• เบอร์โทรศัพท์
• รหัสครัวเรือน (กรณี กรอกข้อมูลครัวเรือนให้กลับมาอัปเดตที่นี่ด้วย)
ป็นบุตรคนที่เท่าไหร่
• นักเรียนอาศัยอยู่กับใคร
• รหัสสถานภาพครอบครัว
• การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร
• การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร
• การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที
• การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที
• ค่าใช้จ่ายในการเดินทางไป-กลับกี่บาท/เดือน
• รหัสวิธีเดินทางหลัก
• รายละเอียดเชิงคุณภาพ
รหัสลักษณะความเหลื่อมล ้า

this is detail  table
person	ตารางบุคคล				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
perid	bigint		รหัสบุคคล	PK	ลองดูว่าจะรันตัวเลขอย่างไร เช่น ปีเดือนวันเวลาวินาที หรือรันตัวเลขไปเรื่อยๆ
pid	varchar	13	เลขบัตรประชาชน		
titid	int	2	รหัสคำนำหน้าชื่อ	FK	มีตารางย่อย
name	varchar	50	ชื่อ		
sname	varchar	50	สกุล		
genid	int	1	รหัสเพศ	FK	มีตารางย่อย
religid	int	2	รหัสศาสนา	FK	มีตารางย่อย
religoth	varchar	30	กรณีศาสนาอื่น ๆ		
brtdte	varchar	8	ปีเดือนวันเกิด		เก็บ 8 หลัก เช่น 25660426
age	int	1	อายุ		กรณีระบุแค่อายุ ไม่ได้ระบุวันเดือนปีเกิด
adr	varchar	20	ที่อยู่ปัจจุบัน บ้านเลขที่		
soi	varchar	30	ถนน ซอย		
vllid	varchar	2	หมู่ที่		มีตารางย่อย เก็บ 2 หลัก เช่น 01, 02, 03
plcid	varchar	6	จังหวัดอำเภอตำบล		มีตารางย่อย 940101 เก็บ 6 หลัก
postcode	int	5	รหัสไปรษณีย์		
pertel	varchar	30	เบอร์โทรศัพท์		
hholdid	bigint	2	รหัสครัวเรือน	FK	มีตารางย่อย

titname	คำนำหน้าชื่อ				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
titid	int	2	รหัสคำนำหน้าชื่อ	PK	
titnme	varchar	20	ชื่อคำนำหน้าชื่อ		
gender	เพศ				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
genid	int	1	รหัสเพศ	PK	
gennme	varchar	10	ชื่อเพศ		
					
relig	ศาสนา				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
religid	int	2	รหัสศาสนา	PK	
relignme	varchar	50	ชื่อศาสนา		
vll	หมู่บ้าน				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
vllid	varchar	2	หมู่ที่	PK	
vllnme					
plcid	varchar	6	รหัสพื้นที่	PK FK	
plc	พื้นที่ จังหวัดอำเภอตำบล				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
plcid	varchar	6	รหัสพื้นที่	PK	
plcnme	varchar	100	ชื่อจังหวัดอำเภอตำบล		
hhold	ข้อมูลครัวเรือน/ครอบครัว				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม

child	ตารางข้อมูลเฉพาะเด็ก				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
perid	bigint		รหัสเด็ก	PK FK	
chiphoto	image		รูปถ่ายเด็ก		เก็บ 1 รูป
chiord	int	2	เป็นบุตรคนที่เท่าไหร่		
livewid	int	2	นักเรียนอาศัยอยู่กับใคร	FK	มีตารางย่อย
famsttid	int	2	รหัสสถานภาพครอบครัว	FK	มีตารางย่อย
distschkm	int	3	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร		หน่วย:: กิโลเมตร
distschm	int	3	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร		หน่วย:: เมตร
distschhrs	int	2	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที		หน่วย:: ชั่วโมง
distschmin	int	2	การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที		หน่วย:: นาที
farepay	int	4	ค่าใช้จ่ายในการเดินทางไป-กลับกี่บาท/เดือน		หน่วย:: บาท/เดือน
schmethid	int	2	รหัสวิธีเดินทางหลัก	FK	มีตารางย่อย
chidetail	varchar	1000	รายละเอียดเชิงคุณภาพ		
					disptyp	ประเภทความเหลื่อมล้ำ				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
disptypid	bigint		รหัสความเหลื่อมล้ำ	PK	
perid	bigint		รหัสบุคคล  รหัสเด็ก	FK	
dispfrmid	int	2	รหัสลักษณะความเหลื่อมล้ำ	FK	มีตารางย่อย

livew	นักเรียนอาศัยอยู่กับ				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
livewid	int	2	PK	
livewnme	varchar	30	ชื่อนักเรียนอาศัยอยู่กับ		

famstt	สถานภาพครอบครัว				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
famsttid	int	2	รหัสสถานภาพครอบครัว	PK	
famsttnme	varchar	30	ชื่อสถานภาพครอบครัว		

schmethod	วิธีเดินทางหลักไปโรงเรียน				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
schmethid	int	2	รหัสวิธีเดินทางหลัก	PK	
schmethnme	varchar	30	ชื่อวิธีเดินทางหลัก -->

                <form name="frmScreening" id="frmScreening" method="post" enctype="" onSubmit="" target="">

                    <!-- ... (previous HTML code) ... -->

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="title_id">รหัสคำนำหน้าชื่อ</label>
                        <select class="form-select" name="title_id" id="title_id" required>
                            <?php
                            while ($titnameRow = mysqli_fetch_assoc($titnameResult)) {
                                $selected = ($titnameRow['titid'] == $title_id) ? "selected" : "";
                                echo "<option value='{$titnameRow['titid']}' {$selected}>{$titnameRow['titnme']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- ชื่อ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="name">ชื่อ</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?= $name; ?>" required>
                    </div>
                    <!-- นามสกุล -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="surname">นามสกุล</label>
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="" value="<?= $surname; ?>" required>
                    </div>
                    <!-- เลขบัตรประชาชน -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="national_id">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" name="national_id" id="national_id" placeholder="" value="<?= $national_id; ?>" required>
                    </div>
                    <!-- รหัสเพศ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="gender">รหัสเพศ</label>
                        <select class="form-control" name="gender" id="gender" required>
                            <!-- Populate options from $genderResult -->
                            <?php while ($row = mysqli_fetch_assoc($genderResult)) { ?>
                                <option value="<?= $row['genid']; ?>"><?= $row['gennme']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- รหัสศาสนา -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="religion_id">ศาสนา</label>
                        <select class="form-control" name="religion_id" id="religion_id" required>
                            <!-- Populate options from $religResult -->
                            <?php while ($row = mysqli_fetch_assoc($religResult)) { ?>
                                <option value="<?= $row['religid']; ?>"><?= $row['relignme']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- กรณีศาสนาอื่น ๆ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="other_religion">กรณีศาสนาอื่น ๆ</label>
                        <input type="text" class="form-control" name="other_religion" id="other_religion" placeholder="" value="<?= $other_religion; ?>">
                    </div>

                    <!-- ปีเดือนวันเกิด -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="birth_date">ปีเดือนวันเกิด</label>
                        <input type="text" class="form-control datepicker" name="birth_date" id="birth_date" placeholder="" value="<?= $birth_date; ?>" required>

                    </div>

                    <!-- อายุ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="age">อายุ</label>
                        <input type="text" class="form-control" name="age" id="age" placeholder="" value="<?= $age; ?>" required>
                    </div>

                    <!-- ที่อยู่ปัจจุบัน บ้านเลขที่ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="address">ที่อยู่ปัจจุบัน บ้านเลขที่</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="" value="<?= $address; ?>">
                    </div>
                    <!-- เบอร์โทรศัพท์ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="phone_number">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" value="<?= $phone_number; ?>" required>
                    </div>


                    <!-- เป็นบุตรคนที่เท่าไหร่ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="child_order">เป็นบุตรคนที่เท่าไหร่</label>
                        <input type="text" class="form-control" name="child_order" id="child_order" placeholder="" value="<?= $child_order; ?>" required>
                    </div>

                    <!-- นักเรียนอาศัยอยู่กับใคร -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="livew_id">นักเรียนอาศัยอยู่กับใคร</label>
                        <select class="form-control" name="livew_id" id="livew_id" required>
                            <option value="">เลือกนักเรียนอาศัยอยู่กับใคร</option>
                            <?php
                            while ($livewRow = mysqli_fetch_assoc($livewResult)) {
                                $selected = ($livew_id == $livewRow['livewid']) ? 'selected' : '';
                                echo '<option value="' . $livewRow['livewid'] . '" ' . $selected . '>' . $livewRow['livewnme'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- รหัสสถานภาพครอบครัว -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="family_status">รหัสสถานภาพครอบครัว</label>
                        <select class="form-control" name="family_status" id="family_status" required>
                            <option value="">-- เลือกสถานภาพครอบครัว --</option>
                            <?php while ($row = mysqli_fetch_assoc($familyStatusResult)) { ?>
                                <option value="<?= $row['famsttid']; ?>" <?= ($family_status === $row['famsttid']) ? 'selected' : ''; ?>>
                                    <?= $row['famsttnme']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>


                    <!-- การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="distance_to_school_km">การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร</label>
                        <input type="text" class="form-control" name="distance_to_school_km" id="distance_to_school_km" placeholder="" value="<?= $distance_to_school_km; ?>" required>
                    </div>

                    <!-- การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="travel_time_to_school">การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมงกี่นาที</label>
                        <input type="text" class="form-control" name="travel_time_to_school" id="travel_time_to_school" placeholder="" value="<?= $travel_time_to_school; ?>" required>
                    </div>

                    <!-- ค่าใช้จ่ายในการเดินทางไป-กลับกี่บาท/เดือน -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="fare_per_month">ค่าใช้จ่ายในการเดินทางไป-กลับกี่บาท/เดือน</label>
                        <input type="text" class="form-control" name="fare_per_month" id="fare_per_month" placeholder="" value="<?= $fare_per_month; ?>" required>
                    </div>

                    <!-- รหัสวิธีเดินทางหลัก -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="main_transportation_id">รหัสวิธีเดินทางหลัก</label>
                        <select class="form-control" name="main_transportation_id" id="main_transportation_id" required>
                            <option value="">เลือกรหัสวิธีเดินทางหลัก</option>
                            <?php
                            while ($schmethodRow = mysqli_fetch_assoc($schmethodResult)) {
                                $selected = ($main_transportation_id == $schmethodRow['schmethid']) ? 'selected' : '';
                                echo '<option value="' . $schmethodRow['schmethid'] . '" ' . $selected . '>' . $schmethodRow['schmethnme'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- รายละเอียดเชิงคุณภาพ -->
                    <div class="col-12 mb-3">
                        <label for="quality_detail">รายละเอียดเชิงคุณภาพ</label>
                        <textarea class="form-control" name="quality_detail" id="quality_detail" rows="4" required><?= $quality_detail; ?></textarea>
                    </div>

                    <!-- รหัสลักษณะความเหลื่อมล้ำ (Dropdown) -->
                    <div class="col-12 mb-3">
                        <label for="dispform">รหัสลักษณะความเหลื่อมล้ำ</label>
                        <select class="form-control" name="dispform" id="dispform" required>
                            <option value="">เลือกรหัสลักษณะความเหลื่อมล้ำ</option>
                            <?php while ($row = mysqli_fetch_assoc($dispformCodeResult)) : ?>
                                <option value="<?= $row['dispfrmid']; ?>" <?= ($dispform === $row['dispfrmid']) ? 'selected' : ''; ?>>
                                    <?= $row['dispfrmnme']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>




                    <!-- รหัสครัวเรือน (กรณี กรอกข้อมูลครัวเรือนให้กลับมาอัปเดตที่นี่ด้วย) -->
                    <!-- <div class="col-12 col-sm-4 mb-3">
                        <label for="household_id">รหัสครัวเรือน</label>
                        <select class="form-select" name="household_id" id="household_id" >
                            <?php
                            // while ($hholdRow = mysqli_fetch_assoc($hholdResult)) {
                            //     $selected = ($hholdRow['hholdid'] == $household_id) ? "selected" : "";
                            //     echo "<option value='{$hholdRow['hholdid']}' {$selected}>{$hholdRow['hholdnme']}</option>";
                            // }
                            ?>
                        </select>
                    </div>
-->

                    <!--  
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="village_id">หมู่บ้าน</label>
                        <select class="form-select" name="village_id" id="village_id" >
                            <?php
                            // while ($vllRow = mysqli_fetch_assoc($vllResult)) {
                            //     $selected = ($vllRow['vllid'] == $village_id) ? "selected" : "";
                            //     echo "<option value='{$vllRow['vllid']}' {$selected}>{$vllRow['vllnme']}</option>";
                            // }
                            ?>
                        </select>
                    </div> -->

                    <!-- ... (continue with the rest of your HTML code) ... -->



            </div>
            <!--//app-card-body-->

            <hr>
            <!--<button class="mt-3/// btn app-btn-primary" type="button" onClick="">บันทึก</button>-->
            <input type="submit" class="mt-3 btn app-btn-primary" name="submit" value="บันทึก" />
            <button class="mt-3 btn btn-danger text-white" type="reset" onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>

            <hr class="mb-4">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="savofc">ผู้บันทึก</label>
                    <input type="text" class="form-control" name="savofc" id="savofc" placeholder="" value="<?= $rows["savofc"]; ?>" readonly="true" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="savdte">วันที่บันทึก</label>
                    <input type="text" class="form-control" name="savdte" id="savdte" placeholder="" value="<?php echo $savdte; ?>" readonly="true" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                    <input type="text" class="form-control" name="updofc" id="updofc" placeholder="" value="<?= $rows["updofc"]; ?>" readonly="true" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                    <input type="text" class="form-control" name="upddte" id="upddte" placeholder="" value="<?php echo $upddte; ?>" readonly="true" required>
                </div>
            </div>
            </form>

        </div>
        <!--//app-card-body-->
    </div>
    <!--//app-card-->
</div>
</div>
<!--//row-->

<script>
    $(document).ready(function() {
        var form = $('#frmScreening'); // Replace 'yourFormId' with the actual ID of your form

                // Attach a submit event handler to the form
                // Prevent the form from submitting

                // Loop through each input element within the form
                // Loop through each input and select element within the form
                form.submit(function(event) {
                    event.preventDefault(); // Prevent the form from submitting

                    // Loop through each input element within the form
                    form.find('input, select').each(function() {
                        var element = $(this);
                        var elementType = element.prop('tagName').toLowerCase(); // Get the tag name of the element
                        var name = element.attr('name');
                        var value = element.val();

                        console.log('Type:', elementType, 'Name:', name, 'Value:', value);
                    });
                });
           

        $("#frmScreening").validate({
            rules: {
                person_id: {
                    required: true,
                    digits: true
                },
                national_id: {
                    required: true,
                    maxlength: 13
                },
                title_id: "required",
                name: "required",
                surname: "required",
                gender_id: "required",
                religion_id: "required",
                birth_date: {
                    required: true,
                    date: true
                },
                age: {
                    required: true,
                    digits: true
                },
                address: "required",
                street: "required",
                village_id: {
                    required: true,
                    maxlength: 2
                },
                place_id: {
                    required: true,
                    maxlength: 6
                },
                postcode: {
                    required: true,
                    digits: true,
                    maxlength: 5
                },
                phone_number: "required",
                household_id: {
                    required: true,
                    digits: true
                },
                child_order: {
                    required: true,
                    digits: true
                },
                living_with: "required",
                family_status: "required",
                distance_km_m: {
                    required: true,
                    digits: true
                },
                distance_m: {
                    required: true,
                    digits: true
                },
                distance_hours: {
                    required: true,
                    digits: true
                },
                distance_minutes: {
                    required: true,
                    digits: true
                },
                fare_per_month: {
                    required: true,
                    digits: true
                },
                main_transportation_id: "required",
                child_detail: {
                    required: true,
                    maxlength: 1000
                },
                display_form: "required"
            },
            messages: {
                // Add custom error messages here
            },
            submitHandler: function(form) {
                // Serialize form data into JSON format
                var formData = $(form).serializeArray();
                var jsonData = {};
                $.each(formData, function(index, field) {
                    jsonData[field.name] = field.value;
                });

                // Add the action parameter to indicate the action to be performed
                jsonData['action'] = 'insert';

                // Send data to the server for insertion
                $.ajax({
                    type: "POST",
                    url: "person/insert_person.php",
                    data: jsonData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            // Show success message or perform any other actions
                            console.log(response.message);
                        } else {
                            // Show error message or perform error handling
                            console.log("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle Ajax error
                        console.error(error);
                        console.log("An error occurred while submitting the form.");
                    }
                });
            }

        });
    });
  
                // Select the form element by its ID or class
                

                function sum_score() {
                    var sum =
                        Number(window.document.frmScreening.qtnvs1.value) +
                        Number(window.document.frmScreening.qtnvs2.value) +
                        Number(window.document.frmScreening.qtnvs3.value) +
                        Number(window.document.frmScreening.qtnvs4.value) +
                        Number(window.document.frmScreening.qtnvs5.value) +
                        Number(window.document.frmScreening.qtnvs6.value) +
                        Number(window.document.frmScreening.qtnvs7.value) +
                        Number(window.document.frmScreening.qtnvs8.value);

                    var result = "";
                    if (sum >= 3) {
                        result = "มีภาวะเปราะบาง";
                    } else if (sum >= 1) {
                        result = "เริ่มเปราะบาง";
                    } else {
                        result = "ไม่มีความเปราะบาง";
                    }
                    window.document.frmScreening.qtnvs_sum.value = sum + " : " + result;
                };
</script>

<script language=Javascript>
    const currentYear = new Date().getFullYear();
    const buddhistYearOptions = [];
    for (let i = currentYear - 543; i >= currentYear - 2500; i--) {
        buddhistYearOptions.push({
            value: i.toString(),
            label: `${i + 543} (พ.ศ. ${i})`
        });
    }
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d", // Change the date format as needed
        "locale": "th",
        onReady: function(selectedDates, dateStr, instance) {
            const yearDropdown = instance.yearElements[0]; // Updated selector
            yearDropdown.value = parseInt(yearDropdown.value) + 543;
        },
        onOpen: function(selectedDates, dateStr, instance) {
            // const selectedDate = instance.latestSelectedDateObj; // Get the selected date object
            // if (selectedDate) {
            //     const buddhistYear = selectedDate.getFullYear() + 543;
            //     const formattedDate = `${buddhistYear}-${selectedDate.getDate()}-${selectedDate.getMonth() + 1}`;
            //     instance.input.value = formattedDate; // Set the input value to the formatted date
            // }
        },
        onValueUpdate: function(selectedDates, dateStr, instance) {
            // debugger;
            // const selectedDate = selectedDates[0];
            // const buddhistYear = selectedDate.getFullYear() + 543;
            // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
            // instance.input.value = formattedDate;
        },
        onYearChange: function(selectedDates, dateStr, instance) {

            // if(instance.yearElements[0].value>2400){
            //     instance.yearElements[0].value=instance.yearElements[0].value-543;
            //     const yearDropdown = instance.yearElements[0]; // Updated selector
            // yearDropdown.value = parseInt(yearDropdown.value)+543;
            // }else{
            //     const yearDropdown = instance.yearElements[0]; // Updated selector
            // yearDropdown.value = parseInt(yearDropdown.value) + 543;

            // }

        },
        onMonthChange: function(selectedDates, dateStr, instance) {


            //     if(instance.yearElements[0].value>2400){

            //         instance.yearElements[0].value=instance.yearElements[0].value-543;
            //         const yearDropdown = instance.yearElements[0]; // Updated selector
            //     yearDropdown.value = parseInt(yearDropdown.value)+543;
            //     }else{
            //                     const yearDropdown = instance.yearElements[0]; // Updated selector
            //     yearDropdown.value = parseInt(yearDropdown.value) + 543;

            //         }
            //
        },
        onDayCreate: function(selectedDates, dateStr, instance) {

            if (instance.yearElements[0].value > 2400) {
                instance.currentYear = instance.yearElements[0].value - 543;
                instance.yearElements[0].value = instance.yearElements[0].value - 543;
                const yearDropdown = instance.yearElements[0]; // Updated selector
                yearDropdown.value = parseInt(yearDropdown.value) + 543;
            } else {
                const yearDropdown = instance.yearElements[0]; // Updated selector
                yearDropdown.value = parseInt(yearDropdown.value) + 543;

            }
            console.log(instance.currentYear);

        },

        // Convert the selected Gregorian year to Buddhist year




        onChange: function(selectedDates, dateStr, instance) {
            // Convert the selected Gregorian year to Buddhist year
            const selectedDate = selectedDates[0];
            const buddhistYear = selectedDate.getFullYear() + 543; // Add 543 to convert to Buddhist year

            // Update the input value with the converted year
            const inputElement = instance.input;
            const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
            inputElement.value = formattedDate;
        }
    });

    function saveGuestionnaire() {
        var xmlhttp = Inint_AJAX();
        var Url = "./visit/qtn_visit_crud.php";
        alert("xxxxxxxxxxx");
        var POSTBody = "";
        POSTBody += "qtn_visid=" + document.frmScreening.qtn_visid.value;
        POSTBody += "&perid=" + document.frmScreening.perid.value;
        POSTBody += "&qtn_assessor=" + document.frmScreening.qtn_assessor.value;
        POSTBody += "&pos_ofcid=" + document.frmScreening.pos_ofcid.value;
        POSTBody += "&qtn_round=" + document.frmScreening.qtn_round.value;
        POSTBody += "&qtn_date=" + document.frmScreening.qtn_date.value;

        POSTBody += "&weight=" + document.frmScreening.weight.value;
        POSTBody += "&height=" + document.frmScreening.height.value;
        POSTBody += "&waistline=" + document.frmScreening.waistline.value;
        POSTBody += "&blood_pressure=" + document.frmScreening.blood_pressure.value;

        if (document.frmScreening.help1.checked) {
            var i1 = 1;
        } else var i1 = 0;
        POSTBody += "&help1=" + i1;

        if (document.frmScreening.help2.checked) {
            var i1 = 2;
        } else var i1 = 0;
        POSTBody += "&help2=" + i1;

        if (document.frmScreening.help3.checked) {
            var i1 = 3;
        } else var i1 = 0;
        POSTBody += "&help3=" + i1;

        if (document.frmScreening.help4.checked) {
            var i1 = 4;
        } else var i1 = 0;
        POSTBody += "&help4=" + i1;

        if (document.frmScreening.help5.checked) {
            var i1 = 5;
        } else var i1 = 0;
        POSTBody += "&help5=" + i1;

        if (document.frmScreening.help6.checked) {
            var i1 = 6;
        } else var i1 = 0;
        POSTBody += "&help6=" + i1;

        if (document.frmScreening.help7.checked) {
            var i1 = 7;
        } else var i1 = 0;
        POSTBody += "&help7=" + i1;

        POSTBody += "&helpoth=" + document.frmScreening.helpoth.value;

        // // ################ page2 #############
        POSTBody += "&qtnvs1=" + document.frmScreening.qtnvs1.value;
        POSTBody += "&qtnvs2=" + document.frmScreening.qtnvs2.value;
        POSTBody += "&qtnvs3=" + document.frmScreening.qtnvs3.value;
        POSTBody += "&qtnvs4=" + document.frmScreening.qtnvs4.value;
        POSTBody += "&qtnvs5=" + document.frmScreening.qtnvs5.value;
        POSTBody += "&qtnvs6=" + document.frmScreening.qtnvs6.value;
        POSTBody += "&qtnvs7=" + document.frmScreening.qtnvs7.value;
        POSTBody += "&qtnvs8=" + document.frmScreening.qtnvs8.value;
        POSTBody += "&qtnvs_sum=" + document.frmScreening.qtnvs_sum.value;
        POSTBody += "&qtnvsoth=" + document.frmScreening.qtnvsoth.value;
        POSTBody += "&act=save";
        alert(POSTBody);
        xmlhttp.open('POST', Url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(POSTBody);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
                eval("var decoded_data = " + xmlhttp.responseText);
                if (decoded_data['checkSave'] == "yes") {
                    window.document.frmScreening.qtn_visid.value = decoded_data['qtn_visid0'];
                    window.document.frmScreening.savofc.value = decoded_data['savofc0'];
                    window.document.frmScreening.savdte.value = decoded_data['savdte0'];
                    window.document.frmScreening.updofc.value = decoded_data['updofc0'];
                    window.document.frmScreening.upddte.value = decoded_data['upddte0'];
                    window.location.href = '?page=visit&function=update&id=' + decoded_data['qtn_visid0'];
                    alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                    // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
                } else alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
            } //else alert(
            // 'ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ'
            //);
        }
    };

    function clearForm() {
        //window.document.frmScreening.reset();
        form.reset();
        location.reload();

    };


    function checkPerid(e1) {
        if (document.frmScreening.perid.value.length == 0 || document.frmScreening.perid.value.length == " ") {
            alert(e1);
            return false;
        }
        return true;
    };

    function clearForm() {
        document.frmScreening.perid.value = "";
        document.frmScreening.nme.value = "";
        document.frmScreening.age_now.value = "";
        document.frmScreening.pertypnme.value = "";
        document.frmScreening.optnme.value = "";
        document.frmScreening.qtn_assessor.value = "";
        document.frmScreening.pos_ofcid.value = "0";
        document.frmScreening.qtn_round.value = "";
        document.frmScreening.qtn_date.value = "";

        document.frmScreening.weight.value = "";
        document.frmScreening.height.value = "";
        document.frmScreening.waistline.value = "";
        document.frmScreening.blood_pressure.value = "";
        document.frmScreening.help1.checked = false;
        document.frmScreening.help2.checked = false;
        document.frmScreening.help3.checked = false;
        document.frmScreening.help4.checked = false;
        document.frmScreening.help5.checked = false;
        document.frmScreening.help6.checked = false;
        document.frmScreening.help7.checked = false;
        document.frmScreening.helpoth.value = "";

        document.frmScreening.qtnvs1.value = "0";
        document.frmScreening.qtnvs2.value = "0";
        document.frmScreening.qtnvs3.value = "0";
        document.frmScreening.qtnvs4.value = "0";
        document.frmScreening.qtnvs5.value = "0";
        document.frmScreening.qtnvs6.value = "0";
        document.frmScreening.qtnvs7.value = "0";
        document.frmScreening.qtnvs8.value = "0";
        document.frmScreening.qtnvs_sum.value = "";
        document.frmScreening.qtnvsoth.value = "";


    }
</script>