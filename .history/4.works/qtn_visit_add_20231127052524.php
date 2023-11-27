<?php
$hwrkid = $_GET["perid"]; // Get hwrkid from page showing the list of hwork
$heduid = $_GET["perid"] ? $_GET["perid"] : "";
$perid2 = $_GET["perid2"] ? $_GET["perid2"] : "";
$tab = $_GET["tab"] ? $_GET["tab"] : "";

if ($_GET["tab"] == "1") {
    // Construct your SQL query to fetch hwork details and related information
    $column = isset($_GET["hwrkid"]) && $_GET["hwrkid"] != "" ? "h.hwrkid" : "h.perid";

    $sql = "SELECT h.hwrkid, p.perid as person_id, h.occid as occupation_id, h.wrknme as workplace_name,
            prv.prvnme as province_name, h.wrkpos as workplace_position, h.wrkstarty as start_year,
            h.wrkperiody as work_period_years, h.wrkperiodm as work_period_months,
            h.wrkendy as end_year, h.wrkendreas as end_reason, df.dispfrmnme as dispfrmnme,
            CONCAT(p.name, ' ', p.sname) AS person_fullname, h.recorded_by, h.recorded_date,
            h.modified_by, h.modified_date
            FROM hwork h
            LEFT JOIN person p ON h.perid = p.perid
            LEFT JOIN prv ON h.prvid = prv.prvid
            LEFT JOIN disptyp dt ON p.perid = dt.perid
            LEFT JOIN dispform df ON dt.dispfrmid = df.dispfrmid
            WHERE $column = " . ($_GET["hwrkid"] ?? $_GET["perid2"]);
            echo $sql;
} elseif ($hwrkid) {
    // Construct your SQL query to fetch hwork details and related information based on hwrkid
    $sql = "SELECT h.hwrkid, p.perid as person_id, h.occid as occupation_id, h.wrknme as workplace_name,
            prv.prvnme as province_name, h.wrkpos as workplace_position, h.wrkstarty as start_year,
            h.wrkperiody as work_period_years, h.wrkperiodm as work_period_months,
            h.wrkendy as end_year, h.wrkendreas as end_reason, df.dispfrmnme as dispfrmnme,
            CONCAT(p.name, ' ', p.sname) AS person_fullname, h.recorded_by, h.recorded_date,
            h.modified_by, h.modified_date
            FROM hwork h
            LEFT JOIN person p ON h.perid = p.perid
            LEFT JOIN prv ON h.prvid = prv.prvid
            LEFT JOIN disptyp dt ON p.perid = dt.perid
            LEFT JOIN dispform df ON dt.dispfrmid = df.dispfrmid
            WHERE h.hwrkid = $hwrkid";
}

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

    $person_id = $row['person_id'];
    $occupation_id = $row['occupation_id'];
    $workplace_name = $row['workplace_name'];
    $province_name = $row['province_name'];
    $workplace_position = $row['workplace_position'];
    $start_year = $row['start_year'];
    $work_period_years = $row['work_period_years'];
    $work_period_months = $row['work_period_months'];
    $end_year = $row['end_year'];
    $end_reason = $row['end_reason'];
    $person_fullname = $row['person_fullname'];
    $hwrkid = $row['hwrkid'];
}



// Query to fetch occupation options for dropdown
$occupationQuery = "SELECT * FROM occ";
$occupationResult = mysqli_query($conn, $occupationQuery);

// Query to fetch province options for dropdown
$provinceQuery = "SELECT * FROM prv";
$provinceResult = mysqli_query($conn, $provinceQuery);
?>
<?php if ($tab == 1 || $_GET["perid"]) { ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="?page=2.person2&function=add&perid=<?= $perid2 ?>&tab=1">2.person</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=3.historyeducation&function=add&perid2=<?= $perid2 ?>&tab=1">3.historyeducation</a>
        </li>
        <li class="nav-item">
            <!-- ?page=3.historyeducation&function=add&perid=32 -->
            <!-- http://localhost:8888/dek_equal_tani/?page=4.works&function=add&perid=2 -->
            <a class="nav-link active" aria-current="page">4.works</a>
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

<hr class="mb-4">
<div class="mb-0 text-right row justify-content-between card-header">
    <div class="col-auto">
        <?php if (isset($person_fullname)) { ?>
            <h4 class="mb-0 app-page-title">จัดการข้อมูลประวัติการประกอบอาชีพ ของ<?php echo $person_fullname; ?></h4>
        <?php } else { ?>
            <h4 class="mb-0 app-page-title">เพิ่มข้อมูลประวัติการประกอบอาชีพ</h4>
        <?php } ?>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="p-4 shadow-sm app-card app-card-settings">

            <div class="app-card-body">
                <h5 class="pt-4 mt-3 mb-0 mb-3 text-center app-page-title text-info mt-md-0 pt-md-0">
                    <b>จัดการข้อมูลประวัติการประกอบอาชีพ</b>
                </h5>

                <!-- •• รหัสประวัติการประกอบอาชีพ
	
					
//  -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">
                    <?php if (!($tab == 1 || $_GET["perid"] > 0)) { ?>
                        ?>
                        <div class="mb-3 col-12 col-sm-4">
                            <label for="eduid">บุคคล</label>
                            <input type="hidden" class="form-control" name="hwrkid" id="hwrkid" value="<?php echo $hwrkid; ?>" />
                            <!-- //div group -->
                            <div class="input-group">
                                <input type="text" id="personSelect" name="personName" class="form-control" placeholder="Search for a person..." value="<?php echo $person_fullname; ?>" autocomplete="off" required>

                                <button class="btn btn-outline-secondary" type="button" id="changePersonButton" ">Change</button>
                            </div>
                        </div>
                        <div id=" personDropdown" class="dropdown-menu" aria-labelledby="personSelect">
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
                    <input type="hidden" id="perid" name="perid" value="<?php echo $person_id; ?>" required>
                    <div class="mb-3 col-12 col-sm-4">
                        <label for="occid">รหัสอาชีพ</label>
                        <select class="form-select" name="occid" id="occid" required>
                            <?php
                            while ($occupationRow = mysqli_fetch_assoc($occupationResult)) {
                                $selected = ($occupationRow['occid'] == $occupation_id) ? "selected" : "";
                                echo "<option value='{$occupationRow['occid']}' {$selected}>{$occupationRow['occnme']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3 col-12 col-sm-4">
                        <label for="prvid">จังหวัดที่ทำงาน</label>
                        <select class="form-select" name="prvid" id="prvid" required>
                            <?php
                            while ($provinceRow = mysqli_fetch_assoc($provinceResult)) {
                                $selected = ($provinceRow['prvid'] == $province_id) ? "selected" : "";
                                echo "<option value='{$provinceRow['prvid']}' {$selected}>{$provinceRow['prvnme']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- ชื่อสถานประกอบการ -->
                    <div class="mb-3 col-12 col-sm-4">
                        <label for="wrknme">ชื่อสถานประกอบการ</label>
                        <input type="text" class="form-control" name="wrknme" id="wrknme" value="<?php echo $workplace_name; ?>" required>
                    </div>

                    <!-- ทำงานในตำแหน่ง -->
                    <div class="mb-3 col-12 col-sm-4">
                        <label for="workplace_position">ทำงานในตำแหน่ง</label>
                        <input type="text" class="form-control" name="workplace_position" id="workplace_position" value="<?php echo $workplace_position; ?>" required>
                    </div>
                    <div class="mb-3 col-12 col-sm-4">
                        <label for="wrkstarty">ปีที่เริ่มประกอบอาชีพ</label>
                        <input type="text" class="form-control" name="wrkstarty" id="wrkstarty" value="<?php echo $start_year; ?>" required>
                    </div>

                    <div class="mb-3 col-12 col-sm-4">
                        <label for="work_period_years">ทำงานเป็นระยะเวลากี่ปี</label>
                        <input type="text" class="form-control" name="work_period_years" id="work_period_years" value="<?php echo $work_period_years; ?>" required>
                    </div>

                    <div class="mb-3 col-12 col-sm-4">
                        <label for="work_period_months">กี่เดือน</label>
                        <input type="text" class="form-control" name="work_period_months" id="work_period_months" value="<?php echo $work_period_months; ?>" required>
                    </div>

                    <div class="mb-3 col-12 col-sm-4">
                        <label for="wrkendy">ปีที่ลาออก</label>
                        <input type="text" class="form-control" name="wrkendy" id="wrkendy" value="<?php echo $end_year; ?>">
                    </div>

                    <div class="mb-3 col-12">
                        <label for="wrkendreas">เหตุผลที่ลาออก</label>
                        <textarea class="form-control" name="wrkendreas" id="wrkendreas"><?php echo $end_reason; ?></textarea>
                    </div>
                    <script>
                        // Function to enable all input fields
                        function enableInputFieldsAndButton(setInput) {
                            $('#personSelect').prop('disabled', setInput ? false : true);
                            $(' #occid, #prvid, #wrknme, #wrkstarty, #work_period_years, #work_period_months, #wrkendy, #wrkendreas', '#workplace_position').prop('disabled', setInput ? false : true);
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
                                    url: "4.works/searchPerson.php",
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

                    <hr class="mb-4">


                    <!--//app-card-body-->

                    <hr>
                    <?php if (!$hwrkid||$tab==1) { ?>
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
                            <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $recorded_by; ?>" readonly="true">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="recorded_date">วันที่บันทึก</label>
                            <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder="" value="<?php echo $recorded_date; ?>" readonly="true">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="modified_by">ผู้ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="" value="<?= $modified_by; ?>" readonly="true">
                        </div>
                        <div class="mb-3 col-md-3">
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
        <?php if ($hwrkid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
            // console.log($hwrkid);
            console.log("Has perid");
        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
            console.log("No perid");
        <?php } ?>
    });
    $(document).ready(function() {
        $("#frmScreening").validate({
            rules: {
                eduid: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 9
                },
                personSelect: {
                    required: true
                },
                changePersonButton: {
                    // Include any specific rules for this element if needed
                },
                personDropdown: {
                    // Include any specific rules for this element if needed
                },
                perid: {
                    required: true
                },
                occid: {
                    // Include any specific rules for this element if needed
                },
                prvid: {
                    // Include any specific rules for this element if needed
                },
                wrknme: {
                    required: true
                },
                wrkstarty: {
                    required: true,
                    number: true
                },
                work_period_years: {
                    required: true,
                    number: true
                },
                work_period_months: {
                    required: true,
                    number: true
                },
                wrkendy: {
                    // Include any specific rules for this element if needed
                },
                wrkendreas: {
                    // Include any specific rules for this element if needed
                },
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
                    // data['action'] = data['h'] ? 'update' : 'insert';
                    data['action'] = data['hwrkid'] ? 'update' : 'insert';

                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        url: "4.works/insert_works.php",
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
                                    window.location.href = "?page=3.historyeducation&function=add&perid2=" + data['perid'] + "&tab=1&function=add&perid2=" + data['perid'] + "&tab=1";





                                    window.location.href = "?page=4.works&function=add&perid2=" + data['perid'] + "&tab=1";

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
</script>
<script>
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
<?php if ($tab == 1 || $hwrkid) { ?>
    <br>
    <div class="row justify-content-between card-header text-right mb-0">
        <div class="col-auto">
            <h4 class="app-page-title mb-0"><?php echo "ข้อมูลประวัติการประกอบอาชีพ ของ $person_fullname"; ?></h4>
        </div>
        <div class="col-auto">
            <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
                <?php echo "เพิ่มข้อมูลใหม่"; ?></a>
        </div>
    </div>
    <?php
    $perid = isset($_GET['perid2']) ? $_GET['perid2'] : $person_id;
    $sql = "SELECT 
  h.hwrkid, p.pid as person_id,
  p.name,
  p.sname,
   h.occid as occupation_id, h.wrknme as workplace_name, 
  prv.prvnme as province_name, h.wrkpos as workplace_position, h.wrkstarty as start_year, 
  h.wrkperiody as work_period_years, h.wrkperiodm as work_period_months, 
  h.wrkendy as end_year, h.wrkendreas as end_reason , df.dispfrmnme as dispfrmnme
FROM 
  hwork h
LEFT JOIN 
  person p ON h.perid = p.perid
LEFT JOIN 
  prv ON h.prvid = prv.prvid
  LEFT JOIN 
  disptyp dt ON p.perid = dt.perid
LEFT JOIN 
  dispform df ON dt.dispfrmid = df.dispfrmid
  WHERE h.perid = ?;";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $perid);
    mysqli_stmt_execute($stmt);

    // Get the results
    $results = mysqli_stmt_get_result($stmt);
    echo $sql;
    var_dump($result);
    ?>
<div class="row g-2 settings-section">
    <!-- ... Rest of your HTML code as before ... -->
    <!-- Start of the new table section -->
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">
           
            <table class="table" id="myTableAll">
                <!-- Table headings in Thai language -->
                <thead class="table-light">
                    <tr>
                        <th class="align-middle text-center" scope='col'>รหัสประวัติการประกอบอาชีพ</th>
                        <th class="align-middle text-start" scope='col'>รหัสเด็ก</th>
                        <th class="align-middle text-start" scope='col'>รหัสอาชีพ</th>
                        <th class="align-middle text-start" scope='col'>ชื่อสถานประกอบการ</th>
                        <th class="align-middle text-start" scope='col'>จังหวัดที่ทำงาน</th>
                        <th class="align-middle text-start" scope='col'>ทำงานในตำแหน่ง</th>
                        <th class="align-middle text-start" scope='col'>ปีที่เริ่มประกอบอาชีพ</th>
                        <th class="align-middle text-start" scope='col'>ทำงานเป็นระยะเวลา (ปี)</th>
                        <th class="align-middle text-start" scope='col'>ทำงานเป็นระยะเวลา (เดือน)</th>
                        <th class="align-middle text-start" scope='col'>ปีที่ลาออก</th>
                        <th class="align-middle text-start" scope='col'>เหตุผลที่ลาออก</th>
                        <th class="align-middle text-start" scope='col'>ลักษณะความเหลื่อมล้ำ</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the $results array to display the data in the table
                    while ($row = mysqli_fetch_assoc($results)) {
                        // Extract the data from the current row
                        $hwrkid = $row['hwrkid'];
                        $person_id = $row['person_id'];
                        //name
                        $name = $row['name'];
                        //sname
                        $sname = $row['sname'];
                        $occupation_id = $row['occupation_id'];
                        $workplace_name = $row['workplace_name'];
                        $province_name = $row['province_name'];
                        $workplace_position = $row['workplace_position'];
                        $start_year = $row['start_year'];
                        $work_period_years = $row['work_period_years'];
                        $work_period_months = $row['work_period_months'];
                        $end_year = $row['end_year'];
                        $end_reason = $row['end_reason'];
                        $dispfrmnme = $row['dispfrmnme'];
                    ?>
                        <!-- Display the data in each row of the table -->
                        <tr id="row<?= $hwrkid ?>" data-id="<?= $hwrkid ?>">
                            <td class="align-middle text-center"><?= $hwrkid ?></td>
                            <td class="align-middle text-start"><?= $person_id ?></td>
                            <td class="align-middle text-start"><?= $occupation_id ?></td>
                            <td class="align-middle text-start"><?= $workplace_name ?></td>
                            <td class="align-middle text-start"><?= $province_name ?></td>
                            <td class="align-middle text-start"><?= $workplace_position ?></td>
                            <td class="align-middle text-start"><?= $start_year ?></td>
                            <td class="align-middle text-start"><?= $work_period_years ?></td>
                            <td class="align-middle text-start"><?= $work_period_months ?></td>
                            <td class="align-middle text-start"><?= $end_year ?></td>
                            <td class="align-middle text-start"><?= $end_reason ?></td>
                            <td class="align-middle text-start"><?= $dispfrmnme ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    
                                <a href="?page=<?= $_GET['page'] ?>&function=add&perid2=<?= $hwrkid ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                <button" type="button" class="btn btn-sm btn-danger text-white" onclick="deletePerson2(<?= $hwrkid ?>,'<?= $name ?>','<?= $sname ?>','hwork','hwrkid')"><i class="fas fa-trash-alt"></i></button>

                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--//app-card-body-->
    </div>
    <!--//app-card-->
</div>
<!-- ... Rest of your HTML code as before ... -->
</div>
<!-- End of your HTML code -->

<!-- ... Rest of your HTML and PHP code as before ... -->
<script language=Javascript>
    $(document).ready(function() {
        // Function to get distinct values from the dispform table


        const dataTable = $('#myTableAll').DataTable({
            language: {
                "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
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

        // Event listener to trigger the search on the dispfrmnme column when the dropdown or search box changes
        $('#searchBox, #dispfrmnmeDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBox').val().trim();
            const selectedValue = $('#dispfrmnmeDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(11).search(searchBoxValue || selectedValue).draw();
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
            url: "4.works/delete_person.php", // Replace with your delete script URL
            // url: "3.historyeducation/delete_person.php", // Replace with your delete script URL
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
<?php } ?>