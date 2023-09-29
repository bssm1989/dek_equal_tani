<?php
$hhtrnid = $_GET["hhtrnid"]; // Get hhtrnid from page showing the list of htraining
if ($hhtrnid) {
    // Construct your SQL query to fetch htraining details and related information
    $sql = "SELECT ht.hhtrnid, ht.perid, ht.htrndtestr, ht.htrndteend, ht.htrntit, ht.prvid, ht.htrndetail,
                   CONCAT(p.name, ' ', p.sname) AS participant_name, prv.prvnme AS training_province
            FROM htraining ht
            JOIN person p ON ht.perid = p.perid
            JOIN prv ON ht.prvid = prv.prvid
            WHERE ht.hhtrnid = $hhtrnid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $perid = $row['perid'];
        $htrndtestr = $row['htrndtestr'];
        $htrndteend = $row['htrndteend'];
        $htrntit = $row['htrntit'];
        $prvid = $row['prvid'];
        $htrndetail = $row['htrndetail'];
        $participant_name = $row['participant_name'];
        $training_province = $row['training_province'];
    }
}
?>

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลประวัติการอบรม</h4>
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
                    <b>จัดการข้อมูลประวัติการอบรม</b>
                </h5>

                <!-- รหัสประวัติการติดตาม/การเยี่ยมเยียน
• รหัสบุคคล รหัสเด็ก
• วันที่เริ่มติดตาม/เยี่ยมเยียน (แต่ละครั้ง) เปิดไว้กรณีติดตามหลายวัน
• วันที่ติดตาม/เยี่ยมเยียนเสร็จ
• ติดตาม/เยี่ยมเยียนด้วยวิธีใด
• รายละเอียดการติดตาม/เยี่ยมเยียน -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">


                <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">บุคคล</label>
                        <!-- //div group -->
                        <div class="input-group">
                            <!-- Search for a person... to thai -->
                            <input type="text" id="personSelect" name="personName" class="form-control" placeholder="ค้นหาบุคคล"   value="<?php echo $person_fullname; ?>" required>
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
                        <label for="htrndtestr">วันที่เริ่มอบรม</label>
                        <input type="text" class="form-control" name="htrndtestr" id="htrndtestr" placeholder="วันที่เริ่มอบรม" value="<?php echo $htrndtestr; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="htrndteend">วันที่อบรมเสร็จ</label>
                        <input type="text" class="form-control" name="htrndteend" id="htrndteend" placeholder="วันที่อบรมเสร็จ" value="<?php echo $htrndteend; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="htrntit">เรื่องที่อบรม</label>
                        <input type="text" class="form-control" name="htrntit" id="htrntit" placeholder="เรื่องที่อบรม" value="<?php echo $htrntit; ?>" required>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="prvid">จังหวัดที่อบรม</label>
                        <!-- You can replace this input with a dropdown menu populated from a query -->
                        <input type="text" class="form-control" name="prvid" id="prvid" placeholder="จังหวัดที่อบรม" value="<?php echo $prvid; ?>" required>
                    </div>

                    <div class="col-12 col-sm-12 mb-3">
                        <label for="htrndetail">รายละเอียดการอบรม</label>
                        <textarea class="form-control" name="htrndetail" id="htrndetail" placeholder="รายละเอียดการอบรม" required><?php echo $htrndetail; ?></textarea>
                    </div>
                    <script>
                        // Function to enable all input fields
                        function enableInputFieldsAndButton(setInput) {
                            $('#personSelect').prop('disabled', setInput ? false : true);
                            $('#htrndtestr, #htrndteend, #htrntit, #prvid, #htrndetail').prop('disabled', setInput);
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
                                    url: "8.htraining/searchPerson.php",
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
        <?php if ($hhtrnid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
            console.log("enableInputFieldsAndButton(false);");
   
        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
            console.log("enableInputFieldsAndButton(true);");
         
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