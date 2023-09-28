<?php
$hhjobid = $_GET["hhjobid"]; // Get hhjobid from page showing the list of hhelpjob
echo "<h1>hhjobid: $hhjobid</h1>";
if ($hhjobid) {
    // Construct your SQL query to fetch hhelpjob details and related information
    $sql = "SELECT hj.hhjobid, hj.perid, hj.hjobdte, hj.hjobmoney, hj.hjobobject, hj.hjobknowledge, hj.hjobtranfer, hj.hjobdetail,
                   CONCAT(p.name, ' ', p.sname) AS participant_name
            FROM hhelpjob hj
            JOIN person p ON hj.perid = p.perid
            WHERE hj.hhjobid = $hhjobid"; // Modify the condition based on your database structure
    $result = mysqli_query($connection, $sql);
    if ($connection->error) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
    if ($row = mysqli_fetch_array($result)) {
        $perid = $row['perid'];
        $hjobdte = $row['hjobdte'];
        $hjobmoney = $row['hjobmoney'];
        $hjobobject = $row['hjobobject'];
        $hjobknowledge = $row['hjobknowledge'];
        $hjobtranfer = $row['hjobtranfer'];
        $hjobdetail = $row['hjobdetail'];
    }
    var_dump($row);
    echo  $$perid;
}
?>

<!-- replace to dropdown
and could you please provide me with the complete code for this?
• ลักษณะการช่วยเหลือ:: ให้สิ่งของ/อุปกรณ์
• ลักษณะการช่วยเหลือ:: ให้ความรู้
• ลักษณะการช่วยเหลือ:: ส่งต่อให้หน่วยงาน
 Also, if you could continue your answer from before, that would be great. -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลประวัติการช่วยเหลือด้านอาชีพ</h4>
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


                <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">บุคคล</label>
                        <!-- //div group -->
                        <div class="input-group">
                            <!-- Search for a person... to thai -->
                            <input type="text" id="personSelect" name="personName" class="form-control" placeholder="ค้นหาบุคคล">
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
                        <label for="hjobdte">วันที่ให้ความช่วยเหลือ</label>
                        <input type="text" class="form-control" name="hjobdte" id="hjobdte" placeholder="วันที่ให้ความช่วยเหลือ" value="<?php echo $hjobdte; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="hjobmoney">ลักษณะการช่วยเหลือ:: ให้เงินสด</label>
                        <select class="form-control" name="hjobmoney" id="hjobmoney" required>
                            <option value="1" <?php if ($hjobmoney == 1) echo "selected"; ?>>ให้เงินสด</option>
                            <option value="0" <?php if ($hjobmoney == 0) echo "selected"; ?>>ไม่ให้เงินสด</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="hjobobject">ลักษณะการช่วยเหลือ:: ให้สิ่งของ/อุปกรณ์</label>
                        <select class="form-control" name="hjobobject" id="hjobobject" required>
                            <option value="1" <?php if ($hjobobject == 1) echo "selected"; ?>>ให้สิ่งของ/อุปกรณ์</option>
                            <option value="0" <?php if ($hjobobject == 0) echo "selected"; ?>>ไม่ให้สิ่งของ/อุปกรณ์</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="hjobknowledge">ลักษณะการช่วยเหลือ:: ให้ความรู้</label>
                        <select class="form-control" name="hjobknowledge" id="hjobknowledge" required>
                            <option value="1" <?php if ($hjobknowledge == 1) echo "selected"; ?>>ให้ความรู้</option>
                            <option value="0" <?php if ($hjobknowledge == 0) echo "selected"; ?>>ไม่ให้ความรู้</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="hjobtranfer">ลักษณะการช่วยเหลือ:: ส่งต่อให้หน่วยงาน</label>
                        <select class="form-control" name="hjobtranfer" id="hjobtranfer" required>
                            <option value="1" <?php if ($hjobtranfer == 1) echo "selected"; ?>>ส่งต่อให้หน่วยงาน</option>
                            <option value="0" <?php if ($hjobtranfer == 0) echo "selected"; ?>>ไม่ส่งต่อให้หน่วยงาน</option>
                        </select>
                    </div>

                    <!-- ... (other input fields) ... -->


                    <!-- ... (similar inputs for hjobobject, hjobknowledge, hjobtranfer) ... -->

                    <div class="col-12 col-sm-12 mb-3">
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