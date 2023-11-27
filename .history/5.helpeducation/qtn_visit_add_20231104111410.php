<?php
$hheduid = $_GET["perid"]; // Get hheduid from page showing the list of hhelpedu
if ($hheduid) {
    // Construct your SQL query to fetch hhelpedu details and related information
    $sql = "SELECT hh.hheduid, hh.perid, hh.eduid, hh.hedulev, hh.hedusemester, hh.hedufundtyp, hh.hedumoney, hh.hedudetail,
                   p.perid AS person_perid, p.pid, t.titnme, p.name, p.sname,
                    c.plcnmegen, df.dispfrmnme, el.edulevnme,
                    hh.recorded_by, hh.recorded_date,
                     hh.modified_by, hh.modified_date
            FROM hhelpedu hh
            LEFT JOIN person p ON hh.perid = p.perid
            LEFT JOIN titname t ON p.titid = t.titid
            LEFT JOIN const_plcnmegen c ON p.plcid = c.plcidgen
            LEFT JOIN disptyp dt ON p.perid = dt.perid
            LEFT JOIN dispform df ON dt.dispfrmid = df.dispfrmid
            LEFT JOIN hedu ed ON p.perid = ed.perid
            LEFT JOIN edulev el ON ed.edulev = el.eduid
            WHERE hh.hheduid = $hheduid"; // Modify the condition based on your database structure
            echo $sql;
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

        $perid = $row['perid'];
        $eduid = $row['eduid'];
        $hedulev = $row['hedulev'];
        $hedusemester = $row['hedusemester'];
        $hedufundtyp = $row['hedufundtyp'];
        $hedumoney = $row['hedumoney'];
        $hedudetail = $row['hedudetail'];
        $hheduid = $row['hheduid'];
        $person_fullname=$row['name'] . ' ' . $row['sname'];
    }
}

// Query to fetch edu levels for dropdown
$eduQuery = "SELECT * FROM edulev";
$eduResult = mysqli_query($conn, $eduQuery);
var_dump($eduResult);
?>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link "  href="?page=2.person2&function=add&perid=<?= $heduid ?>">2.person</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="?page=3.historyeducation&function=add&perid=<?= $hwrkid ?>">3.historyeducation</a>
    </li>
    <li class="nav-item">
        <!-- ?page=3.historyeducation&function=add&perid=32 -->
        <!-- http://localhost:8888/dek_equal_tani/?page=4.works&function=add&perid=2 -->
        <a class="nav-link" href="?page=4.works&function=add&perid=<?= $heduid ?>">4.works</a>
    </li>
    <li class="nav-item">
        <!-- ?page=5.helpeducation&function=add&perid=3 -->
        <a class="nav-link active" aria-current="page" href="#">5.helpeducation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=6.1institute&function=add&perid=<?= $heduid ?>">6.1institute</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=7.history_help_job&function=add&perid=<?= $heduid ?>">7.history_help_job</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=8.htraining&function=add&perid=<?= $heduid ?>">8.htraining</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=9.hfolowup&function=add&perid=<?= $heduid ?>">9.hfolowup</a>
    </li>
  
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>

<hr class="mb-4">
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">จัดการข้อมูลประวัติการได้รับความ
            ช่วยเหลือด้านการศึกษา</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <h5 class="app-page-title mb-0 text-info text-center mt-3 pt-4 mt-md-0 pt-md-0 mb-3">
                    <b>จัดการข้อมูลประวัติการได้รับความ
                        ช่วยเหลือด้านการศึกษา</b>
                </h5>

                <!-- hhelpedu	ประวัติการได้รับความช่วยเหลือด้านการศึกษา				
ชื่อฟิลด์	ประเภทข้อมูล	ความยาว	ความหมาย	PK/FK	คำอธิบายเพิ่มเติม
hheduid	bigint		รหัสประวัติการช่วยเหลือด้านการศึกษา	PK	
perid	bigint		รหัสบุคคล  รหัสเด็ก	FK	
eduid	int	2	ระดับการศึกษาขณะที่ได้รับการช่วยเหลือ	FK	มีตารางย่อย
hedulev	int	1	ชั้นปีที่ได้รับทุน		
hedusemester	int	6	ปีการศึกษาที่ได้รับทุน		เก็บ 6 หลัก เช่น 256601
hedufundtyp	int	1	เป็นทุนรายเดือนหรือปีหรือครั้งคราว		1=รายเดือน, 2=รายปี, 3=รายครั้งคราว
hedumoney	int	6	จำนวนเงินที่ได้รับต่อครั้ง		หน่วย:: บาท/เดือน บาท/ปี บาท/ครั้ง
hedudetail	varchar	200	รายละเอียดอื่น ๆ	
รหัสประวัติการช่วยเหลือด้านการศึกษา
• รหัสบุคคล รหัสเด็ก
• ระดับการศึกษาขณะที่ได้รับการช่วยเหลือ
• ชั้นปีที่ได้รับทุน
• ปีการศึกษาที่ได้รับทุน
• เป็นทุนรายเดือนหรือปีหรือครั้งคราว
• จ านวนเงินที่ได้รับต่อครั้ง
• รายละเอียดอื่น ๆ	 -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">


                    <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">บุคคล</label>
                        <!-- //div group -->
                        <!-- input hidden hheduid -->
                        <input type="hidden" name="hheduid" id="hheduid" value="<?php echo $hheduid; ?>" />
                        <div class="input-group">
                            <input type="text" id="personSelect" name="personName" class="form-control" placeholder="Search for a person..." value="<?php echo $person_fullname; ?>" autocomplete="off" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="changePersonButton" ">Change</button>
                            </div>
                        </div>
                        <div id="personDropdown" class="dropdown-menu" aria-labelledby="personSelect" >
                                    <!-- Dropdown items will be populated here -->
                            </div>

                            <input type="hidden" id="perid" name="perid" value="<?php echo $perid; ?>" />

                        </div>

                        <div class=" col-12 col-sm-4 mb-3">
                            <label for="eduid">ระดับการศึกษาขณะที่ได้รับการช่วยเหลือ</label>
                            <select class="form-select" name="eduid" id="eduid" required>
                                <?php
                                while ($eduRow = mysqli_fetch_assoc($eduResult)) {

                                    $selected = ($eduRow['eduid'] == $eduid) ? "selected" : "";
                                    echo "<option value='{$eduRow['eduid']}' {$selected}>{$eduRow['edulevnme']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hedulev">ชั้นปีที่ได้รับทุน</label>
                            <input type="text" class="form-control" name="hedulev" id="hedulev" placeholder="ชั้นปีที่ได้รับทุน" value="<?php echo $hedulev; ?>" required>
                        </div>


                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hedusemester">ปีการศึกษาที่ได้รับทุน</label>
                            <input type="text" class="form-control" name="hedusemester" id="hedusemester" placeholder="ปีการศึกษาที่ได้รับทุน" value="<?php echo $hedusemester; ?>" required>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hedufundtyp">เป็นทุนรายเดือนหรือปีหรือครั้งคราว</label>
                            <select class="form-select" name="hedufundtyp" id="hedufundtyp" required>
                                <option value="1" <?php echo ($hedufundtyp == 1) ? "selected" : ""; ?>>รายเดือน</option>
                                <option value="2" <?php echo ($hedufundtyp == 2) ? "selected" : ""; ?>>รายปี</option>
                                <option value="3" <?php echo ($hedufundtyp == 3) ? "selected" : ""; ?>>รายครั้งคราว</option>
                            </select>
                        </div>
                      
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="hedumoney">จำนวนเงินที่ได้รับต่อครั้ง</label>
                            <input type="text" class="form-control" name="hedumoney" id="hedumoney" placeholder="จำนวนเงินที่ได้รับต่อครั้ง" value="<?php echo $hedumoney; ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="hedudetail">รายละเอียดอื่น ๆ</label>
                            <textarea class="form-control" name="hedudetail" id="hedudetail" rows="4" placeholder="รายละเอียดอื่น ๆ"><?php echo $hedudetail; ?></textarea>
                        </div>
                        <script>
                            // Function to enable all input fields
                            function enableInputFieldsAndButton(setInput) {
                                $('#personSelect').prop('disabled', setInput ? false : true);
                                $('#eduid, #hedulev, #hedusemester, #hedufundtyp, #hedumoney, #hedudetail').prop('disabled', setInput);
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
                                        url: "5.helpeducation/searchPerson.php",
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
                                <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $recorded_by; ?>"readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="recorded_date">วันที่บันทึก</label>
                                <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder="" value="<?php echo $recorded_date; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="modified_by">ผู้ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="" value="<?= $modified_by; ?>"readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
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
        <?php if ($perid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
            console.log('<?= $perid ?>');
        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
            console.log("No perid");
        <?php } ?>
    });
    $(document).ready(function() {
    $("#frmScreening").validate({
        rules: {
            // ... (existing validation rules)
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
            eduid: {
                required: true
            },
            hedulev: {
                required: true
            },
            hedusemester: {
                required: true
            },
            hedufundtyp: {
                required: true
            },
            hedumoney: {
                required: true
            },
            hedudetail: {
                required: true
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
                // Add the action parameter to indicate the action to be performed
                data['action'] = data['hheduid'] ? 'update' : 'insert';

                // Send data to the server for insertion or update
                $.ajax({
                    type: "POST",
                    url: "5.helpeducation/insert_helpeducation.php",
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
                                // window.location.href = "?page=5.helpeducation";
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