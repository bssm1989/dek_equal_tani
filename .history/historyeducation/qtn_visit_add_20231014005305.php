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
                <button class="mt-3 btn app-btn-primary" type="button" onClick="if(checkPerid('กรุณาระบุผู้ประเมินก่อนค่ะ/ครับ')==true){ if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) saveGuestionnaire()};">บันทึก</button>
                <button class="mt-3 btn btn-danger text-white" type="reset" onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>

                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="recorded_by">ผู้บันทึก</label>
                        <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $rows["recorded_by"]; ?>" readonly="true" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="recorded_date">วันที่บันทึก</label>
                        <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder="" value="<?php echo $recorded_date; ?>" readonly="true" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="modified_by">ผู้ปรับปรุงแก้ไข</label>
                        <input type="text" class="form-control" name="modified_by" id="modified_by" placeholder="" value="<?= $rows["modified_by"]; ?>" readonly="true" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="modified_date">วันที่ปรับปรุงแก้ไข</label>
                        <input type="text" class="form-control" name="modified_date" id="modified_date" placeholder="" value="<?php echo $modified_date	; ?>" readonly="true" required>
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