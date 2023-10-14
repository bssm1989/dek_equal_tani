<?php
@session_start();
$optid = $_SESSION['optid'];
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
// Make sure to update the database connection settings if needed

// Replace the empty SQL query with your modified query to fetch data from the person, hedu, disptyp, titname, and education tables, and join them accordingly.
// You will need to adjust the JOIN conditions based on your table structure.
// $sql = "SELECT
// p.perid AS person_id,
// p.pid AS national_id,
// p.titid AS title_id,
// t.titnme AS title_name,
// p.name,
// p.sname AS surname,
// p.genid AS gender_id,
// g.gennme AS gender_name,
// p.religid AS religion_id,
// r.relignme AS religion_name,
// p.brtdte AS birth_date,
// p.age,
// p.adr AS address,
// p.soi AS street,
// p.vllid AS village_id,
// v.vllnme AS village_name,
// p.plcid AS place_id,
// plc.plcnme AS place_name,
// p.postcode,
// p.pertel AS phone_number,
// p.hholdid AS household_id,
// c.chiord AS child_order,
// l.livewnme AS living_with,
// f.famsttnme AS family_status,



// c.distschkm AS distance_km_m,
// c.distschm AS distance_m,
// c.distschhrs AS distance_hours,
// c.distschmin AS distance_minutes,
// c.farepay AS fare_per_month,
// m.schmethid AS main_transportation_id,
// m.schmethnme AS main_transportation,
// c.chidetail AS child_detail,
// df.dispfrmnme AS display_form
// FROM
// person p
// LEFT JOIN
// titname t ON p.titid = t.titid
// LEFT JOIN
// gender g ON p.genid = g.genid
// LEFT JOIN
// relig r ON p.religid = r.religid
// LEFT JOIN
// vll v ON p.vllid = v.vllid
// LEFT JOIN
// plc ON p.plcid = plc.plcid
// LEFT JOIN
// child c ON p.perid = c.perid
// LEFT JOIN
// livew l ON c.livewid = l.livewid
// LEFT JOIN
// famstt f ON c.famsttid = f.famsttid
// LEFT JOIN
// schmethod m ON c.schmethid = m.schmethid
// LEFT JOIN
// disptyp dt ON p.perid = dt.perid
// LEFT JOIN
// dispform df ON df.dispfrmid = dt.dispfrmid;
// ";
$sql="select 
hhold.hholdid as hhold_id,
hhold.adr as address,
hhold.soi as street,
hhold.vllid as village_id,
vll.vllnme as village_name,
hhold.plcid as place_id,
plc.plcnme as place_name,
hhold.postcode,
hhold.memno as member_no,
hhold.hhdeponid as hhdepon_id,
hhdepon.hhdeponnme as hhdepon_name,
hhold.hhtypid as hhtyp_id,
hhtyp.hhtypnme as hhtyp_name,
hhold.hhrent as hh_rent,
hhold.hhflrid as hhflr_id,
hhflr.hhflrnme as hhflr_name,
hhold.hhwallid as hhwall_id,
hhwall.hhwallnme as hhwall_name,
hhold.hhrfid as hhrf_id,
hhrf.hhrfnme as hhrf_name,
hhold.hhtoilet as hh_toilet,
hhold.havagrland as have_agr_land,
hhold.agrlandid as agrland_id,
agrland.agrlandnme as agrland_name,
hhold.hhwaterid as hhwater_id,
hhwater.hhwaternme as hhwater_name,
hhold.havelect as have_elect,
hhold.hhelectid as hhelect_id,
hhelect.hhelectnme as hhelect_name,
hhold.vhcar as vh_car,
hhold.vhcarage as vh_car_age,
hhold.vhtruck as vh_truck,
hhold.vhtruckage as vh_truck_age,
hhold.vhtractor as vh_tractor,
hhold.vhtractorage as vh_tractor_age,
hhold.vhmbike as vh_mbike,
hhold.vhno as vh_no,
hhold.hitemcomputer as hitem_computer,
hhold.hitemaircon as hitem_aircon,
hhold.hitemtvflat as hitem_tvflat,
hhold.hitemwashmachine as hitem_washmachine,
hhold.hitemrefrige as hitem_refrige,
hhold.hitemno as hitem_no,
hhold.hhimg1 as hh_img1,
hhold.hhimg2 as hh_img2

from hhold 
left join vll on hhold.vllid=vll.vllid 
left join plc on hhold.plcid=plc.plcid 

left join hhtyp on hhold.hhtypid=hhtyp.hhtypid 
left join hhdepon on hhold.hhdeponid=hhdepon.hhdeponid 
left join hhflr on hhold.hhflrid=hhflr.hhflrid 
left join hhwall on hhold.hhwallid=hhwall.hhwallid 
left join hhrf on hhold.hhrfid=hhrf.hhrfid 
left join agrland on hhold.agrlandid=agrland.agrlandid 
left join hhwater on hhold.hhwaterid=hhwater.hhwaterid 
left join hhelect on hhold.hhelectid=hhelect.hhelectid;";

// Execute the SQL query and fetch the results into the $results array
// You will need to replace the $conn variable with your database connection variable
$results = mysqli_query($conn, $sql);

// Function to get the educational level (you can keep this function as it is)
function getEducationLevel($edulev)
{
    // Function logic to get the educational level based on the given edulev
    // ...
    // Return the educational level
    // return $education_level;
}
?>

<!-- Rest of your HTML code as before -->

<!-- Existing HTML code -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> ข้อมูลประวัติการศึกษา</h4>
    </div>

    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a>
    </div>
</div>
<hr class="mb-0">
<div class="row g-2 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
              
               -->
                <!-- Include the PHP code here -->
                <!-- ... PHP code from the previous response ... -->

                <!-- Start of the new search box and dropdown -->
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBoxPersonID" class="form-label">ค้นหารหัสบุคคล:</label>
                        <input type="text" class="form-control" id="searchBoxPersonID" placeholder="พิมพ์รหัสบุคคลที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxPID" class="form-label">ค้นหาเลขบัตรประชาชน:</label>
                        <input type="text" class="form-control" id="searchBoxPID" placeholder="พิมพ์เลขบัตรประชาชนที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxTitlename" class="form-label">ค้นหาคำนำหน้าชื่อ:</label>
                        <input type="text" class="form-control" id="searchBoxTitlename" placeholder="พิมพ์คำนำหน้าชื่อที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxName" class="form-label">ค้นหาชื่อ:</label>
                        <input type="text" class="form-control" id="searchBoxName" placeholder="พิมพ์ชื่อที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxSurname" class="form-label">ค้นหาสกุล:</label>
                        <input type="text" class="form-control" id="searchBoxSurname" placeholder="พิมพ์สกุลที่ต้องการค้นหา...">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBox" class="form-label">ค้นหาลักษณะความเหลื่อมล้ำ:</label>
                        <input type="text" class="form-control" id="searchBox" placeholder="พิมพ์คำที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="dispfrmnmeDropdown" class="form-label">ลักษณะความเหลื่อมล้ำ:</label>
                        <select class="form-select" id="dispfrmnmeDropdown">
                            <!-- Dropdown options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBoxEduLevel" class="form-label">ค้นหาระดับการศึกษา:</label>
                        <input type="text" class="form-control" id="searchBoxEduLevel" placeholder="พิมพ์ระดับการศึกษาที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="edulevDropdown" class="form-label">ระดับการศึกษา:</label>
                        <select class="form-select" id="edulevDropdown">
                            <!-- Dropdown options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxProvince" class="form-label">จังหวัด,อำเภอ,ตำบล:</label>
                        <input type="text" class="form-control" id="searchBoxProvince" placeholder="พิมพ์จังหวัด,อำเภอ,ตำบลที่ต้องการค้นหา...">
                    </div>
                </div>

                <!-- End of the new search box and dropdown -->

                <!-- End of PHP code -->

                <table id="myTableAll" class="display responsive nowrap" style="width:100%">
                    <!-- Table headings in Thai language -->
                    <thead class="table-light">
                        <tr>


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

                            <th>ลำดับ</th>                                                                                    
                            <th>รหัสครัวเรือน</th>
                            <th>ที่อยู่ปัจจุบัน บ้านเลขที่</th>
                            <th>รหัสไปรษณีย์</th>
                            <th>ถนน ซอย</th>
                            <th>หมู่ที่</th>
                            <th>จังหวัดอำเภอตำบล</th>
                            <th>จำนวนสมาชิกในครัวเรือน (รวมตัวนักเรียน)</th>
                            <th>รหัสครัวเรือนมีภาระพึ่งพิง</th>
                            <th>รหัสการอยู่อาศัย</th>
                            <th>กรณีอยู่บ้านเช่า เช่าเดือนละกี่บาท</th>
                            <th>รหัสวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)</th>
                            <th>รหัสวัสดุที่ใช้ทำฝาบ้าน</th>
                            <th>รหัสวัสดุที่ใช้ทำหลังคา</th>
                            <th>มีห้องส้วมในที่อยู่อาศัย/บริเวณบ้าน</th>
                            <th>มีดินทำการเกษตรได้(รวมเช่า)</th>
                            <th>กรณีทำการเกษตร มีที่ดินจำนวนกี่ไร่</th>
                            <th>รหัสแหล่งน้ำดื่ม</th>
                            <th>มีไฟฟ้าใช้หรือไม่</th>
                            <th>กรณีมีไฟฟ้าใช้ ให้ระบุแหล่งไฟฟ้า</th>
                            <th>ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถยนต์นั่งส่วนบุคคล</th>
                            <th>อายุ:: รถยนต์นั่งส่วนบุคคล</th>
                            <th>ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้</th>
                            <th>อายุ:: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้</th>
                            <th>ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน</th>
                            <th>อายุ:: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน</th>
                            <th>ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถมอเตอร์ไซต์/เรือประมงพื้นบ้าน(ขนาดเล็ก)</th>
                            <th>ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: ไม่มียานพาหนะในครัวเรือน</th>
                            <th>ของใช้ในครัวเรือน (ที่ใช้งานได้):: คอมพิวเตอร์</th>
                            <th>ของใช้ในครัวเรือน (ที่ใช้งานได้):: แอร์</th>
                            <th>ของใช้ในครัวเรือน (ที่ใช้งานได้):: ทีวีจอแบน</th>
                            <th>ของใช้ในครัวเรือน (ที่ใช้งานได้):: เครื่องซักผ้า</th>
                            <th>ของใช้ในครัวเรือน (ที่ใช้งานได้):: ตู้เย็น</th>
                            <th>ของใช้ในครัวเรือน (ที่ใช้งานได้):: ไม่มีของใช้ดังกล่าว</th> 
                            <th>แก้ไข</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($results)) {
                            // Extract the data from the current row
                           



                            $hholdid = $row['hhold_id'];
                            $adr = $row['address'];
                            $soi = $row['street'];
                            $vllid = $row['village_id'];
                            $vllnme = $row['village_name'];
                            $plcid = $row['place_id'];
                            $plcnme = $row['place_name'];
                            $postcode = $row['postcode'];
                            $memno = $row['member_no'];
                            $hhdeponid = $row['hhdepon_id'];
                            $hhdeponnme = $row['hhdepon_name'];
                            $hhtypid = $row['hhtyp_id'];
                            $hhtypnme = $row['hhtyp_name'];
                            $hhrent = $row['hh_rent'];
                            $hhflrid = $row['hhflr_id'];
                            $hhflrnme = $row['hhflr_name'];
                            $hhwallid = $row['hhwall_id'];
                            $hhwallnme = $row['hhwall_name'];
                            $hhrfid = $row['hhrf_id'];
                            $hhrfnme = $row['hhrf_name'];
                            $hh_toilet = $row['hh_toilet'];
                            $have_agr_land = $row['have_agr_land'];
                            $agrlandid = $row['agrland_id'];
                            $agrlandnme = $row['agrland_name'];
                            $hhwaterid = $row['hhwater_id'];
                            $hhwaternme = $row['hhwater_name'];
                            $have_elect = $row['have_elect'];
                            $hhelectid = $row['hhelect_id'];
                            $hhelectnme = $row['hhelect_name'];
                            $vh_car = $row['vh_car'];
                            $vh_car_age = $row['vh_car_age'];
                            $vh_truck = $row['vh_truck'];
                            $vh_truck_age = $row['vh_truck_age'];
                            $vh_tractor = $row['vh_tractor'];
                            $vh_tractor_age = $row['vh_tractor_age'];
                            $vh_mbike = $row['vh_mbike'];
                            $vh_no = $row['vh_no'];
                            $hitem_computer = $row['hitem_computer'];
                            $hitem_aircon = $row['hitem_aircon'];
                            $hitem_tvflat = $row['hitem_tvflat'];
                            $hitem_washmachine = $row['hitem_washmachine'];
                            $hitem_refrige = $row['hitem_refrige'];
                            $hitem_no = $row['hitem_no'];

                       



                        ?>
                            <tr id="row_<?= $hholdid  ?>">
                                <td><?= $counter ?></td>
                                <td><?= $hholdid ?></td>
                                <td><?= $adr ?></td>
                                <td><?= $postcode ?></td>
                                <td><?= $soi ?></td>
                                <td><?= $vllid ?></td>
                                <td><?= $plcid ?></td>
                                <td><?= $memno ?></td>
                                <td><?= $hhdeponnme ?></td>
                                <td><?= $hhtypnme ?></td>
                                <td><?= $hhrent ?></td>
                                <td><?= $hhflrnme ?></td>
                                <td><?= $hhwallnme ?></td>
                                <td><?= $hhrfnme ?></td>
                                <td><?= $hh_toilet ?></td>
                                <td><?= $have_agr_land ?></td>
                                <td><?= $agrlandnme ?></td>
                                <td><?= $hhwaternme ?></td>
                                <td><?= $have_elect ?></td>
                                <td><?= $hhelectnme ?></td>
                                <td><?= $vh_car ?></td>
                                <td><?= $vh_car_age ?></td>
                                <td><?= $vh_truck ?></td>
                                <td><?= $vh_truck_age ?></td>
                                <td><?= $vh_tractor ?></td>
                                <td><?= $vh_tractor_age ?></td>
                                <td><?= $vh_mbike ?></td>
                                <td><?= $vh_no ?></td>
                                <td><?= $hitem_computer ?></td>
                                <td><?= $hitem_aircon ?></td>
                                <td><?= $hitem_tvflat ?></td>
                                <td><?= $hitem_washmachine ?></td>
                                <td><?= $hitem_refrige ?></td>
                                <td><?= $hitem_no==1?"มี":"ไม่มี" ?></td>
                                <td>

                                                                 <div class="btn-group" role="group">
                                    <a href="?page=<?= $_GET['page'] ?>&function=add&perid=<?= $perid ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="deletePerson(
                        '<?= $perid ?>', 
                        '<?= $name ?>', 
                        '<?= $sname ?>'
                    )" class="btn btn-sm btn-danger text-white ">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                                </td>
                            </tr>
                        <?php
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!-- End of your HTML code -->

<!-- ... Rest of your HTML and PHP code as before ... -->


<!-- Rest of your HTML and PHP code as before -->
<!-- delete person -->
<script>
    function deletePerson(id, name, lastName) {
        Swal.fire({
            title: "ลบข้อมูล",
            text: `คุณต้องการลบข้อมูลของ ${name} ${lastName} ใช่หรือไม่?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "ใช่, ลบข้อมูล",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                // Call the delete function here
                deletePersonData(id);
            }
        });
    }

    function deletePersonData(id) {
        // Send an AJAX request to delete the person's data
        $.ajax({
            type: "POST",
            url: "2.person2/delete_person.php", // Replace with your delete script URL
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('#row_' + id).remove();
                    // Remove the deleted row from the DataTable
                    dataTable.row($(`tr[data-id="${id}"]`)).remove().draw();
                    Swal.fire("ลบข้อมูลสำเร็จ", "ข้อมูลถูกลบแล้ว", "success");
                } else {
                    Swal.fire("เกิดข้อผิดพลาด", "ไม่สามารถลบข้อมูลได้", "error");
                }
            },
            error: function(xhr, status, error) {
                Swal.fire("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้", "error");
            }
        });
    }
</script>

<script language=Javascript>
    $(document).ready(function() {
        // Function to get distinct values from the dispform table


        const dataTable = $('#myTableAll').DataTable({
            responsive: true,
            columnDefs: [{
                    responsivePriority: 2,
                    targets: 2
                },
                {
                    responsivePriority: 3,
                    targets: 3
                },
                {
                    responsivePriority: 4,
                    targets: 4
                },
                {
                    responsivePriority: 2,
                    targets: -1
                }
            ],

        });

        // Event listener to trigger the search on the dispfrmnme column when the dropdown or search box changes
        $('#searchBox, #dispfrmnmeDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBox').val().trim();
            const selectedValue = $('#dispfrmnmeDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(7).search(searchBoxValue || selectedValue).draw();
        });
        $('#searchBoxEduLevel, #edulevDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBoxEduLevel').val().trim();
            const selectedValue = $('#edulevDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(8).search(searchBoxValue || selectedValue).draw();
        });
        // Fetch the distinct dispfrmnme values from the get_dispform_values.php file and populate the dropdown options
        $.ajax({
            url: 'educations/get_dispform_values.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const dropdown = $('#dispfrmnmeDropdown');
                dropdown.empty();
                dropdown.append('<option value="">ทั้งหมด</option>'); // Add an option to show all values

                // Add the fetched dispfrmnme values to the dropdown
                data.forEach(function(value) {
                    dropdown.append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
        $.ajax({
            url: 'educations/get_edulev_values.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const dropdown = $('#edulevDropdown');
                dropdown.empty();
                dropdown.append('<option value="">ทั้งหมด</option>'); // Add an option to show all values

                // Add the fetched dispfrmnme values to the dropdown
                data.forEach(function(value) {
                    dropdown.append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
        $('#searchBoxPersonID, #searchBoxPID, #searchBoxTitlename, #searchBoxName, #searchBoxSurname').on('keyup', function() {
            const searchBoxPersonIDValue = $('#searchBoxPersonID').val().trim();
            const searchBoxPIDValue = $('#searchBoxPID').val().trim();
            const searchBoxTitlenameValue = $('#searchBoxTitlename').val().trim();
            const searchBoxNameValue = $('#searchBoxName').val().trim();
            const searchBoxSurnameValue = $('#searchBoxSurname').val().trim();

            // Perform the custom search based on the values in the search boxes
            dataTable
                .column(1).search(searchBoxPersonIDValue)
                .column(2).search(searchBoxPIDValue)
                .column(3).search(searchBoxTitlenameValue)
                .column(4).search(searchBoxNameValue)
                .column(5).search(searchBoxSurnameValue)
                .draw();
        });

        $('#searchBoxProvince').on('keyup', function() {
            const searchBoxProvinceValue = $('#searchBoxProvince').val().trim();


            // Perform the custom search based on the values in the search boxes
            dataTable
                .column(6).search(searchBoxProvinceValue)

                .draw();
        });
    });
</script>