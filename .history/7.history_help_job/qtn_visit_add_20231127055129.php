<?php
$hhjobid = $_GET["hhjobid"] ?? "";
$perid2 = $_GET["perid2"] ?? "";
$tab = $_GET["tab"] ?? "";

// Determine the column for the SQL query based on the existence and value of hhjobid
$column = isset($_GET["hhjobid"]) && $_GET["hhjobid"] != "" ? "hj.hhjobid" : "hj.perid";

if ($_GET["tab"] == "2") {
    // Construct your SQL query to fetch hhelpjob details and related information
    $sql = "SELECT hj.hhjobid, hj.perid, hj.hjobdte, hj.hjobmoney, hj.hjobobject, hj.hjobknowledge, hj.hjobtranfer, hj.hjobdetail,
            CONCAT(p.name, ' ', p.sname) AS participant_name,
            hj.recorded_by, hj.recorded_date, hj.modified_by, hj.modified_date 
            FROM hhelpjob hj
            JOIN person p ON hj.perid = p.perid
            WHERE $column = " . ($_GET["hhjobid"] ?? $_GET["perid2"]);
} else if ($hhjobid) {
    // Construct your SQL query based on hhjobid
    $sql = "SELECT hj.hhjobid, hj.perid, hj.hjobdte, hj.hjobmoney, hj.hjobobject, hj.hjobknowledge, hj.hjobtranfer, hj.hjobdetail,
            CONCAT(p.name, ' ', p.sname) AS participant_name,
            hj.recorded_by, hj.recorded_date, hj.modified_by, hj.modified_date 
            FROM hhelpjob hj
            JOIN person p ON hj.perid = p.perid
            WHERE hj.hhjobid = $hhjobid";
}
// Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($connection->error) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
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

        $perid = $row['perid'];
        $hjobdte = $row['hjobdte'];
        $hjobmoney = $row['hjobmoney'];
        $hjobobject = $row['hjobobject'];
        $hjobknowledge = $row['hjobknowledge'];
        $hjobtranfer = $row['hjobtranfer'];
        $hjobdetail = $row['hjobdetail'];
        $person_fullname = $row['participant_name'];
        $hhjobid = $row['hhjobid'];
    }
 

?>

<!-- replace to dropdown
and could you please provide me with the complete code for this?
• ลักษณะการช่วยเหลือ:: ให้สิ่งของ/อุปกรณ์
• ลักษณะการช่วยเหลือ:: ให้ความรู้
• ลักษณะการช่วยเหลือ:: ส่งต่อให้หน่วยงาน
 Also, if you could continue your answer from before, that would be great. -->
 <?php if ($tab == 1 || $_GET["perid"]) { ?>
 <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link "  href="?page=2.person2&function=add&perid=<?= $perid2 ?>&tab=1">2.person</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="?page=3.historyeducation&function=add&perid2=<?= $perid2 ?>&tab=1">3.historyeducation</a>
    </li>
    <li class="nav-item">
        <!-- ?page=3.historyeducation&function=add&perid=32 -->
        <!-- http://localhost:8888/dek_equal_tani/?page=4.works&function=add&perid=2 -->
        <a class="nav-link" href="?page=4.works&function=add&perid2=<?= $perid2 ?>&tab=1">4.works</a>
    </li>
    <li class="nav-item">
        <!-- ?page=5.helpeducation&function=add&perid2=3 -->
        <a class="nav-link" href="?page=5.helpeducation&function=add&perid2=<?= $perid2 ?>&tab=1">5.helpeducation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=6.1institute&function=add&perid2=<?= $perid2 ?>&tab=1">6.1institute</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#"> 7.history_help_job</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=8.htraining&function=add&perid2=<?= $perid2 ?>&tab=1">8.htraining</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=9.hfolowup&function=add&perid2=<?= $perid2 ?>&tab=1">9.hfolowup</a>
    </li>
  
  <li class="nav-item">
    
  </li>
</ul>
<?php } ?>
 <hr class="mb-4">
 <div class="mb-0 text-right row justify-content-between card-header">
    <div class="col-auto">
        <?php if (isset($person_fullname)) { ?>
            <h4 class="mb-0 app-page-title"> จัดการข้อมูลประวัติการช่วยเหลือด้านอาชีพ ของ<?php echo $person_fullname; ?></h4>
        <?php } else { ?>
            <h4 class="mb-0 app-page-title"> จัดการข้อมูลประวัติการช่วยเหลือด้านอาชีพ</h4>
        <?php } ?>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>" class="btn btn-primary">ย้อนกลับ</a>
    </div>
</div>

<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="p-4 shadow-sm app-card app-card-settings">

            <div class="app-card-body">
                <h5 class="pt-4 mt-3 mb-0 mb-3 text-center app-page-title text-info mt-md-0 pt-md-0">
                    <b>จัดการข้อมูลประวัติการช่วยเหลือด้านอาชีพ</b>
                </h5>

                <!-- รหัสประวัติการช่วยเหลือด้านอาชีพ
• รหัสบุคคล  รหัสเด็ก
• วันที่ให้ความช่วยเหลือ
• ลักษณะการช่วยเหลือ:: ให้เงินสด
• ลักษณะการช่วยเหลือ:: ให้สิ่งของ/อุปกรณ์
• ลักษณะการช่วยเหลือ:: ให้ความรู้
• ลักษณะการช่วยเหลือ:: ส่งต่อให้หน่วยงาน
• รายละเอียดการช่วยเหลือ -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">


                <?php if (!($tab == 1 || $_GET["perid"] > 0)) { ?>
    <div class="mb-3 col-12 col-sm-4">
        <label for="eduid">บุคคล</label>
        <!-- //div group -->
        <!-- input hidden hhjobid -->
        <input type="hidden" name="hhjobid" id="hhjobid" value="<?= $hhjobid; ?>" />
        <div class="input-group">
            <!-- Search for a person... to thai -->
            <input type="text" id="personSelect" name="personName" class="form-control" placeholder="ค้นหาบุคคล" value="<?= $person_fullname; ?>" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="changePersonButton">Change</button>
            </div>
        </div>
        <div id="personDropdown" class="dropdown-menu" aria-labelledby="personSelect">
            <!-- Dropdown items will be populated here -->
        </div>
        <input type="hidden" id="perid" name="perid" value="<?= $perid; ?>" />
    </div>
<?php } else { ?>
    <script>
        // Function to enable all input fields
        //  make ready ajax
        $(document).ready(function() {
            $('#perid').val(<?= $perid2; ?>);
        });
    </script>
    <input type="hidden" id="perid" name="perid" value="<?= $person_id; ?>">
<?php } ?>



                        <div class="mb-3 col-12 col-sm-4">
                            <label for="hjobdte">วันที่ให้ความช่วยเหลือ</label>
                            <input type="text" class="form-control datepicker" name="hjobdte" id="hjobdte" placeholder="วันที่ให้ความช่วยเหลือ" value="<?php echo $hjobdte; ?>" required>
                        </div>

                        <div class="mb-3 col-12 col-sm-4">
                            <label for="hjobmoney">ลักษณะการช่วยเหลือ:: ให้เงินสด</label>
                            <select class="form-control" name="hjobmoney" id="hjobmoney" required>
                                <option value="1" <?php if ($hjobmoney == 1) echo "selected"; ?>>ให้เงินสด</option>
                                <option value="0" <?php if ($hjobmoney == 0) echo "selected"; ?>>ไม่ให้เงินสด</option>
                            </select>
                        </div>

                        <div class="mb-3 col-12 col-sm-4">
                            <label for="hjobobject">ลักษณะการช่วยเหลือ:: ให้สิ่งของ/อุปกรณ์</label>
                            <select class="form-control" name="hjobobject" id="hjobobject" required>
                                <option value="1" <?php if ($hjobobject == 1) echo "selected"; ?>>ให้สิ่งของ/อุปกรณ์</option>
                                <option value="0" <?php if ($hjobobject == 0) echo "selected"; ?>>ไม่ให้สิ่งของ/อุปกรณ์</option>
                            </select>
                        </div>

                        <div class="mb-3 col-12 col-sm-4">
                            <label for="hjobknowledge">ลักษณะการช่วยเหลือ:: ให้ความรู้</label>
                            <select class="form-control" name="hjobknowledge" id="hjobknowledge" required>
                                <option value="1" <?php if ($hjobknowledge == 1) echo "selected"; ?>>ให้ความรู้</option>
                                <option value="0" <?php if ($hjobknowledge == 0) echo "selected"; ?>>ไม่ให้ความรู้</option>
                            </select>
                        </div>

                        <div class="mb-3 col-12 col-sm-4">
                            <label for="hjobtranfer">ลักษณะการช่วยเหลือ:: ส่งต่อให้หน่วยงาน</label>
                            <select class="form-control" name="hjobtranfer" id="hjobtranfer" required>
                                <option value="1" <?php if ($hjobtranfer == 1) echo "selected"; ?>>ส่งต่อให้หน่วยงาน</option>
                                <option value="0" <?php if ($hjobtranfer == 0) echo "selected"; ?>>ไม่ส่งต่อให้หน่วยงาน</option>
                            </select>
                        </div>

                        <!-- ... (other input fields) ... -->


                        <!-- ... (similar inputs for hjobobject, hjobknowledge, hjobtranfer) ... -->

                        <div class="mb-3 col-12 col-sm-12">
                            <label for="hjobdetail">รายละเอียดการช่วยเหลือ</label>
                            <textarea class="form-control" name="hjobdetail" id="hjobdetail" placeholder="รายละเอียดการช่วยเหลือ" required><?php echo $hjobdetail; ?></textarea>
                        </div>
                        <script>
                            // Function to enable all input fields
                            function enableInputFieldsAndButton(setInput) {
                                $('#personSelect').prop('disabled', setInput ? false : true);
                                $('#hjobdte, #hjobmoney, #hjobobject, #hjobknowledge, #hjobtranfer, #hjobdetail').prop('disabled', setInput);
                            }

                            // Initialize the dropdown menu
                            $('#personSelect').on('click', function() {
                                $('#personDropdown').toggle();
                            });

                            // Handle input changes
                            $('#personSelect').on('input', function() {
                                var searchQuery = $(this).val();
                                console.log('Search query:', searchQuery);
                                if (searchQuery.length >= 2) {
                                    // Make an AJAX call to fetch matching results
                                    $.ajax({
                                        url: "7.history_help_job/searchPerson.php",
                                        method: "GET",
                                        dataType: "json",
                                        data: {
                                            query: searchQuery
                                        },
                                        success: function(data) {
                                            // Clear previous results
                                            $('#personDropdown').empty();

                                            // Populate the dropdown with search results
                                            data.forEach(function(result) {
                                                var option = $('<div class="dropdown-item"></div>');
                                                option.text(result.text); // Change this to the property you want to display
                                                option.attr('data-value', result.id); // Change this to the property containing the person's ID
                                                $('#personDropdown').append(option);

                                                // Handle click event for each result
                                                option.on('click', function() {
                                                    var selectedValue = $(this).attr('data-value');
                                                    var selectedText = $(this).text();
                                                    $('#personSelect').val(selectedText); // Set the selected text in the input field
                                                    $('#perid').val(selectedValue); // Set the selected ID in the hidden input
                                                    $('#personDropdown').hide();

                                                    // Enable input fields and show the change button
                                                    enableInputFieldsAndButton(false);
                                                });
                                            });
                                        }
                                    });
                                } else {
                                    // Clear dropdown if the input is too short
                                    $('#personDropdown').empty();
                                }
                            });


                            // Disable all input fields initially
                            enableInputFieldsAndButton(true);
                            $('#changePersonButton').on('click', function() {
                                // Enable input fields and hide the change button
                                enableInputFieldsAndButton(true);
                            });
                            
                        </script>
                        <!--//app-card-body-->

                        <hr>
                        <?php if (!$perid) { ?>
                        <input type="submit" class="mt-3 text-white btn btn-primary" name="submit" value="บันทึก" />
                    <?php } else { ?>
                        <input type="submit" class="mt-3 text-white btn btn-primary" name="submit" value="แก้ไข" />
                        <!-- button cancle -->
                        <input type="button" class="mt-3 text-white btn btn-warning" name="cancle" value="ยกเลิก" onClick="window.location.href='?page=person'" />
                    <?php } ?>
                    <button class="mt-3 text-white btn btn-danger" type="reset" onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>

                        <hr class="mb-4">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="recorded_by">ผู้บันทึก</label>
                                <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $recorded_by; ?>"readonly="true" >
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="recorded_date">วันที่บันทึก</label>
                                <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder="" value="<?php echo $recorded_date; ?>" readonly="true" >
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="modified_by">ผู้ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="" value="<?= $modified_by; ?>"readonly="true" >
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="modified_date">วันที่ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="modified_date" id="modified_date" placeholder="" value="<?php echo $modified_date	; ?>" readonly="true" >
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
        console.log("document ready");
        <?php if ($hhjobid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
            console.log("enableInputFieldsAndButton(f);");

        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
            console.log("enableInputFieldsAndButton(false);");

        <?php } ?>
    });
    $(document).ready(function() {
        $("#frmScreening").validate({
            rules: {
                // ... (existing validation rules)
                personName: {
                    required: true
                },
                hjobdte: {
                    required: true
                },
                hjobmoney: {
                    required: true
                },
                hjobobject: {
                    required: true
                },
                hjobknowledge: {
                    required: true
                },
                hjobtranfer: {
                    required: true
                },
                // ... (other validation rules for new elements)
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
                if ($('#heduid').val()) {
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
                    // Add the action parameter to indicate the action to be performed
                     data['hjobdte'] = data['hjobdte'].replace(/-/g, "");
                    data['action'] = data['hhjobid'] ? 'update' : 'insert';

                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        url: "7.history_help_job/insert_history_help_job.php",
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
                                    // Go to the next page
                                    // window.location.href = "?page=7.history_help_job&function=add&perid2=" + data['perid'] + "&tab=1";
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
</script>
<script language=Javascript>
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
                    window.document.frmScreening.modified_date	.value = decoded_data['modified_date	0'];
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
<?php if ($tab == 1 || $hhjobid) { ?>
    <br>
    <div class="row justify-content-between card-header text-right mb-0">
        <div class="col-auto">
            <h4 class="app-page-title mb-0">ประวัติการช่วยเหลือด้านอาชีพ ของ <?php echo $person_fullname; ?></h4>
        </div>
        <div class="col-auto">
            <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
                เพิ่มข้อมูลใหม่</a>
        </div>
    </div>
<?php } ?>
