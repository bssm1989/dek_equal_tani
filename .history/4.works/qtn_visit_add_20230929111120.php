<?php
$hwrkid = $_GET["perid"]; // Get hwrkid from page showing the list of hwork
if ($hwrkid) {
    // Construct your SQL query to fetch hwork details and related information
    $sql = "SELECT h.hwrkid, p.perid as person_id, h.occid as occupation_id, h.wrknme as workplace_name,
                   prv.prvnme as province_name, h.wrkpos as workplace_position, h.wrkstarty as start_year,
                   h.wrkperiody as work_period_years, h.wrkperiodm as work_period_months,
                   h.wrkendy as end_year, h.wrkendreas as end_reason, df.dispfrmnme as dispfrmnme,
                   CONCAT(p.name, ' ', p.sname) AS person_fullname
            FROM hwork h
            LEFT JOIN person p ON h.perid = p.perid
            LEFT JOIN prv ON h.prvid = prv.prvid
            LEFT JOIN disptyp dt ON p.perid = dt.perid
            LEFT JOIN dispform df ON dt.dispfrmid = df.dispfrmid
            WHERE h.hwrkid = $hwrkid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
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
}

// Query to fetch occupation options for dropdown
$occupationQuery = "SELECT * FROM occ";
$occupationResult = mysqli_query($conn, $occupationQuery);

// Query to fetch province options for dropdown
$provinceQuery = "SELECT * FROM prv";
$provinceResult = mysqli_query($conn, $provinceQuery);
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

                <!-- •• รหัสประวัติการประกอบอาชีพ
	
					
//  -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">
                <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">บุคคล</label>
                        <input type="hidden" class="form-control" name="hwrkid" id="hwrkid" value="<?php echo $hwrkid; ?>" />
                        <!-- //div group -->
                        <div class="input-group">
                            <input type="text" id="personSelect" name="personName" class="form-control" placeholder="Search for a person..." value="<?php echo $person_fullname; ?>" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="changePersonButton" ">Change</button>
                            </div>
                        </div>
                        <div id="personDropdown" class="dropdown-menu" aria-labelledby="personSelect">
                            <!-- Dropdown items will be populated here -->
                        </div>

                        <input type="hidden" id="perid" name="perid" /> <!-- Hidden input to store the selected ID -->

                    </div>

                        <div class="col-12 col-sm-4 mb-3">
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

                        <div class="col-12 col-sm-4 mb-3">
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
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="wrknme">ชื่อสถานประกอบการ</label>
                            <input type="text" class="form-control" name="wrknme" id="wrknme" value="<?php echo $workplace_name; ?>" required>
                        </div>


                        <div class="col-12 col-sm-4 mb-3">
                            <label for="wrkstarty">ปีที่เริ่มประกอบอาชีพ</label>
                            <input type="text" class="form-control" name="wrkstarty" id="wrkstarty" value="<?php echo $start_year; ?>" required>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="work_period_years">ทำงานเป็นระยะเวลากี่ปี</label>
                            <input type="text" class="form-control" name="work_period_years" id="work_period_years" value="<?php echo $work_period_years; ?>" required>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="work_period_months">กี่เดือน</label>
                            <input type="text" class="form-control" name="work_period_months" id="work_period_months" value="<?php echo $work_period_months; ?>" required>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="wrkendy">ปีที่ลาออก</label>
                            <input type="text" class="form-control" name="wrkendy" id="wrkendy" value="<?php echo $end_year; ?>">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="wrkendreas">เหตุผลที่ลาออก</label>
                            <textarea class="form-control" name="wrkendreas" id="wrkendreas"><?php echo $end_reason; ?></textarea>
                        </div>
                        <script>
                            // Function to enable all input fields
                            function enableInputFieldsAndButton(setInput) {
                                $('#personSelect').prop('disabled', setInput ? false : true);
                                $(' #occid, #prvid, #wrknme, #wrkstarty, #work_period_years, #work_period_months, #wrkendy, #wrkendreas').prop('disabled', setInput);
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
                                <input type="text" class="form-control" name="savofc" id="savofc" placeholder="" value="<?= $rows["savofc"]; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="savdte">วันที่บันทึก</label>
                                <input type="text" class="form-control" name="savdte" id="savdte" placeholder="" value="<?php echo $savdte; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="updofc" id="updofc" placeholder="" value="<?= $rows["updofc"]; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="upddte" id="upddte" placeholder="" value="<?php echo $upddte; ?>" readonly="true" >
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
            console.log($hwrkid);
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
                data['action'] = data['perid'] ? 'update' : 'insert';

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
                                // window.location.href = "?page=4.works";
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