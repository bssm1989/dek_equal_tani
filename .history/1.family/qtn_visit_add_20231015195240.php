<?php
$hholdid = $_GET["perid"];
//hello world
echo "<h1>perid = $hholdid</h1>";


// Get  from page showing the list of hwork
/*
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
recorded_by	int(5)			
recorded_date	datetime	
modified_by	int(5)			
modified_date	datetime	
status_row	int(2)			


vll	หมู่บ้าน				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
vllid	varchar	2	หมู่ที่	PK	
vllnme					
plcid	varchar	6	รหัสพื้นที่	PK FK	

plc	พื้นที่ จังหวัดอำเภอตำบล				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
plcid	varchar	6	รหัสพื้นที่	PK	
plcnme	varchar	100	ชื่อจังหวัดอำเภอตำบล		
					
prv	จังหวัด				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
prvid	varchar	2	รหัสจังหวัด	PK	
prvnme	varchar	50	ชือจังหวัด		

hhdepon	ครัวเรือนมีภาระพึ่งพิง				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhdeponid	int	2	รหัสครัวเรือนมีภาระพึ่งพิง	PK	
hhdeponnme	varchar	30	ชื่อครัวเรือนมีภาระพึ่งพิง		  

hhtyp	การอยู่อาศัย				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhtypid	int	2	รหัสการอยู่อาศัย	PK	
hhtypnme	varchar	30	ชื่อการอยู่อาศัย		

hhflr	วัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhflrid	int	2	รหัสวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)	PK	
hhflrnme	varchar	30	ชื่อวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)		

hhwall	วัสดุที่ใช้ทำฝาบ้าน				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhwallid	int	2	รหัสวัสดุที่ใช้ทำฝาบ้าน	PK	
hhwallnme	varchar	30	ชื่อวัสดุที่ใช้ทำฝาบ้าน		
					
hhrf	วัสดุที่ใช้ทำหลังคา				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhrfid	int	2	รหัสวัสดุที่ใช้ทำหลังคา	PK	
hhrfnme	varchar	30	ชื่อวัสดุที่ใช้ทำหลังคา		
					



agrland	ที่ดินสำหรับทำการเกษตร				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
agrlandid	int	2	รหัสขนาดของที่ดิน	PK	
agrlandnme	varchar	30	ชื่อขนาดของที่ดิน		


hhwater	แหล่งน้ำดื่ม				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhwaterid	int	2	รหัสแหล่งน้ำดื่ม	PK	
hhwaternme	varchar	30	ชื่อแหล่งน้ำดื่ม		




hhelect	แหล่งไฟฟ้า				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hhelectid	int	2	รหัสแหล่งไฟฟ้า	PK	
hhelectnme	varchar	30	ชื่อแหล่งไฟฟ้า		


*/

if ($hholdid) {
    // Construct your SQL query to fetch hwork details and related information
    $sql = "SELECT *
FROM hhold h
WHERE h.hholdid = $hholdid";
    // echo $sql;
    // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_array($result)) {

        $recorded_by = $row["recorded_by"];
        $recorded_date = $row["recorded_date"];
        $modified_by = $row["modified_by"];
        $modified_date = $row["modified_date"];
        $recorded_by = $row["recorded_by"];
        // Query record_by from staff table and get name and lastname
        $recorded_byQuery = "SELECT * FROM staff WHERE staffid = $recorded_by";

        $recorded_byResult = mysqli_query($conn, $recorded_byQuery);

        if ($staff = mysqli_fetch_array($recorded_byResult)) {
            $recorded_by = $staff["staffnme"] . " " . $staff["staffsnme"];
        }

        if ($modified_by) {

            $modified_byQuery = "SELECT * FROM staff WHERE staffid = $modified_by";
            $modified_byResult = mysqli_query($conn, $modified_byQuery);
            if ($staff = mysqli_fetch_array($modified_byResult)) {

                $modified_by = $staff["staffnme"] . " " . $staff["staffsnme"];
            }
        }

        // $hholdid = $row["hholdid"];

        $adr = $row["adr"];
        $soi = $row["soi"];
        $vllid = $row["vllid"];
        $plcid = $row["plcid"];
        $postcode = $row["postcode"];
        $memno = $row["memno"];
        $hhdeponid = $row["hhdeponid"];
        $hhtypid = $row["hhtypid"];
        $hhrent = $row["hhrent"];
        $hhflrid = $row["hhflrid"];
        $hhwallid = $row["hhwallid"];

        $hhrfid = $row["hhrfid"];
        $hhtoilet = $row["hhtoilet"];
        $havagrland = $row["havagrland"];
        $agrlandid = $row["agrlandid"];
        $hhwaterid = $row["hhwaterid"];
        $havelect = $row["havelect"];
        $hhelectid = $row["hhelectid"];
        $vhcar = $row["vhcar"];
        $vhcarage = $row["vhcarage"];
        $vhtruck = $row["vhtruck"];
        $vhtruckage = $row["vhtruckage"];
        $vhtractor = $row["vhtractor"];
        $vhtractorage = $row["vhtractorage"];
        $vhmbike = $row["vhmbike"];
        $vhno = $row["vhno"];
        $hitemcomputer = $row["hitemcomputer"];
        $hitemaircon = $row["hitemaircon"];
        $hitemtvflat = $row["hitemtvflat"];
        $hitemwashmachine = $row["hitemwashmachine"];
        $hitemrefrige = $row["hitemrefrige"];
        $hitemno = $row["hitemno"];
        $hhimg1 = $row["hhimg1"];
        $hhimg2 = $row["hhimg2"];
    }
    //value place_id
    // echo "<h1>place_id = $place_id</h1>";
}

// Query to fetch titname options for dropdown

$hhdeponidQuery = "SELECT * FROM hhdepon";
$hhdeponidResult = mysqli_query($conn, $hhdeponidQuery);
$hhtypidQuery = "SELECT * FROM hhtyp";
$hhtypidResult = mysqli_query($conn, $hhtypidQuery);
$hhflridQuery = "SELECT * FROM hhflr";
$hhflridResult = mysqli_query($conn, $hhflridQuery);
$hhwallidQuery = "SELECT * FROM hhwall";
$hhwallidResult = mysqli_query($conn, $hhwallidQuery);
$hhrfidQuery = "SELECT * FROM hhrf";
$hhrfidResult = mysqli_query($conn, $hhrfidQuery);
$agrlandidQuery = "SELECT * FROM agrland";
$agrlandidResult = mysqli_query($conn, $agrlandidQuery);
$hhwateridQuery = "SELECT * FROM hhwater";
$hhwateridResult = mysqli_query($conn, $hhwateridQuery);
$hhelectidQuery = "SELECT * FROM hhelect";
$hhelectidResult = mysqli_query($conn, $hhelectidQuery);



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
                    <b>จัดการข้อมูลประวัติการข้อมูลครัวเรือน</b>
                </h5>

                <!--                          
ตาราง hhold
• รหัสครัวเรือน
• ที่อยู่ปัจจุบัน บ้านเลขที่
• ถนน ซอย
• หมู่ที่
• จังหวัดอ าเภอต าบล
• จ านวนสมาชิกในครัวเรือน (รวมตัวนักเรียน)
• รหัสครัวเรือนมีภาระพึ่งพิง
• รหัสการอยู่อาศัย
• กรณีอยู่บ้านเช่า เช่าเดือนละกี่บาท
• รหัสวัสดุที่ใช้ท าพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)
• รหัสวัสดุที่ใช้ท าฝาบ้าน
• รหัสวัสดุที่ใช้ท าหลังคา
• มีห้องส้วมในที่อยู่อาศัย/บริเวณบ้าน
• มีดินท าการเกษตรได้(รวมเช่า)
• กรณีท าการเกษตร มีที่ดินจ านวนกี่ไร่
• รหัสแหล่งน ้าดื่ม
• มีไฟฟ้าใช้หรือไม่
• กรณีมีไฟฟ้าใช้ ให้ระบุแหล่งไฟฟ้า
• ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถยนต์นั่งส่วนบุคคล
• อายุ:: รถยนต์นั่งส่วนบุคคล
• ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้
• อายุ:: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้
• ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน
• อายุ:: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน
• ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถมอเตอร์ไซต์/เรือประมงพื้นบ้าน
(ขนาดเล็ก)
• ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: ไม่มียานพาหนะในครัวเรือน
• ของใช้ในครัวเรือน (ที่ใช้งานได้):: คอมพิวเตอร์
• ของใช้ในครัวเรือน (ที่ใช้งานได้):: แอร์
• ของใช้ในครัวเรือน (ที่ใช้งานได้):: ทีวีจอแบน
• ของใช้ในครัวเรือน (ที่ใช้งานได้):: เครื่องซักผ้า
• ของใช้ในครัวเรือน (ที่ใช้งานได้):: ตู้เย็น
• ของใช้ในครัวเรือน (ที่ใช้งานได้):: ไม่มีของใช้ดังกล่าว
-->

                <form name="frmScreening" id="frmScreening" method="post" enctype="" onSubmit="" target="">

                    <!-- ... (previous HTML code) ... -->
                    <!-- input perid hidden -->
                    <input type="hidden" id="hholdid" name="hholdid" value="<?= $hholdid; ?>">
                    <!-- ที่อยู่ปัจจุบัน บ้านเลขที่ -->
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่ </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="adr">ที่อยู่ปัจจุบัน บ้านเลขที่</label>
                            <input type="text" class="form-control" name="adr" id="adr" placeholder="" value="<?= $adr; ?>" required>
                        </div>
                        <!-- ถนน ซอย -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="soi">ถนน ซอย</label>
                            <input type="text" class="form-control" name="soi" id="soi" placeholder="" value="<?= $soi; ?>" required>
                        </div>
                        <!-- หมู่ที่ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vllid">หมู่ที่</label>
                            <input type="text" class="form-control" name="vllid" id="vllid" placeholder="" value="<?= $vllid; ?>" required>
                        </div>
                        <!-- จังหวัดอำเภอตำบล -->
                        <!-- จังหวัด -->
                    </div>

                    <div class="">

                        <div id="addr1" class="address">
                            <!-- get value from php place_id -->
                            <p><?= $plcid; ?></p>
                            <input type="hidden" id="addr1-addressCode" name="plcid" value="<?= $plcid; ?>" />

                            <div class="notification"></div>
                        </div>

                    </div>
                    <script src="testCrud/data/address-data.js"></script>
                    <script src="testCrud/manage-addr.js"></script>
                    <script>
                        $(document).ready(function() {
                            const addr1 = new AddressDropdowns('addr1', addressData);
                            addr1.init();


                            $.validator.addMethod('eightDigits', function(value, element) {
                                console.log('Custom validation method called:', value, element);

                                const isValid = /^[0-9]{8}$/.test(value) && value !== '00000000';
                                console.log('Validation result:', isValid);

                                return this.optional(element) || isValid;
                            }, 'Please enter an 8-digit code.');
                            $('#editForm').validate({
                                rules: {
                                    name: 'required',
                                    'addr1-addressCode': {
                                        required: true,
                                        eightDigits: true
                                    },

                                },
                                ignore: [],
                                messages: {
                                    name: 'Please enter your name',
                                    'addr1-addressCode': {
                                        required: 'Please enter an address code',
                                        eightDigits: 'Please enter an 8-digit code.'
                                    },
                                    'addr2-addressCode': {
                                        required: 'Please enter an address code',
                                        eightDigits: 'Please enter an 8-digit code.'
                                    }
                                },
                                errorPlacement: function(error, element) {
                                    // Show the error message inside the corresponding notification div
                                    element.closest('.notification').html(error);

                                    // Add red border to the address div
                                    element.closest('.address').css('border', '2px solid red');
                                },
                                success: function(label, element) {
                                    // Remove red border when validation succeeds
                                    $(element).closest('.address').css('border', 'none');
                                },
                                submitHandler: function(form) {
                                    if ($('#editForm').valid()) {
                                        console.log('Form submitted successfully.');
                                        console.log('Name:', $('#name').val());
                                        console.log('Address 1:', addr1.getConcatenatedAddressCode());
                                        console.log('Address 2:', addr2.getConcatenatedAddressCode());
                                        console.log('Address 3:', addr3.getConcatenatedAddressCode());

                                    }
                                }
                            });
                        });
                    </script>
                    <!-- จำนวนสมาชิกในครัวเรือน (รวมตัวนักเรียน) -->
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลครัวเรือน </p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="memno">จำนวนสมาชิกในครัวเรือน (รวมตัวนักเรียน)</label>
                            <input type="text" class="form-control" name="memno" id="memno" placeholder="" value="<?= $memno; ?>" required>
                        </div>
                        <!-- ครัวเรือนมีภาระพึ่งพิง -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhdeponid">ครัวเรือนมีภาระพึ่งพิง</label>
                            <select class="form-control" name="hhdeponid" id="hhdeponid" required>
                                <!-- Populate options from $hhdeponidResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhdeponidResult)) { ?>
                                    <option value="<?= $row['hhdeponid']; ?>"><?= $row['hhdeponnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- การอยู่อาศัย -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhtypid">การอยู่อาศัย</label>
                            <select class="form-control" name="hhtypid" id="hhtypid" required>
                                <!-- Populate options from $hhtypidResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhtypidResult)) { ?>
                                    <option value="<?= $row['hhtypid']; ?>"><?= $row['hhtypnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- กรณีอยู่บ้านเช่า เช่าเดือนละกี่บาท -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhrent">กรณีอยู่บ้านเช่า เช่าเดือนละกี่บาท</label>
                            <input type="text" class="form-control" name="hhrent" id="hhrent" placeholder="" value="<?= $hhrent; ?>" required>
                        </div>
                        <!-- วัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน) -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhflrid">วัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)</label>
                            <select class="form-control" name="hhflrid" id="hhflrid" required>
                                <!-- Populate options from $hhflridResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhflridResult)) { ?>
                                    <option value="<?= $row['hhflrid']; ?>"><?= $row['hhflrnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- วัสดุที่ใช้ทำฝาบ้าน -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhwallid">วัสดุที่ใช้ทำฝาบ้าน</label>
                            <select class="form-control" name="hhwallid" id="hhwallid" required>
                                <!-- Populate options from $hhwallidResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhwallidResult)) { ?>
                                    <option value="<?= $row['hhwallid']; ?>"><?= $row['hhwallnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- วัสดุที่ใช้ทำหลังคา -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhrfid">วัสดุที่ใช้ทำหลังคา</label>
                            <select class="form-control" name="hhrfid" id="hhrfid" required>
                                <!-- Populate options from $hhrfidResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhrfidResult)) { ?>
                                    <option value="<?= $row['hhrfid']; ?>"><?= $row['hhrfnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- มีห้องส้วมในที่อยู่อาศัย/บริเวณบ้าน -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhtoilet">มีห้องส้วมในที่อยู่อาศัย/บริเวณบ้าน</label>
                            <input type="text" class="form-control" name="hhtoilet" id="hhtoilet" placeholder="" value="<?= $hhtoilet; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่ </p>
                        </div>
                    </div>
                    <div class="row">
                        <!-- มีดินทำการเกษตรได้(รวมเช่า) -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="havagrland">มีดินทำการเกษตรได้(รวมเช่า)</label>
                            <input type="text" class="form-control" name="havagrland" id="havagrland" placeholder="" value="<?= $havagrland; ?>" required>
                        </div>
                        <!-- กรณีทำการเกษตร มีที่ดินจำนวนกี่ไร่ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="agrlandid">กรณีทำการเกษตร มีที่ดินจำนวนกี่ไร่</label>
                            <select class="form-control" name="agrlandid" id="agrlandid" required>
                                <!-- Populate options from $agrlandidResult -->
                                <?php while ($row = mysqli_fetch_assoc($agrlandidResult)) { ?>
                                    <option value="<?= $row['agrlandid']; ?>"><?= $row['agrlandnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- แหล่งน้ำดื่ม -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhwaterid">แหล่งน้ำดื่ม</label>
                            <select class="form-control" name="hhwaterid" id="hhwaterid" required>
                                <!-- Populate options from $hhwateridResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhwateridResult)) { ?>
                                    <option value="<?= $row['hhwaterid']; ?>"><?= $row['hhwaternme']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <!-- มีไฟฟ้าใช้หรือไม่ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="havelect">มีไฟฟ้าใช้หรือไม่</label>
                            <input type="text" class="form-control" name="havelect" id="havelect" placeholder="" value="<?= $havelect; ?>" required>
                        </div>
                        <!-- กรณีมีไฟฟ้าใช้ ให้ระบุแหล่งไฟฟ้า -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhelectid">กรณีมีไฟฟ้าใช้ ให้ระบุแหล่งไฟฟ้า</label>
                            <select class="form-control" name="hhelectid" id="hhelectid" required>
                                <!-- Populate options from $hhelectidResult -->
                                <?php while ($row = mysqli_fetch_assoc($hhelectidResult)) { ?>
                                    <option value="<?= $row['hhelectid']; ?>"><?= $row['hhelectnme']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ยานพาหนะ</p>
                        </div>
                    </div>
                    <div class="row">
                        <!-- ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถยนต์นั่งส่วนบุคคล -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhcar">ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถยนต์นั่งส่วนบุคคล</label>
                            <input type="text" class="form-control" name="vhcar" id="vhcar" placeholder="" value="<?= $vhcar; ?>" required>
                        </div>
                        <!-- อายุ:: รถยนต์นั่งส่วนบุคคล -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhcarage">อายุ:: รถยนต์นั่งส่วนบุคคล</label>
                            <input type="text" class="form-control" name="vhcarage" id="vhcarage" placeholder="" value="<?= $vhcarage; ?>" required>
                        </div>
                        <!-- ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhtruck">ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้</label>

                            <!-- make select this option รถปิกอัพ/รถบรรทุกเล็ก/รถตู้ and get value for query php to make selected -->

                            <select class="form-control" name="vhtruck" id="vhtruck" required>


                                <option value="">เลือกยานพาหนะ</option>
                                <option value="1" <?php if ($vhtruck == 1) echo 'selected'; ?>>มี</option>
                                <option value="0" <?php if ($vhtruck == 0) echo 'selected'; ?>>ไม่มี</option>
                            </select>


                        </div>
                        <!-- อายุ:: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhtruckage">อายุ:: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้</label>
                            <!-- make option 1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี -->
                            <select class="form-control" name="vhtruckage" id="vhtruckage" require>
                                <option value="">เลือกอายุ</option>
                                <option value="1" <?php if ($vhtruckage == 1) echo 'selected'; ?>>อายุเกิน 15 ปี</option>
                                <option value="2" <?php if ($vhtruckage == 2) echo 'selected'; ?>>ไม่เกิน 15 ปี</option>

                            </select>
                        </div>
                        <!-- ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhtractor">ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน</label>
                            <select class="form-control" name="vhtractor" id="vhtractor" require>
                                <option value="">เลือกยานพาหนะ</option>
                                <option value="1" <?php if ($vhtractor == 1) echo 'selected'; ?>>มี</option>
                                <option value="0" <?php if ($vhtractor == 0) echo 'selected'; ?>>ไม่มี</option>

                            </select>
                        </div>
                        <!-- อายุ:: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhtractorage">อายุ:: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน</label>
                            <select class="form-control" name=vhtractorage" id="vhtractorage" placeholder="" required>
                                <option value="">เลือกอายุ</option>
                                <option value="1" <?php if ($vhtractorage == 1) echo 'selected'; ?>>อายุเกิน 15 ปี</option>
                                <option value="2" <?php if ($vhtractorage == 2) echo 'selected'; ?>>ไม่เกิน 15 ปี</option>
                            </select>
                        </div>
                        <!-- ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถมอเตอร์ไซต์/เรือประมงพื้นบ้าน(ขนาดเล็ก) -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhmbike">ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถมอเตอร์ไซต์/เรือประมงพื้นบ้าน(ขนาดเล็ก)</label>
                            <select class="form-control" name="vhmbike" id="vhmbike">
                                <option value="">เลือกยานพาหนะ</option>
                                <option value="1" <?php if ($vhmbike == 1) echo 'selected'; ?>>มี</option>
                                <option value="0" <?php if ($vhmbike == 0) echo 'selected'; ?>>ไม่มี</option>

                            </select>
                        </div>
                        <!-- ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: ไม่มียานพาหนะในครัวเรือน -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="vhno">ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: ไม่มียานพาหนะในครัวเรือน</label>
                            <p><?php echo $vhno; ?></p>
                            <select class="form-control" name="vhno" id="vhno" placeholder="" required>
                                <option value="">เลือกยานพาหนะ</option>
                                <option value="1" <?php if ($vhno == 1) echo 'selected'; ?>>มี</option>
                                <option value="0" <?php if ($vhno == 0) echo 'selected'; ?>>ไม่มี</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ของใช้ในครัวเรือน</p>
                        </div>
                    </div>
                    <div class="row">
                        <!-- ของใช้ในครัวเรือน (ที่ใช้งานได้):: คอมพิวเตอร์ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hitemcomputer">ของใช้ในครัวเรือน (ที่ใช้งานได้):: คอมพิวเตอร์</label>
                            <select class="form-control" name="hitemcomputer" id="hitemcomputer">
                                <option value="">เลือกของใช้</option>
                                <option value="1" <?php if ($hitemcomputer == 1) echo 'selected'; ?>>มี</option>
                                <option value="2" <?php if ($hitemcomputer == 2) echo 'selected'; ?>>ไม่มี</option>
                            </select>

                        </div>
                        <!-- ของใช้ในครัวเรือน (ที่ใช้งานได้):: แอร์ -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hitemaircon">ของใช้ในครัวเรือน (ที่ใช้งานได้):: แอร์</label>

                            <select class="form-control" name="hitemaircon" id="hitemaircon">
                                <option value="">เลือกของใช้</option>
                                <option value="1" <?php if ($hitemaircon == 1) echo 'selected'; ?>>มี</option>
                                <option value="2" <?php if ($hitemaircon == 2) echo 'selected'; ?>>ไม่มี</option>
                            </select>
                        </div>
                        <!-- ของใช้ในครัวเรือน (ที่ใช้งานได้):: ทีวีจอแบน -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hitemtvflat">ของใช้ในครัวเรือน (ที่ใช้งานได้):: ทีวีจอแบน</label>

                            <select class="form-control" name="hitemtvflat" id="hitemtvflat">
                                <option value="">เลือกของใช้</option>
                                <option value="1" <?php if ($hitemtvflat == 1) echo 'selected'; ?>>มี</option>
                                <option value="2" <?php if ($hitemtvflat == 2) echo 'selected'; ?>>ไม่มี</option>
                            </select>
                        </div>



                        <!-- ของใช้ในครัวเรือน (ที่ใช้งานได้):: เครื่องซักผ้า -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hitemwash">ของใช้ในครัวเรือน (ที่ใช้งานได้):: เครื่องซักผ้า</label>

                            <select class="form-control" name="hitemwashmachine" id="hitemwashmachine">
                                <option value="">เลือกของใช้</option>
                                <option value="1" <?php if ($hitemwashmachine == 1) echo 'selected'; ?>>มี</option>
                                <option value="2" <?php if ($hitemwashmachine == 2) echo 'selected'; ?>>ไม่มี</option>
                            </select>
                        </div>
                        <!-- ของใช้ในครัวเรือน (ที่ใช้งานได้):: ตู้เย็น -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hitemrefrige">ของใช้ในครัวเรือน (ที่ใช้งานได้):: ตู้เย็น</label>

                            <select class="form-control" name="hitemrefrige" id="hitemrefrige">
                                <option value="">เลือกของใช้</option>
                                <option value="1" <?php if ($hitemrefrige == 1) echo 'selected'; ?>>มี</option>
                                <option value="2" <?php if ($hitemrefrige == 2) echo 'selected'; ?>>ไม่มี</option>
                            </select>
                        </div>
                        <!-- ของใช้ในครัวเรือน (ที่ใช้งานได้):: ไม่มีของใช้ดังกล่าว -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hitemno">ของใช้ในครัวเรือน (ที่ใช้งานได้):: ไม่มีของใช้ดังกล่าว</label>

                            <select class="form-control" name="hitemno" id="hitemno">
                                <option value="">เลือกของใช้</option>
                                <option value="1" <?php if ($hitemno == 1) echo 'selected'; ?>>มี</option>
                                <option value="2" <?php if ($hitemno == 2) echo 'selected'; ?>>ไม่มี</option>
                            </select>
                        </div>
                        <!-- กรุณาถ่ายให้เห็น หลังคาและฝาผนังของที่พักอาศัยทั้งหลัง -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhimg1">กรุณาถ่ายให้เห็น หลังคาและฝาผนังของที่พักอาศัยทั้งหลัง</label>
                            <input type="file" class="form-control" name="hhimg1" id="hhimg1" placeholder="" value="<?= $hitemno; ?>">

                        </div>
                        <!-- กรุณาถ่ายให้เห็น พื้นและบริเวณภายในของที่พักอาศัย -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hhimg2">กรุณาถ่ายให้เห็น พื้นและบริเวณภายในของที่พักอาศัย</label>
                            <input type="file" class="form-control" name="hhimg2" id="hhimg2" placeholder="" value="<?= $hitemno; ?>">
                        </div>
                    </div>


            </div>
            <!--//app-card-body-->

            <hr>
            <!--<button class="mt-3/// btn app-btn-primary" type="button" onClick="">บันทึก</button>-->
            <?php echo $hholdid; ?>
            <?php if (!$hholdid) { ?>
                <input type="submit" class="mt-3 btn btn-primary text-white" name="submit" value="บันทึก" />
            <?php } else { ?>
                <input type="submit" class="mt-3 btn btn-primary text-white" name="submit" value="แก้ไข" />
                <!-- button cancle -->
                <input type="button" class="mt-3 btn btn-warning  text-white" name="cancle" value="ยกเลิก" onClick="window.location.href='?page=person'" />
            <?php } ?>
            <button class="mt-3 btn btn-danger text-white" type="reset" onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>

            <hr class="mb-4">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="recorded_by">ผู้บันทึก</label>
                    <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $recorded_by; ?>" readonly="true" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="recorded_date">วันที่บันทึก</label>
                    <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder="" value="<?php echo $recorded_date; ?>" readonly="true" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="modified_by">ผู้ปรับปรุงแก้ไข</label>
                    <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="" value="<?= $modified_by; ?>" readonly="true" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="modified_date">วันที่ปรับปรุงแก้ไข</label>
                    <input type="text" class="form-control" name="modified_date" id="modified_date" placeholder="" value="<?php echo $modified_date; ?>" readonly="true" required>
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
                'addr1-addressCode': {
                    required: true,
                    eightDigits: true
                },
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
                    required: false,
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
                // place_id: {
                //     required: true,
                //     maxlength: 6
                // },
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
            ignore: [],
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

                // Determine the action based on whether perid is present or not
                if ($('#perid').val()) {
                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: 'คุณกำลังจะอัปเดตข้อมูล การดำเนินการนี้ไม่สามารถย้อนกลับได้',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'อัปเดต',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            performAjaxRequest(jsonData);
                        }
                    });
                } else {
                    performAjaxRequest(jsonData);
                }

                function performAjaxRequest(data) {
                    // Convert birth_date 2564-01-01 to 25640101
                    // data['birth_date'] = data['birth_date'].replace(/-/g, "");

                    // Add the action parameter to indicate the action to be performed
                    data['action'] = data['hholdid'] ? 'update' : 'insert';
                    //11020100 --split--> 110201
                    data['plcid'] = data['plcid'].substring(0, 6);
                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        // url: "2.person2/insert_person.php",
                        url: "1.family/insert_family.php",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                // Show success message
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'ตกลง'
                                }).then(() => {
                                    // Go to next page
                                    // window.location.href = "?page=person";
                                });
                            } else {
                                // Show error message
                                Swal.fire({
                                    title: 'ข้อผิดพลาด',
                                    text: "เกิดข้อผิดพลาด: " + response.message,
                                    icon: 'error',
                                    // confirmButtonText: 'ตกลง'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle Ajax error
                            console.error(error);
                            Swal.fire({
                                title: 'ข้อผิดพลาด',
                                text: 'เกิดข้อผิดพลาดขณะส่งแบบฟอร์ม',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    });
                }
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
        "yearinput": false,

        onReady: function(selectedDates, dateStr, instance) {
            // const yearDropdown = instance.yearElements[0]; // Updated selector
            //check if year >2400
            const yearDropdown = instance.yearElements[0]; // Updated selector
            // yearDropdown.value = parseInt(yearDropdown.value) + 543;
            const buddhistYear = parseInt(yearDropdown.value) + 543;
            month2digit = instance.selectedDates[0].getMonth() + 1;
            if (month2digit < 10) {
                month2digit = "0" + month2digit;
            }
            day2digit = instance.selectedDates[0].getDate();
            if (day2digit < 10) {
                day2digit = "0" + day2digit;
            }

            const formattedDate = `${buddhistYear}-${month2digit}-${day2digit}`;
            instance.input.value = formattedDate;

            // yearDropdown.value = parseInt(yearDropdown.value) + 543;
        },
        onselect: function(selectedDates, dateStr, instance) {
            const yearDropdown = instance.yearElements[0]; // Updated selector
            yearDropdown.value = parseInt(yearDropdown.value) + 543;
            console.log(yearDropdown.value);
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
            // if(selectedDate.getFullYear()>2400){
            //     instance.currentYear = selectedDate.getFullYear() - 543;
            //     instance.yearElements[0].value = selectedDate.getFullYear() - 543;
            //     const yearDropdown = instance.yearElements[0]; // Updated selector

            // const buddhistYear =instance.currentYear + 543;
            // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
            // // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
            // // instance.input.value = formattedDate;

            // instance.input.value = formattedDate; 

            // }// Set the input value to the formatted date
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
            if (dateStr.length < 10) {
                //dateStr 25640909 cut to year 2564 month 09 day 09
                dateStr = dateStr.substring(0, 4) + "-" + dateStr.substring(4, 6) + "-" + dateStr.substring(6, 8);
                //check if year >2400
                if (dateStr.substring(0, 4) > 2400) {
                    //year >2400
                    //change year to buddhist year
                    instance.currentYear = dateStr.substring(0, 4) - 543;
                    instance.yearElements[0].value = dateStr.substring(0, 4) - 543;
                    const yearDropdown = instance.yearElements[0]; // Updated selector
                    yearDropdown.value = parseInt(yearDropdown.value) + 543;
                    instance.selectedDates[0].setYear(dateStr.substring(0, 4) - 543);
                    instance.selectedDates[0].setMonth(dateStr.substring(5, 7) - 1);
                    instance.selectedDates[0].setDate(dateStr.substring(8, 10));
                    //change input value to buddhist year
                    instance.input.value = dateStr;
                } else {
                    //year <2400
                    //change input value to buddhist year
                    instance.input.value = dateStr;
                }

            } else {
                if (instance.yearElements[0].value > 2400) {
                    instance.currentYear = instance.yearElements[0].value - 543;
                    instance.yearElements[0].value = instance.yearElements[0].value - 543;
                    const yearDropdown = instance.yearElements[0]; // Updated selector
                    yearDropdown.value = parseInt(yearDropdown.value) + 543;
                } else {
                    //     const yearDropdown = instance.yearElements[0]; // Updated selector
                    //    // yearDropdown.value = parseInt(yearDropdown.value) + 543;
                    //     const buddhistYear = parseInt(yearDropdown.value) + 543;
                    //     month2digit = instance.selectedDates[0].getMonth() + 1;
                    //     if (month2digit < 10) {
                    //         month2digit = "0" + month2digit;
                    //     }   
                    //     day2digit = instance.selectedDates[0].getDate();
                    //     if (day2digit < 10) {
                    //         day2digit = "0" + day2digit;
                    //     }

                    //     const formattedDate = `${buddhistYear}-${month2digit}-${day2digit}`;
                    //     instance.input.value = formattedDate;

                }
            }

            console.log(instance.currentYear);

        },

        // Convert the selected Gregorian year to Buddhist year




        onChange: function(selectedDates, dateStr, instance) {
            // Convert the selected Gregorian year to Buddhist year
            const selectedDate = selectedDates[0];
            if (selectedDate.getFullYear() > 2400) {
                instance.currentYear = selectedDate.getFullYear() - 543;
                instance.yearElements[0].value = selectedDate.getFullYear() - 543;
                const yearDropdown = instance.yearElements[0]; // Updated selector

                const buddhistYear = instance.currentYear + 543; // Add 543 to convert to Buddhist year

                // Update the input value with the converted year
                const inputElement = instance.input;
                //d-m-Y
                month2digi = selectedDate.getMonth() + 1;
                if (month2digi < 10) {
                    month2digi = "0" + month2digi;
                }
                //yyyy-mm-dd
                const formattedDate = `${buddhistYear}-${month2digi}-${selectedDate.getDate()}`;
                // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
                inputElement.value = formattedDate;
            } else {
                const yearDropdown = instance.yearElements[0]; // Updated selector  
                const buddhistYear = instance.currentYear + 543; // Add 543 to convert to Buddhist year
                const inputElement = instance.input;
                //d-m-Y ex 9-09-2564 month 2 digit
                month2digi = selectedDate.getMonth() + 1;
                if (month2digi < 10) {
                    month2digi = "0" + month2digi;
                }


                const formattedDate = `${buddhistYear}-${month2digi}-${selectedDate.getDate()}`;
                // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
                inputElement.value = formattedDate;
                // Update the input value with the converted year
            }
        },

    });

    function saveGuestionnaire() {
        var xmlhttp = Inint_AJAX();
        var Url = "./visit/qtn_visit_crud.php";

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
                    window.document.frmScreening.recorded_by.value = decoded_data['recorded_by0'];
                    window.document.frmScreening.recorded_date.value = decoded_data['recorded_date0'];
                    window.document.frmScreening.modified_by.value = decoded_data['modified_by0'];
                    window.document.frmScreening.modified_date.value = decoded_data['modified_date	0'];
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