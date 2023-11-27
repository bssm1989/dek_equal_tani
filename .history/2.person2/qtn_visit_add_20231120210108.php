<?php
$perid = $_GET["perid"];
//hello world
// echo "<h1>perid = $perid</h1>";
// Get  from page showing the list of hwork
if ($perid) {
    // Construct your SQL query to fetch hwork details and related information
    $sql = "SELECT p.perid AS person_id, p.pid AS national_id, p.titid AS title_id,
    t.titnme AS title_name, p.name, p.sname AS surname, p.genid AS gender_id,
    g.gennme AS gender_name, p.religid AS religion_id, r.relignme AS religion_name,
    p.brtdte AS birth_date, p.age, p.adr AS address, p.soi AS street,
    p.vllid AS village_id, v.vllnme AS village_name, p.plcid AS place_id,
    plc.plcnme AS place_name, p.postcode, p.pertel AS phone_number,
    p.hholdid AS household_id, c.chiord AS child_order, l.livewnme AS living_with,
  l.livewid AS living_with_id,
    f.famsttnme AS family_status,
    f.famsttid AS family_status_id,
     c.distschkm AS distance_km_m,
    c.distschm AS distance_m, c.distschhrs AS distance_hours,
    c.distschmin AS distance_minutes, c.farepay AS fare_per_month,
    m.schmethid AS main_transportation_id, m.schmethnme AS main_transportation,
    c.chidetail AS child_detail,
     df.dispfrmnme AS display_form,
     df.dispfrmid AS display_form_id
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
WHERE p.perid = $perid";
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

        $perid = $row["person_id"];
        $national_id = $row["national_id"];
        $title_id = $row["title_id"];
        $title_name = $row["title_name"];
        $name = $row["name"];
        $surname = $row["surname"];
        $regional_id = $row["regional_id"];
        $regional_name = $row["regional_name"];
        $birth_date = $row["birth_date"];
        //$birth_date is buddist year convert to christian year ex 25640101 to 20170101
        $birth_date = date("Y-m-d", strtotime("-543 year", strtotime($birth_date)));

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
        $living_with_id = $row["living_with_id"];

        $family_status = $row["family_status"];
        $family_status_id = $row["family_status_id"];
        $distance_km_m = $row["distance_km_m"];
        $distance_m = $row["distance_m"];
        $distance_hours = $row["distance_hours"];
        $distance_minutes = $row["distance_minutes"];
        $fare_per_month = $row["fare_per_month"];
        $main_transportation_id = $row["main_transportation_id"];
        $main_transportation = $row["main_transportation"];
        $child_detail = $row["child_detail"];
        $display_form = $row["display_form"];
        $display_form_id = $row["display_form_id"];
    }
    //value place_id
    // echo "<h1>place_id = $place_id</h1>";
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
<!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->



<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">ประวัติบุคคล</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>" href="?page=3.historyeducation&function=add&perid2=<?= $perid ?>&tab=1">ช่วยเหลือด้านการศึกษา</a>
    </li>
    <li class="nav-item">
        <!-- ?page=3.historyeducation&function=add&perid=32 -->
        <!-- http://localhost:8888/dek_equal_tani/?page=4.works&function=add&perid=2 -->
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>"" href=" ?page=4.works&function=add&perid=<?= $heduid ?>">4.works</a>
    </li>
    <li class="nav-item">
        <!-- ?page=5.helpeducation&function=add&perid=3 -->
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>"" href=" ?page=5.helpeducation&function=add&perid=<?= $heduid ?>">5.helpeducation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>"" href=" ?page=6.1institute&function=add&perid=<?= $heduid ?>">6.1institute</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>"" href=" ?page=7.history_help_job&function=add&perid=<?= $heduid ?>">7.history_help_job</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>"" href=" ?page=8.htraining&function=add&perid=<?= $heduid ?>">8.htraining</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['perid']) == true ? ($_GET['perid'] ? '' : 'disabled') : 'disabled' ?>"" href=" ?page=9.historyeducation&function=add&perid=<?= $heduid ?>">9.historyeducation</a>
    </li>

    <li class="nav-item">

    </li>
</ul>
<hr class="mb-4">

<div class="row g-4 settings-section">

    <div class="col-12 col-md-12">

        <div class="row justify-content-between app-card text-right mb-0">
            <div class="col-auto">
                <h4 class="app-page-title mb-0">จัดการข้อมูลบุคคล</h4>
            </div>
            <div class="col-auto">
                <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary">ย้อนกลับ</a>
            </div>
        </div>
        <div class=" app-card-settings shadow-sm p-4">


            <form name="frmScreening" id="frmScreening" method="post" enctype="" onSubmit="" target="">

                <!-- ... (previous HTML code) ... -->
                <!-- input perid hidden -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ประวัติส่วนตัว </p>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" id="perid" name="perid" value="<?= $perid; ?>">
                    <div class="col-12 col-sm-3 mb-3 md-2">
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
                    <div class="col-12 col-sm-5 mb-3 md-5">
                        <label for="name">ชื่อ</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?= $name; ?>" required>
                    </div>
                    <!-- นามสกุล -->
                    <div class="col-12 col-sm-4 mb-3 md-5">
                        <label for="surname">นามสกุล</label>
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="" value="<?= $surname; ?>" required>
                    </div>
                    <!-- เลขบัตรประชาชน -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 mb-3 md-5">
                        <label for="national_id">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" name="national_id" id="national_id" placeholder="" value="<?= $national_id; ?>" required>
                    </div>
                    <!-- ปีเดือนวันเกิด -->
                    <div class="col-12 col-sm-6 mb-3">
                        <label for="birth_date">วันที่เกิด (วัน/เดือน/ปี)</label>
                        <!-- <input type="text" class="form-control datepicker" name="birth_date" id="birth_date" placeholder="" value="<?= $birth_date; ?>" required> -->
                        <!-- <input type="text" class="form-control " name="birth_date" id="birth_date" placeholder="" value="<?= $birth_date; ?>" required> -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="birth_date" id="birth_date" placeholder="" value="<?php echo $birth_date; ?>" onchange="getAge()">
                            <button class="btn btn-success" type="button" id="button-addon2" onClick="clearDate()">
                                <i class="fas fa-sync-alt"></i></button>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-3 mb-3">
                            <label for="brtdte">วันที่เกิด (วัน/เดือน/ปี)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="brtdte" id="testdate" placeholder=""
                                    value="<?php echo $brtdte; ?>" onchange="getAge()">
                                <button class="btn btn-success" type="button" id="button-addon2" onClick="clearDate()">
                                    <i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div> <div class="col-md-3 mb-3">
                            <label for="brtdte">วันที่เกิด22 (วัน/เดือน/ปี)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="brtdte" id="testdate" placeholder=""
                                    value="<?php echo $brtdte; ?>" onchange="getAge()">
                                <button class="btn btn-success" type="button" id="button-addon2" onClick="clearDate()">
                                    <i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div> -->
                <div class="row">
                    <!-- รหัสเพศ -->
                    <div class="col-12 col-sm-2 mb-3">
                        <label for="gender">รหัสเพศ</label>
                        <select class="form-control" name="gender_id" id="gender" required>
                            <!-- Populate options from $genderResult -->
                            <?php while ($row = mysqli_fetch_assoc($genderResult)) { ?>
                                <option value="<?= $row['genid']; ?>"><?= $row['gennme']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- รหัสศาสนา -->
                    <div class="col-12 col-sm-5 mb-3">
                        <label for="religion_id">ศาสนา</label>
                        <select class="form-control" name="religion_id" id="religion_id" required>
                            <!-- Populate options from $religResult -->
                            <?php while ($row = mysqli_fetch_assoc($religResult)) { ?>
                                <option value="<?= $row['religid']; ?>"><?= $row['relignme']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- กรณีศาสนาอื่น ๆ -->
                    <div class="col-12 col-sm-5 mb-3">
                        <label for="religion_other">กรณีศาสนาอื่น ๆ</label>
                        <input type="text" class="form-control" name="religion_other" id="religion_other" placeholder="" value="<?= $other_religion; ?>">
                    </div>
                </div>




                <!-- อายุ 	 -->
                <div class="col-12 col-sm-4 mb-3">
                    <label for="age">อายุ</label>
                    <input type="text" class="form-control" name="age" id="age" placeholder="" value="<?= $age; ?>" required>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่ปัจจุบัน </p>
                    </div>
                </div>
                <div class="row">
                    <!-- รหัสไปรษณีย์ postcode	int	5	รหัสไปรษณีย์-->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="postcode">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" name="postcode" id="postcode" placeholder="" value="<?= $postcode; ?>" required>
                    </div>
                    <!-- ที่อยู่ปัจจุบัน บ้านเลขที่ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="address">ที่อยู่ปัจจุบัน บ้านเลขที่</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="" value="<?= $address; ?>">
                    </div>
                    <!-- ถนน ซอย -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="street">ถนน ซอย</label>
                        <input type="text" class="form-control" name="street" id="street" placeholder="" value="<?= $street; ?>">
                    </div>
                </div>
                <!-- จังหวัด -->


                <div class="col-12 col-sm-12 mb-3">

                    <div id="addr1" class="address">
                        <!-- get value from php place_id -->
                        <p><?= $place_id; ?></p>
                        <input type="hidden" id="addr1-addressCode" name="place_id" value="<?= $place_id; ?>" />

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
                <!-- เบอร์โทรศัพท์ -->
                <div class="col-12 col-sm-4 mb-3">
                    <label for="phone_number">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" value="<?= $phone_number; ?>" required>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> สถานภาพครอบครัว </p>
                    </div>
                </div>
                <div class="row">
                    <!-- เป็นบุตรคนที่เท่าไหร่ -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="child_order">เป็นบุตรคนที่เท่าไหร่</label>
                        <input type="text" class="form-control" name="child_order" id="child_order" placeholder="" value="<?= $child_order; ?>" required>
                    </div>

                    <!-- นักเรียนอาศัยอยู่กับใคร -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="livew_id">นักเรียนอาศัยอยู่กับใคร</label>
                        <select class="form-control" name="livew_id" id="livew_id" required>
                            <option value="">-- เลือกนักเรียนอาศัยอยู่กับใคร --</option>
                            <?php
                            while ($livewRow = mysqli_fetch_assoc($livewResult)) {
                                $selected = ($living_with_id == $livewRow['livewid']) ? 'selected' : '';
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
                            <?php while ($row = mysqli_fetch_assoc($familyStatusResult)) {
                                $selected = ($family_status_id == $row['famsttid']) ? 'selected' : '';
                                echo '<option value="' . $row['famsttid'] . '" ' . $selected . '>' . $row['famsttnme'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> การเดินทางจากที่พักอาศัยไปโรงเรียน </p>
                    </div>
                </div>
                <div class="row">
                    <!-- การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตร -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="distance_to_school_km">การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่กิโลเมตรกี่เมตร</label>
                        <input type="text" class="form-control" name="distance_to_school_km" id="distance_to_school_km" placeholder="" value="<?= $distance_km_m; ?>" required>
                    </div>
                    <!-- การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่เมตร -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="distance_to_school_km">การเดินทางจากที่พักอาศัยไปโรงเรียน:: ระยะทางกี่เมตร</label>
                        <input type="text" class="form-control" name="distance_to_school_m" id="distance_to_school_m" placeholder="" value="<?= $distance_m; ?>" required>
                    </div>


                    <!-- การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมง -->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="travel_time_to_school">การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่ชั่วโมง</label>
                        <input type="text" class="form-control" name="travel_time_to_school_hour" id="travel_time_to_school" placeholder="" value="<?= $distance_hours; ?>" required>
                    </div>
                </div>
                <div class="row">

                    <!-- การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่นาที-->
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="travel_time_to_school">การเดินทางจากที่พักอาศัยไปโรงเรียน:: ใช้เวลากี่นาที</label>
                        <input type="text" class="form-control" name="travel_time_to_school_minute" id="travel_time_to_school" placeholder="" value="<?= $distance_minutes; ?>" required>
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
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ความเลื่อมล้ำ </p>
                    </div>
                </div>
                <!-- รายละเอียดเชิงคุณภาพ -->
                <div class="col-12 mb-3">
                    <label for="quality_detail">รายละเอียดเชิงคุณภาพ</label>
                    <textarea class="form-control" name="quality_detail" id="quality_detail" rows="4" required><?= $child_detail; ?></textarea>
                </div>

                <!-- รหัสลักษณะความเหลื่อมล้ำ (Dropdown) -->
                <div class="col-12 mb-3">
                    <label for="dispform">ลักษณะความเหลื่อมล้ำ</label>
                    <select class="form-control" name="dispform" id="dispform" required>
                        <option value="">เลือกรหัสลักษณะความเหลื่อมล้ำ</option>
                        <?php while ($row = mysqli_fetch_assoc($dispformCodeResult)) {
                            //disptypid	bigint		รหัสความเหลื่อมล้ำ	PK	
                            // perid	bigint		รหัสบุคคล  รหัสเด็ก	FK	
                            // dispfrmid	int	2	รหัสลักษณะความเหลื่อมล้ำ	FK	มีตารางย่อย
                            $selected = ($display_form_id == $row['dispfrmid']) ? 'selected' : '';
                            echo '<option value="' . $row['dispfrmid'] . '" ' . $selected . '>' . $row['dispfrmnme'] . '</option>';
                        } ?>

                    </select>
                </div>




                <!--//app-card-body-->

                <hr>
                <!--<button class="mt-3/// btn app-btn-primary" type="button" onClick="">บันทึก</button>-->
                <?php if (!$perid) { ?>
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
                    data['birth_date'] = data['birth_date'].replace(/-/g, "");

                    // Add the action parameter to indicate the action to be performed
                    data['action'] = data['perid'] ? 'update' : 'insert';

                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        url: "2.person2/insert_person.php",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                // Show success message
                                console.log(response);
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'ตกลง'
                                }).then(() => {
                                    // Go to next page
                                    // window.location.href = "?page=person";
                                    window.location.href = "?page=2.person2&function=add&perid=" + response.personid;
                                });
                            } else {
                                // Show error message
                                Swal.fire({
                                    title: 'ข้อผิดพลาด',
                                    text: "เกิดข้อผิดพลาด: " + response.message,
                                    icon: 'error',
                                    confirmButtonText: 'ตกลง'
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