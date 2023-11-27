<?php

$heduid = $_GET["perid"] ? $_GET["perid"] : "";
$perid2 = $_GET["perid2"] ? $_GET["perid2"] : "";
$tab = $_GET["tab"] ? $_GET["tab"] : "";






// Construct your SQL query to fetch hedu details and related information
if ($_GET["tab"] == "2") {
    $column = isset($_GET["heduid"]) && $_GET["heduid"] != "" ? "h.heduid" : "h.perid";

    $sql = "SELECT h.perid, CONCAT(p.name, ' ', p.sname) AS person_fullname,
            h.heduid, e.edulevnme, h.edusemester, h.edugrade, h.edudetail, h.edulev, h.eduid,
            h.recorded_by, h.recorded_date, h.modified_by, h.modified_date,
            CONCAT(s.staffnme, ' ', s.staffsnme) AS recorded_by_name,
            CONCAT(m.staffnme, ' ', m.staffsnme) AS modified_by_name
            FROM hedu AS h
            JOIN person AS p ON h.perid = p.perid
            JOIN edulev AS e ON h.eduid = e.eduid
            LEFT JOIN staff AS s ON h.recorded_by = s.staffid
            LEFT JOIN staff AS m ON h.modified_by = m.staffid
            WHERE $column = " . ($_GET["heduid"] ?? $_GET["perid2"]) . "
            LIMIT 1";
} elseif ($heduid) {
    $sql = "SELECT h.perid, CONCAT(p.name, ' ', p.sname) AS person_fullname,
            h.heduid, e.edulevnme, h.edusemester, h.edugrade, h.edudetail, h.edulev, h.eduid,
            h.recorded_by, h.recorded_date, h.modified_by, h.modified_date,
            CONCAT(s.staffnme, ' ', s.staffsnme) AS recorded_by_name,
            CONCAT(m.staffnme, ' ', m.staffsnme) AS modified_by_name
            FROM hedu AS h
            JOIN person AS p ON h.perid = p.perid
            JOIN edulev AS e ON h.eduid = e.eduid
            LEFT JOIN staff AS s ON h.recorded_by = s.staffid
            LEFT JOIN staff AS m ON h.modified_by = m.staffid
            WHERE h.heduid = $heduid";
}
echo $sql;
$result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_array($result)) {
        $peridFromHedu = $row['perid'];

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

        $person_id = $row['perid'];
        $edulev_id = $row['eduid'];
        $edulev = $row['edulev'];
        $edusemester = $row['edusemester'];
        $edugrade = $row['edugrade'];
        $edudetail = $row['edudetail'];
        $person_fullname = $row['person_fullname'];
    }


$edulevQuery = "SELECT * FROM edulev";
$edulevResult = mysqli_query($conn, $edulevQuery);
?>
<?php if ($tab >0 || $_GET["perid"]) { ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="?page=2.person2&function=add&perid=<?= $peridFromHedu ? $peridFromHedu : $perid2 ?>">ประวัติบุคคล</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">ช่วยเหลือด้านการศึกษา</a>
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
            <a class="nav-link" href="?page=7.history_help_job&function=add&perid2=<?= $perid2 ?>&tab=1">7.history_help_job</a>
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
<br>


<hr class="mb-4">
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <?php if (isset($person_fullname)) { ?>
            <h4 class="app-page-title mb-0"> จัดการข้อมูลประวัติการช่วยเหลือด้านการศึกษา ของ<?php echo $person_fullname; ?></h4>
        <?php } else { ?>
            <h4 class="app-page-title mb-0"> จัดการข้อมูลประวัติการช่วยเหลือด้านการศึกษา</h4>
        <?php } ?>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>" class="btn btn-primary">ย้อนกลับ</a>
    </div>
</div>
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">


                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">
                   <?php if (!($tab >0|| $_GET["perid"] > 0)) { ?>
                        ?>
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="eduid">บุคคล</label>
                            <!-- //div group -->

                            <div class="input-group custom-input-group">
                                <input type="text" id="personSelect" name="personName" class="form-control error" placeholder="Search for a person..." value="" autocomplete="off" required="" aria-invalid="true">
                                <button class="btn btn-outline-secondary" type="button" id="changePersonButton" disabled="">เปลี่ยน</button>
                            </div>

                            <div id="personDropdown" class="dropdown-menu" aria-labelledby="personSelect">
                                <!-- Dropdown items will be populated here -->
                            </div>


                        </div>

                    <?php } else { ?>
                        <script>
                            // Function to enable all input fields
                            //  make ready ajax
                            $(document).ready(function() {


                                $('#perid').val(<?php echo $perid2; ?>);


                            });
                        </script>
                    <?php } ?>
                    <input type="hidden" id="perid" name="perid" value="<?= $person_id; ?>">
                    <div class=" row g-3">
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
                            <label for="edusemester">ชั้นปี</label>
                            <input type="text" class="form-control" name="edulev" id="edulev" value="<?php echo $edulev; ?>" required>
                        </div>
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="edusemester">ปีการศึกษา</label>
                            <input type="text" class="form-control" name="edusemester" id="edusemester" value="<?php echo $edusemester; ?>" required>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="edugrade">เกรดเฉลี่ย</label>
                        <input type="text" class="form-control" name="edugrade" id="edugrade" value="<?php echo $edugrade; ?>" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="edudetail">รายละเอียดอื่น ๆ</label>
                        <textarea class="form-control" name="edudetail" id="edudetail" rows="3"><?php echo $edudetail; ?></textarea>
                    </div>
                    <!-- ... (previous HTML code) ... -->
                    <!-- input perid hidden -->
                    <input type="hidden" id="perid" name="heduid" value="<?= $heduid; ?>">

                    <script>
                        // Function to enable all input fields
                        function enableInputFieldsAndButton(setInput) {
                            console.log('Enable input fields:', setInput);


                            console.trace();
                            $('#personSelect').prop('disabled', setInput ? false : true);
                            $('#eduid').prop('disabled', setInput);
                            $('#edusemester').prop('disabled', setInput);
                            $('#edugrade').prop('disabled', setInput);
                            $('#edudetail').prop('disabled', setInput);
                            $('#changePersonButton').prop('disabled', setInput);
                            $('#edulev').prop('disabled', setInput);
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
                                    url: "3.historyeducation/searchPerson.php",
                                    method: "GET",
                                    dataType: "json",
                                    data: {
                                        query: searchQuery
                                    },
                                    success: function(data) {
                                        // Clear previous results
                                        $('#personDropdown').empty();
                                        console.log('Search results:', data);

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


                    <hr>

                    <!--<button class="mt-3/// btn app-btn-primary" type="button" onClick="">บันทึก</button>-->
                    <?php if (!$heduid||$tab==1) { ?>
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
                            <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $recorded_by; ?>" readonly="true">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="recorded_date">วันที่บันทึก</label>
                            <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder="" value="<?php echo $recorded_date; ?>" readonly="true">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="modified_by">ผู้ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="" value="<?= $modified_by; ?>" readonly="true">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="modified_date">วันที่ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="modified_date" id="modified_date" placeholder="" value="<?php echo $modified_date; ?>" readonly="true">
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
        <?php if ($perid2 || $heduid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
        <?php } ?>
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
                //make rule from input select perid
                perid: {
                    required: true
                },
                //make rule form input heduid
                // heduid: {
                //     required: true,
                //     number: true,
                //     min: 1,
                //     max: 9999999999
                // },
                //make rule form input edudetail
                edudetail: {
                    required: true,
                    minlength: 5
                },
                //make rule form input edugrade
                edugrade: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 4
                },
                edulev: {
                    required: true,
                    number: true,
                    min: 1,

                },
                //make rule form input edusemester
                edusemester: {
                    required: true,
                    number: true,
                    min: 2550,
                    max: 2569
                },
                //make rule form input eduid
                eduid: {
                    required: true,
                    number: true,
                    min: 1,

                },


                //perid: "required",
                //qtn_assessor: "required",


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
                    // Convert birth_date 2564-01-01 to 25640101

                    // Add the action parameter to indicate the action to be performed
                    data['action'] = data['heduid'] ? 'update' : 'insert';
                    console.log(data);
                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",

                        url: "3.historyeducation/insert_historyeducation.php",
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
                                    window.location.href = "?page=3.historyeducation&function=add&perid2=" + data['perid'] + "&tab=1&function=add&perid2=" + data['perid'] + "&tab=1";
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
<!--  if($tab==1)||$heduid) -->
<?php if ($tab == 1 || $heduid) { ?>
    <br>
    <div class="row justify-content-between card-header text-right mb-0">
        <div class="col-auto">
            <h4 class="app-page-title mb-0"> ข้อมูลประวัติการช่วยเหลือด้านการศึกษาของ <?php echo $person_fullname; ?></h4>
        </div>
        <div class="col-auto">
            <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary">ย้อนกลับ</a>
        </div>
    </div>
    <?php
  $perid = isset($_GET['perid2']) ? $_GET['perid2'] : $peridFromHedu;

  // Prepare the SQL query with a placeholder for perid
  $sql = "SELECT
              h.perid,
              CONCAT(p.name, ' ', p.sname) AS person_fullname,
              p.name,
              p.sname,
              h.heduid,
              e.edulevnme,
              h.edusemester,
              h.edugrade,
              h.edudetail,
              h.heduid,
              h.edulev
          FROM
              hedu AS h
              JOIN
              person AS p ON h.perid = p.perid
              JOIN
              edulev AS e ON h.eduid = e.eduid
          WHERE h.perid = ?;";
  
  // Prepare and execute the query
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $perid);
  mysqli_stmt_execute($stmt);
  
  // Get the results
  $results = mysqli_stmt_get_result($stmt);
    echo $sql;
    var_dump($result);
    ?>

    <hr class="mb-0">
    <div class="row g-2 settings-section">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">




                    <form name="frmUserSearch" id="frmUserSearch" method="post" action="" enctype="" onSubmit="" target="">
                        <table id="myTableAll" class="display responsive nowrap" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>รหัสบุคคล</th>
                                    <th>ชื่อ-นามสกุล บุคคล</th>
                                    <!-- <th>รหัสประวัติการศึกษา</th> -->
                                    <th>ระดับการศึกษา</th>
                                    <th>ปีการศึกษา</th>
                                    <th>เกรดเฉลี่ย</th>
                                    <th>รายละเอียดอื่น ๆ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<tr id='row_" . $row['perid'] . "' data-id='" . $row['perid'] . "'>";
                                    echo "<td>" . $counter . "</td>";
                                    echo "<td>" . $row['perid'] . "</td>";
                                    echo "<td>" . $row['person_fullname'] . "</td>";
                                    // echo "<td>" . $row['heduid'] . "</td>";
                                    echo "<td>" . $row['edulevnme'] . "</td>";
                                    echo "<td>" . $row['edusemester'] . "</td>";
                                    echo "<td>" . $row['edugrade'] . "</td>";
                                    echo "<td>" . $row['edudetail'] . "</td>";
                                    echo '<td> <div class="btn-group" role="group">';
                                    echo '<a href="?page=' . $_GET['page'] . '&function=add&perid2=' . $row['perid'] . '&heduid=' . $row['heduid'] . '&tab=1" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>';
                                    // delete onclick (id , name , lastname, table, fillId)
                                    echo '<button type="button" class="btn btn-sm btn-danger text-white" onclick="deletePerson(' . $row['perid']
                                        . ',\'' . $row['name']
                                        . '\',\'' . $row['sname']
                                        . '\',\'hedu\',\'heduid\')"><i class="fas fa-trash-alt"></i></button>';
                                    echo '</div>';
                                    echo '</td>';
                                    echo "</tr>";
                                    $counter++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- </form> -->
                    </form>
                    <!--//app-card-body-->

                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->
        </div>
    </div>
    <script>
        function deletePerson(id, name, lastName, table, fillId) {
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
                    deletePersonData(id, table, fillId);
                }
            });
        }

        function deletePersonData(id, table, fillId) {
            // Send an AJAX request to delete the person's data
            $.ajax({
                type: "POST",
                url: "3.historyeducation/delete_person.php", // Replace with your delete script URL
                data: {
                    id: id,
                    table: table,
                    fillId: fillId

                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        var childRow = $(`tr[data-id="${id}"]`).next('.child');
                        if (childRow.length) {
                            childRow.remove();
                        }

                        // Remove the deleted row from the DataTable
                        $(`tr[data-id="${id}"]`).remove();

                        // Remove the HTML row
                        $(`tr[data-id="${id}"]`).remove();
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
    <!--//row-->
    <?php
    mysqli_close($conn);
    ?>
    <script language=Javascript>
        $(document).ready(function() {
            $('#myTableAll').DataTable({
                language: {
                    "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                    "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                    //"info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                    "info": "แสดง _START_ - _END_ จากทั้งหมด _TOTAL_ รายการ",
                    "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": 'ค้นหา',
                    "paginate": {
                        "previous": "ก่อนหน้านี้",
                        "next": "หน้าต่อไป"
                    }
                },
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
        });

        function delUser(qtn_visid) {
            var xmlhttp = Inint_AJAX();
            var Url = "./visit/qtn_visit_crud.php";
            //alert("xxxxxxxxxxx");
            var POSTBody = "";
            POSTBody += "qtn_visid=" + qtn_visid;
            POSTBody += "&act=delete";
            //alert(POSTBody);
            xmlhttp.open('POST', Url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(POSTBody);
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //eval("var decoded_data = "+xmlhttp.responseText);
                    //window.document.frmUser.perid.value = decoded_data['perid0'];
                    //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
                    //clearForm();
                    //alert("ลบข้อมูลเรียบร้อยแล้ว");
                    Swal.fire({
                        text: 'ลบข้อมูลเรียบร้อยแล้ว',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 15000
                    })
                    window.history.replaceState(null, null, window.location.reload());
                    //$("#frmUser")[0].reset(); // reset form

                }
            }
        };

        function clearForm() {
            //window.document.frmEnroll.reset();
            form.reset();
            location.reload();

        };

        function createFile() {
            var xmlhttp = Inint_AJAX();
            var Url = "./qtn_teachers/qtn_teachers_create_file.php";
            // alert("xxxxxxxxxxx");
            var POSTBody = "";
            POSTBody += "enroll_year=" + document.frmUserSearch.enroll_year.value;
            POSTBody += "&room_id=" + document.frmUserSearch.room_id.value;

            POSTBody += "&act=save";
            // alert(POSTBody);
            xmlhttp.open('POST', Url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(POSTBody);
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText; // แสดงบนหน้าจอ
                    eval("var decoded_data = " + xmlhttp.responseText);
                    if (decoded_data['checkSave'] == "yes") {
                        window.location.href = './qtn_teachers/qtn_teachers_export_file.php?action=Export';
                        alert("สร้างข้อมูลเรียบร้อยแล้ว");
                        // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText; // แสดงบน co
                    } else alert('ไม่สามารถนำออกเป็นไฟล์ EXCEL ได้ กรุณาคลิกเลือกข้อมูลปีการศึกษาก่อน');
                } //else alert(
                // 'ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ'
                //);
            }
        };
    </script>
<?php } ?>