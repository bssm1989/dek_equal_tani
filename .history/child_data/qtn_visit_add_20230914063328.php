<?php
$qtn_visid   = $_GET["id"];
if($qtn_visid){
    $sql = "SELECT q.`qtn_visid`,a.perid,a.pid,CONCAT(prenme,nme,' ',surnme) AS nme,a.sex,a.brtdte,`weight`,`height`,`waistline`,`blood_pressure`,`help`,helpoth,
    p.roladr,p.rolvllno,e.plcnmegen AS rolplc,a.tel,o.optnme,t.pertypnme,
    `qtn_assessor`,`pos_ofcid`,`qtn_round`,`qtn_date`,`qtnvs1`,`qtnvs2`,`qtnvs3`,`qtnvs4`,`qtnvs5`,`qtnvs6`,`qtnvs7`,`qtnvs8`,`qtnvs_sum`,`qtnvsoth`,
    CONCAT(o1.`ofcnme`) AS savofc,q.savdte,CONCAT(o2.`ofcnme`) AS updofc,q.upddte 
    FROM `questionnaire_visit` q INNER JOIN person a ON q.perid = a.perid
    LEFT JOIN `person_qtn_additional` p ON a.perid = p.perid
    LEFT JOIN `const_plcnmegen` e ON p.rolplcid=e.plcidgen
    LEFT JOIN `const_prenme` pre ON a.preid=pre.preid 
    LEFT JOIN opt o ON a.optid = o.optid 
    LEFT JOIN `const_pertyp` t ON p.pertypid = t.pertypid
    LEFT JOIN ofc o1 ON o1.ofcid=q.savofc
    LEFT JOIN ofc o2 ON o2.ofcid=q.updofc";
    $sql.= " where q.qtn_visid=$qtn_visid";
    $result = mysqli_query($conn,$sql);
    // echo "sql1-> ".$sql;
    if($rows = mysqli_fetch_array($result)){
        $qtn_date = getDateTimeDMY($rows["qtn_date"]);
        $nme        = $rows["nme"];

        $help = explode(",", $rows["help"]);  
        $help1 = $help[0];
        $help2 = $help[1];
        $help3 = $help[2];
        $help4 = $help[3];
        $help5 = $help[4];
        $help6 = $help[5];
        $help7 = $help[6];        

        $qtnvs1     = $rows["qtnvs1"];
        $qtnvs2     = $rows["qtnvs2"];
        $qtnvs3     = $rows["qtnvs3"];
        $qtnvs4     = $rows["qtnvs4"];
        $qtnvs5     = $rows["qtnvs5"];
        $qtnvs6     = $rows["qtnvs6"];
        $qtnvs7     = $rows["qtnvs7"];
        $qtnvs8     = $rows["qtnvs8"];

        $qtn_assessor  = $rows["qtn_assessor"];
        $sum  = $rows["qtnvs_sum"];
        if ($sum >= 3) {
            $res = "มีภาวะเปราะบาง";
        } else if ($sum >= 1) {
            $res = "เริ่มเปราะบาง";
        } else {
            $res = "ไม่มีความเปราะบาง";
        }
        $qtnvs_sum = $sum." : ".$res;
        
        $savdte 	= substr($rows["savdte"],8,2)."-".substr($rows["savdte"],5,2)."-".substr($rows["savdte"],0,4);	
        $upddte 	= substr($rows["upddte"],8,2)."-".substr($rows["upddte"],5,2)."-".substr($rows["upddte"],0,4);
    }
}else {
    $qtn_assessor = $ofcname;
}
?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> แบบประเมินสุขภาวะผู้เปราะบาง</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
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
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="row">
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="qtn_date">วันที่ประเมิน</label>
                                    <input type="text" class="form-control" name="qtn_date" id="testdate"
                                        placeholder="วันที่ทำแบบประเมิน" value="<?php echo $qtn_date; ?>" required>
                                </div>

                                <div class="col-12 col-sm-2 mb-3">
                                    <label for="qtn_round">ครั้งที่</label>
                                    <input type="number" name="qtn_round" id="qtn_round" class="form-control"
                                        placeholder="ครั้งที่" value="<?=$rows["qtn_round"];?>" min="1" max="99"
                                        readonly style="background-color:#e5e5e5">
                                </div>

                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="qtn_assessor">ชื่อ-นามสกุล (ผู้ประเมิน)</label>
                                    <input type="text" name="qtn_assessor" id="qtn_assessor" class="form-control"
                                        placeholder="ชื่อ-นามสกุล (ผู้ประเมิน)" value="<?php echo $qtn_assessor; ?>"
                                        required>
                                </div>

                                <div class="col-12 col-sm-2 mb-3">
                                    <label for="pos_ofcid">ตำแหน่ง</label>
                                    <select class="form-control" name="pos_ofcid" id="pos_ofcid" required>
                                        <option value="">-เลือกตำแหน่ง-</option>
                                        <?php
                                                $sql = "select pos_ofcid,pos_ofcname from const_position_ofc order by pos_ofcid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                        <option value="<?=$row["pos_ofcid"];?>"
                                            <?php if ($rows["pos_ofcid"]==$row["pos_ofcid"]) echo "selected";?>>
                                            <?=$row["pos_ofcname"];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-4 mb-3">
                                <label for="nme">ชื่อ-นามสกุล (ผู้ถูกประเมิน)</label>
                                    <div class="input-group mb-2">
                                        <!-- <label for="stu_id">รหัสแบบคัดกรอง (Auto)</label> -->
                                        <input type="hidden" class="form-control" name="qtn_visid" id="qtn_visid"
                                            placeholder="" value="<?=$rows["qtn_visid"];?>" readonly
                                            style="background-color:#CCCCCC">
                                        <!-- <label for="stu_id">รหัสรันอัตโนมัติ</label> -->
                                        <input type="hidden" class="form-control" name="perid" id="perid" placeholder=""
                                            value="<?=$rows["perid"];?>" readonly style="background-color:#CCCCCC">
                                        <input type="text" class="form-control" name="nme" id="nme"
                                            placeholder="ชื่อ-นามสกุล ผู้ถูกประเมิน"
                                            value="<?php echo $nme ;?>" readonly style="background-color:#e5e5e5"
                                            required>
                                        <button class="btn btn-success" type="button" id="button-addon2"
                                            onClick="popitup('./visit/select_person_form.php','winselect','height=700,width=800');"><i
                                                class="fas fa-search"></i></button>
                                        <button class="btn btn-danger" type="button"
                                            onClick="window.open('./?page=person_add&function=add&id='+window.document.frmScreening.perid.value,'_blank');">
                                            <i class="fas fa-user-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2 mb-3">
                                <label for="age_now">อายุ</label>
                                    <input type="text" name="age_now" id="age_now" class="form-control"
                                        placeholder="อายุ" value="<?=$rows["age_now"];?>" readonly
                                        style="background-color:#CCCCCC">
                                </div>
                                <div class="col-12 col-sm-2 mb-3">
                                <label for="pertypnme">ประเภทบุคคล</label>
                                    <input type="text" class="form-control" name="pertypnme" id="pertypnme"
                                        placeholder="ประเภทบุคคล" value="<?=$rows["pertypnme"];?>" readonly
                                        style="background-color:#CCCCCC">

                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                <label for="age_now">สังกัด อปท./อบต.</label>
                                    <input type="text" class="form-control" name="optnme" id="optnme" placeholder="สังกัด อปท./อบต."
                                        value="<?=$rows["optnme"];?>" readonly style="background-color:#CCCCCC">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="weight">น้ำหนัก (กก.)</label>
                                    <input type="text" class="form-control" name="weight" id="weight"
                                        placeholder="" value="<?=$rows["weight"];?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="height">ส่วนสูง (ซม.)</label>
                                    <input type="text" class="form-control" name="height" id="height"
                                        placeholder="" value="<?=$rows["height"];?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="waistline">รอบเอว (ซม.)</label>
                                    <input type="text" class="form-control" name="waistline" id="waistline"
                                        placeholder="" value="<?=$rows["waistline"];?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="blood_pressure">ค่าความดันโลหิต (ม.ม.ปรอท)</label>
                                    <input type="text" class="form-control" name="blood_pressure" id="blood_pressure"
                                        placeholder="" value="<?=$rows["blood_pressure"];?>">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลด้านความช่วยเหลือ </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <label>อยากให้ช่วยด้านใดบ้าง : </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help1" name="help1" value="1"
                                    <?php if($help1 =="1") echo "checked";?>>
                                <label class="custom-control-label" for="help1">1.อาชีพ </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help2" name="help2" value="2"
                                    <?php if($help2 =="2") echo "checked";?>>
                                <label class="custom-control-label" for="help2">2.การศึกษาบุตร</label>
                            </div>

                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help3" name="help3" value="3"
                                    <?php if($help3 =="3") echo "checked";?>>
                                <label class="custom-control-label" for="help3">3.ที่อยู่อาศัย</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help4" name="help4" value="4"
                                    <?php if($help4 =="4") echo "checked";?>>
                                <label class="custom-control-label" for="help4">4.ความปลอดภัย</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help5" name="help5" value="5"
                                    <?php if($help5 =="5") echo "checked";?>>
                                <label class="custom-control-label" for="help5">5.อุปกรณ์ช่วยเหลือคนพิการ</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help6" name="help6" value="6"
                                    <?php if($help6 =="6") echo "checked";?>>
                                <label class="custom-control-label" for="help6">6.การรักษาพยาบาล</label>
                            </div>
                        </div>                        
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="help7" name="help7" value="7"
                                    <?php if($help7 =="7") echo "checked";?>>
                                <label class="custom-control-label" for="help7">7.อื่นๆ ระบุ</label>
                                <input type="text" class="form-control" name="helpoth"
                                    id="helpoth" placeholder=""
                                    value="<?=$rows["helpoth"];?>">
                            </div>
                        </div>
                    </div>

                    <!-- ################## page2 #################################################### -->

                    <div class="row">
                        <div class="col-md-12 col-md-offset-2">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลแบบประเมินสุขภาวะผู้เปราะบาง</p>                                
                        </div>
                        <div class="col-md-12 col-md-offset-2">
                            <p><b> คำชี้แจง :</b> ขอความร่วมมือ ประเมินสุขภาวะผู้เปราะบาง ในช่วงเวลา 3
                                เดือนที่ผ่านมา โดยการทำเครื่องหมายถูก ( / ) ลงในช่องระดับคะแนนที่กำหนดไว้
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-md-offset-2">
                            <p><u> เกณฑ์การประเมิน :</u></p>
                        </div>
                    </div>
                    <div class="row mx-5">
                        <div class="col-md-5">
                            <p>0 คะแนน ไม่มีความเปราะบาง</p>
                            <p>1-2 คะแนน เริ่มเปราะบาง</p>
                            <p>3 คะแนนขึ้นไป มีภาวะเปราะบาง</p>
                        </div>
                    </div>

                    <table class="table table-bordered" style="height: 100px;">
                        <thead>
                            <tr class="text-center my-5">
                                <th class="align-middle">ข้อ</th>
                                <th class="align-middle">กิจกรรม</th>
                                <th class="align-middle">ระดับคะแนน (0, 0.5, 1)</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center">1.</td>
                                <td class="align-middle">จดจำวัน เวลา สถานที่ บุคคล ทวนคำ 3 คำได้ หลังจากบอกคำไปแล้ว 1
                                    นาที เช่น หลานสาว สวรรค์ ภูเขา
                                </td>
                                <td class="align-middle text-center my-3">
                                    <!-- <input type="text" class="form-control" name="qtnvs1" id="qtnvs1"
                                        placeholder=""
                                        <?php if ($rows["qtnvs1"] <> " ") echo "value='".$rows["qtnvs1"]."'"; else echo "value='0'"; ?>
                                        readonly style="background-color:#FFFFFF" required> -->
                                    <select class="form-select" name="qtnvs1" id="qtnvs1" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs1=="0") echo "selected";?> value="0" selected>0 =
                                            ความจำดี</option>
                                        <option <?php if($qtnvs1=="0.5") echo "selected";?> value="0.5">1 = ความจำพอใช้
                                        </option>
                                        <option <?php if($qtnvs1=="1") echo "selected";?> value="1">2 = ความจำไม่ดี
                                        </option>
                                    </select>

                                </td>

                            </tr>
                            <tr>
                                <td class="align-middle text-center">2.</td>
                                <td class="align-middle">มีความรู้สึกเหนื่อยล้าบ่อยครั้งใน 1 วัน
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs2" id="qtnvs2" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs2=="0") echo "selected";?> value="0" selected>0 =
                                            ไม่มีเลย</option>
                                        <option <?php if($qtnvs2=="0.5") echo "selected";?> value="0.5">1 = มีบ้าง
                                        </option>
                                        <option <?php if($qtnvs2=="1") echo "selected";?> value="1">2 = บ่อยครั้ง
                                        </option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="align-middle text-center">3.</td>
                                <td class="align-middle">เดินขึ้นบันได 10 ขั้นได้หรือไม่
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs3" id="qtnvs3" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs3=="0") echo "selected";?> value="0" selected>0 = ได้ 10
                                            ขั้น</option>
                                        <option <?php if($qtnvs3=="0.5") echo "selected";?> value="0.5">1 = ได้ 5 ขั้น
                                        </option>
                                        <option <?php if($qtnvs3=="1") echo "selected";?> value="1">2 = 0-4 ขั้น
                                        </option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="align-middle text-start">4.</td>
                                <td class="align-middle">เดินไป-กลับ 20 ก้าว โดยไม่มีอุปกรณ์ข่วย
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs4" id="qtnvs4" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs4=="0") echo "selected";?> value="0" selected>0 = ได้ 20
                                            ก้าว</option>
                                        <option <?php if($qtnvs4=="0.5") echo "selected";?> value="0.5">1 = ได้ 10 ก้าว
                                        </option>
                                        <option <?php if($qtnvs4=="1") echo "selected";?> value="1">2 = ได้น้อยกว่า 10
                                            ก้าว</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="align-middle text-start">5.</td>
                                <td class="align-middle">มีโรคประจำตัวน้อยกว่า 4 โรค
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs5" id="qtnvs5" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs2=="0") echo "selected";?> value="0" selected>0 = 0-3 โรค
                                        </option>
                                        <option <?php if($qtnvs2=="0.5") echo "selected";?> value="0.5">1 = 4-6 โรค
                                        </option>
                                        <option <?php if($qtnvs2=="1") echo "selected";?> value="1">2 = 7 โครขึ้นไป
                                        </option>
                                    </select>
                                </td>

                            </tr>

                            <tr>
                                <td class="align-middle text-start">6.</td>
                                <td class="align-middle">มีน้ำหนักลดหรือเพิ่มมากกว่าหรือเท่ากับ 5% ใน 1 ปี
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs6" id="qtnvs6" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs6=="0") echo "selected";?> value="0" selected>0 =
                                            น้ำหนักคงที่</option>
                                        <option <?php if($qtnvs6=="0.5") echo "selected";?> value="0.5">1 = ลด หรือ
                                            เพิ่ม 0-4%</option>
                                        <option <?php if($qtnvs6=="1") echo "selected";?> value="1">2 = ลด หรือ เพิ่ม 5%
                                            ขึ้นไป</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="align-middle text-start">7.</td>
                                <td class="align-middle">มีความคิดเบื่อหน่าย ท้อใจ ว้าเหว่ อยากมีเพื่อนในสัปดาห์ก่อน
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs7" id="qtnvs7" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs7=="0") echo "selected";?> value="0" selected>0 =
                                            ไม่มีเลย</option>
                                        <option <?php if($qtnvs7=="0.5") echo "selected";?> value="0.5">1 = มีบ้าง
                                        </option>
                                        <option <?php if($qtnvs7=="1") echo "selected";?> value="1">2 = บ่อยครั้ง
                                        </option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="align-middle text-start">8.</td>
                                <td class="align-middle">มีความคิดฆ่าตัวตายในเดือนที่ผ่านมา
                                </td>
                                <td class="align-middle text-center my-3">
                                    <select class="form-select" name="qtnvs8" id="qtnvs8" aria-label=""
                                        onClick="sum_score();">
                                        <option <?php if($qtnvs8=="0") echo "selected";?> value="0" selected>0 =
                                            ไม่มีเลย</option>
                                        <option <?php if($qtnvs8=="0.5") echo "selected";?> value="0.5">1 = มีบ้าง
                                        </option>
                                        <option <?php if($qtnvs8=="1") echo "selected";?> value="1">2 = บ่อยครั้ง
                                        </option>
                                    </select>
                                </td>

                            </tr>

                            <tr>
                                <td colspan="2" class="align-middle text-center">รวม</td>
                                <td class="align-middle text-center my-3" id="total_order">
                                    <input type="text" class="form-control" name="qtnvs_sum" id="qtnvs_sum"
                                        placeholder=""
                                        <?php if ($qtnvs_sum <> "") echo "value='".$qtnvs_sum."'"; else echo "value='0 : ไม่มีความเปราะบาง'"; ?>
                                        readonly style="background-color:#FFFFFF" required>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-2">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ข้อสังเกต/ความคิดเห็นอื่น ๆ</p>                                
                        </div>

                        <div class="mb-3">
                            <label for="ans_3_1_2_1" class="form-label">หากท่านมีข้อสังเกตเพิ่มเติม หรือ
                                ความคิดเห็นเพิ่มเติมที่เกี่ยวกับสุขภาวะผู้เปราะบางนอกเหนือจากประเด็นคำถามข้างต้น
                                ท่านสามารถเขียนข้อสังเกต/ความคิดเห็นข้างล่างนี้</label>

                            <div class="col-md-12 mb-1">
                                <textarea class="form-control" name="qtnvsoth" id="qtnvsoth" rows="3"
                                    style="height: 100px"><?=$rows["qtnvsoth"];?></textarea>
                            </div>

                        </div>
                    </div>

                    <hr>
                    <button class="mt-3 btn app-btn-primary" type="button"
                        onClick="if(checkPerid('กรุณาระบุผู้ประเมินก่อนค่ะ/ครับ')==true){ if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) saveGuestionnaire()};">บันทึก</button>
                    <button class="mt-3 btn btn-danger text-white" type="reset"
                        onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>

                    <hr class="mb-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="savofc">ผู้บันทึก</label>
                            <input type="text" class="form-control" name="savofc" id="savofc" placeholder=""
                                value="<?=$rows["savofc"];?>" readonly="true" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="savdte">วันที่บันทึก</label>
                            <input type="text" class="form-control" name="savdte" id="savdte" placeholder=""
                                value="<?php echo $savdte; ?>" readonly="true" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="updofc" id="updofc" placeholder=""
                                value="<?=$rows["updofc"];?>" readonly="true" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="upddte" id="upddte" placeholder=""
                                value="<?php echo $upddte; ?>" readonly="true" required>
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

function delEnrooll() {
    var xmlhttp = Inint_AJAX();
    var Url = "enroll_crud.php";
    //alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "enroll_id=" + document.frmScreening.enroll_id.value;
    //POSTBody += "&stu_id=" + document.frmScreening.stu_id.value;
    POSTBody += "&act=delete";
    alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            eval("var decoded_data = " + xmlhttp.responseText);
            //window.document.frmScreening.perid.value = decoded_data['perid0'];
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            //clearForm();
            alert("ลบข้อมูลเรียบร้อยแล้ว");
            $("#frmScreening")[0].reset(); // reset form

        }
    }
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