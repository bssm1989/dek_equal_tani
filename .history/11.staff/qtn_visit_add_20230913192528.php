<?php
$staff_id = $_GET["id"]; // Get staff ID from the page showing the list of staff

if ($staff_id) {
    $sql = "SELECT
                staff.staffid, staff.pid, staff.titid, staff.staffnme, staff.staffsnme,
                staff.stafftell, staff.staffemail, staff.stafforg, staff.plcid,
                staff.staffposid, staff.staffprioid,
                titname.titnme, const_vllnmegen.plcname, staffpos.staffposnme
            FROM staff
            LEFT JOIN titname ON staff.titid = titname.titid
            LEFT JOIN const_vllnmegen ON staff.plcid = const_vllnmegen.plcid
            LEFT JOIN staffpos ON staff.staffposid = staffpos.staffposid
            LEFT JOIN staffprio ON staff.staffprioid = staffprio.staffprioid
            WHERE staff.staffid = $staff_id";

    if ($rows = mysqli_fetch_array($result)) {
        // Initialize variables from the fetched data
        $staffid = $rows["staffid"];
        $pid = $rows["pid"];
        $titid = $rows["titid"];
        $staffnme = $rows["staffnme"];
        $staffsnme = $rows["staffsnme"];
        $stafftell = $rows["stafftell"];
        $staffemail = $rows["staffemail"];
        $stafforg = $rows["stafforg"];
        $plcid = $rows["plcid"];
        $staffposid = $rows["staffposid"];
        $staffprioid = $rows["staffprioid"];
    }
}

?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> แบบประเมินสุขภาวะผู้เปราะบาง2</h4>
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
                    <b>แบบประเมินสุขภาวะผู้เปราะบาง</b>
                </h5>
                <p><b> คำชี้แจง :</b> แบบสำรวจนี้มีวัตถุประสงค์เพื่อสังเกตอาการในเบื้องต้น
                    นำไปสู่การดูแลเอาใจใส่ต่อไป ทั้งนี้ข้อมูลจะถูกเก็บเป็นความลับ
                    ไม่นำไปเผยแพร่
                    หากมีการนำเสนอจะเป็นการนำเสนอในภาพรวม </p>
                <br>
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ข้อมูลทั่วไป</p>
                        </div>
                    </div>
                  
                    

                        <!-- Add other input fields for staff information here -->
                        <div class="row">
                            <div class="col-12 col-sm-4 mb-3">
                                <label for="staffnme">ชื่อ</label>
                                <input type="text" class="form-control" name="staffnme" id="staffnme" placeholder="ชื่อ" value="<?php echo $staffnme; ?>" required>
                            </div>

                            <div class="col-12 col-sm-4 mb-3">
                                <label for="staffsnme">สกุล</label>
                                <input type="text" class="form-control" name="staffsnme" id="staffsnme" placeholder="สกุล" value="<?php echo $staffsnme; ?>" required>
                            </div>

                            <div class="col-12 col-sm-4 mb-3">
                                <label for="stafftell">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="stafftell" id="stafftell" placeholder="เบอร์โทรศัพท์" value="<?php echo $stafftell; ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 mb-3">
                                <label for="staffemail">อีเมล์</label>
                                <input type="email" class="form-control" name="staffemail" id="staffemail" placeholder="อีเมล์" value="<?php echo $staffemail; ?>" required>
                            </div>

                            <div class="col-12 col-sm-4 mb-3">
                                <label for="stafforg">หน่วยงานที่สังกัด</label>
                                <input type="text" class="form-control" name="stafforg" id="stafforg" placeholder="หน่วยงานที่สังกัด" value="<?php echo $stafforg; ?>" required>
                            </div>

                            <div class="col-12 col-sm-4 mb-3">
                                <label for="plcid">จังหวัด อำเภอ ตำบล หน่วยงานที่สังกัด</label>
                                <input type="text" class="form-control" name="plcid" id="plcid" placeholder="จังหวัด อำเภอ ตำบล หน่วยงานที่สังกัด" value="<?php echo $plcid; ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 mb-3">
                                <label for="staffposid">รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้</label>
                                <input type="text" class="form-control" name="staffposid" id="staffposid" placeholder="รหัสตำแหน่ง" value="<?php echo $staffposid; ?>" required>
                            </div>

                            <div class="col-12 col-sm-4 mb-3">
                                <label for="staffprioid">รหัสสิทธิการเข้าถึงข้อมูล</label>
                                <input type="text" class="form-control" name="staffprioid" id="staffprioid" placeholder="รหัสสิทธิการเข้าถึงข้อมูล" value="<?php echo $staffprioid; ?>" required>
                            </div>
                        </div>

                
            </div>

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