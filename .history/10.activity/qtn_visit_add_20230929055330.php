<?php
$actid = $_GET["actid"]; // Get activity ID from page showing list of activities
if ($actid) {
    // Construct your SQL query to fetch activity details and related information
    $sql = "SELECT
                a.actid,
                a.actnme,
                a.acttypid,
                a.actdtestr,
                a.actdteend,
                a.actplc,
                cv.vllnmegen AS place_village,
                a.actattdno,
                a.actdetail
            FROM
                activity a
            JOIN
                acttyp at ON a.acttypid = at.acttypid
            JOIN
                const_vllnmegen cv ON a.plcid = cv.plcid
            WHERE
                a.actid = $actid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $actnme = $row['actnme'];
        $acttypid = $row['acttypid'];
        $actdtestr = $row['actdtestr'];
        $actdteend = $row['actdteend'];
        $actplc = $row['actplc'];
        $place_village = $row['place_village'];
        $actattdno = $row['actattdno'];
        $actdetail = $row['actdetail'];
    }
}
?>

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลกิจกรรม</h4>
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
                    <b>จัดการข้อมูลกิจกรรม</b>
                </h5>

                <!-- • รหัสกิจกรรม
• ชื่อกิจกรรม
• รหัสประเภทกิจกรรม
• วันที่เริ่มจัดกิจกรรม
• วันที่จัดกิจกรรมเสร็จ
• สถานที่จัดกิจกรรม
• จังหวัดอ าเภอต าบล ที่จัดกิจกรรม
• จ านวนผู้เข้าร่วมกิจกรรม
• รายละเอียดการจัดกิจกรรม -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ข้อมูลทั่วไป</p>
                        </div>
                    </div>


                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actnme">ชื่อกิจกรรม</label>
                        <input type="text" class="form-control" name="actnme" id="actnme" placeholder="ชื่อกิจกรรม" value="<?php echo $actnme; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="acttypid">รหัสประเภทกิจกรรม</label>
                        <!-- You can replace this input with a dropdown menu populated from a query -->
                        <input type="text" class="form-control" name="acttypid" id="acttypid" placeholder="รหัสประเภทกิจกรรม" value="<?php echo $acttypid; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actdtestr">วันที่เริ่มจัดกิจกรรม</label>
                        <input type="text" class="form-control" name="actdtestr" id="actdtestr" placeholder="วันที่เริ่มจัดกิจกรรม" value="<?php echo $actdtestr; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actdteend">วันที่จัดกิจกรรมเสร็จ</label>
                        <input type="text" class="form-control" name="actdteend" id="actdteend" placeholder="วันที่จัดกิจกรรมเสร็จ" value="<?php echo $actdteend; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actplc">สถานที่จัดกิจกรรม</label>
                        <input type="text" class="form-control" name="actplc" id="actplc" placeholder="สถานที่จัดกิจกรรม" value="<?php echo $actplc; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="place_village">จังหวัด อำเภอ ตำบล ที่จัดกิจกรรม</label>
                        <input type="text" class="form-control" name="place_village" id="place_village" placeholder="จังหวัด อำเภอ ตำบล ที่จัดกิจกรรม" value="<?php echo $place_village; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actattdno">จำนวนผู้เข้าร่วมกิจกรรม</label>
                        <input type="text" class="form-control" name="actattdno" id="actattdno" placeholder="จำนวนผู้เข้าร่วมกิจกรรม" value="<?php echo $actattdno; ?>" required>
                    </div>

                    <div class="col-12 col-sm-12 mb-3">
                        <label for="actdetail">รายละเอียดการจัดกิจกรรม</label>
                        <textarea class="form-control" name="actdetail" id="actdetail" placeholder="รายละเอียดการจัดกิจกรรม" required><?php echo $actdetail; ?></textarea>
                        

                    </div>
                    <script>
                        // Function to enable all input fields
                        function enableInputFieldsAndButton(setInput) {
                            $('#personSelect').prop('disabled', setInput ? false : true);
                            $('#personSelect, #occid, #prvid, #wrknme, #wrkstarty, #work_period_years, #work_period_months, #wrkendy, #wrkendreas').prop('disabled', true);
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
                    <button class="mt-3 btn app-btn-primary" type="button" onClick="if(checkPerid('กรุณาระบุผู้ประเมินก่อนค่ะ/ครับ')==true){ if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) saveGuestionnaire()};">บันทึก</button>
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
        console.log("document ready");
        <?php if ($actid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
            console.log("enableInputFieldsAndButton(f);");
         
        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
            console.log("enableInputFieldsAndButton(false);");
     
        <?php } ?>
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