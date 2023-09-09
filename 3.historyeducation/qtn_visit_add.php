<?php
$heduid = $_GET["id"]; // Get heduid from page showing the list of hedu
if ($heduid) {
    // Construct your SQL query to fetch hedu details and related information
    $sql = "SELECT h.perid, CONCAT(p.name, ' ', p.sname) AS person_fullname,
                   h.heduid, e.edulevnme, h.edusemester, h.edugrade, h.edudetail
            FROM hedu AS h
            JOIN person AS p ON h.perid = p.perid
            JOIN edulev AS e ON h.eduid = e.eduid
            WHERE h.heduid = $heduid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $person_id = $row['perid'];
        $edulev_id = $row['eduid'];
        $edusemester = $row['edusemester'];
        $edugrade = $row['edugrade'];
        $edudetail = $row['edudetail'];
    }
}

$edulevQuery = "SELECT * FROM edulev";
$edulevResult = mysqli_query($conn, $edulevQuery);
?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลประวัติการช่วยเหลือด้านการศึกษา</h4>
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
                    <b>จัดการข้อมูลประวัติการช่วยเหลือด้านการศึกษา</b>
                </h5>

                <!-- รหัสประวัติการศึกษา
• รหัสบุคคล=รหัสเด็ก
• ระดับการศึกษา
• ชั้นปี
• ปีการศึกษา
• เกรดเฉลี่ย
• รายละเอียดอื่น ๆ
hedu	ประวัติการศึกษา				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
heduid	bigint		รหัสประวัติการศึกษา	PK	
perid	bigint		รหัสบุคคล = รหัสเด็ก	FK	
eduid	int	2	ระดับการศึกษา	FK	มีตารางย่อย
edulev	int	1	ชั้นปี		
edusemester	int	6	ปีการศึกษา		เก็บ 6 หลัก เช่น 256601
edugrade	number	4	เกรดเฉลี่ย		เช่น 3.50
edudetail	varchar	200	รายละเอียดอื่น ๆ		
edu	ระดับการศึกษา				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
eduid	int	1	รหัสระดับการศึกษา	PK	
edunme	varchar	50	ชื่อระดับการศึกษา		-->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">ระดับการศึกษา</label>
                        <select id="personSelect" class="custom-select2 form-control" style="width: 100%;">
                            <option value=""></option>
                        </select>
                        <script>
                            // Initialize Select2
                            $(document).ready(function() {
                                $('#personSelect').select2({
                                    placeholder: "Search for a person...",
                                    ajax: {
                                        url: "3.historyeducation/searchPerson.php",
                                        dataType: 'json',
                                        delay: 250,
                                        processResults: function(data) {
                                            return {
                                                results: data
                                            };
                                        },
                                        cache: true
                                    }
                                });
                            });
                        </script>
                    </div>
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">ระดับการศึกษา</label>
                        <select class="form-select" name="eduid" id="eduid" required>
                            <?php
                            while ($edulevRow = mysqli_fetch_assoc($edulevResult)) {
                                $selected = ($edulevRow['eduid'] == $edulev_id) ? "selected" : "";
                                echo "<option value='{$edulevRow['eduid']}' {$selected}>{$edulevRow['edulevnme']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="edusemester">ปีการศึกษา</label>
                        <input type="text" class="form-control" name="edusemester" id="edusemester" value="<?php echo $edusemester; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="edugrade">เกรดเฉลี่ย</label>
                        <input type="text" class="form-control" name="edugrade" id="edugrade" value="<?php echo $edugrade; ?>" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="edudetail">รายละเอียดอื่น ๆ</label>
                        <textarea class="form-control" name="edudetail" id="edudetail" rows="3"><?php echo $edudetail; ?></textarea>
                    </div>
                </form>

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
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    }).then(() => {
                        // Go to next page
                        window.location.href = "?page=person";
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
