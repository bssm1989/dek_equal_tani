<?php
    $ofcid   = $_SESSION['ofcid'];
    $optid   = $_SESSION['user_optid'];
    // if(isset($ofcid) && !empty($ofcid)){
    if($ofcid){
        $sql = "SELECT `ofc_no`,`ofc_preid`,`ofc_fname`,`ofc_lname`,`ofc_nickname`,`ofc_pid`,`ofc_brtdte`,`ofc_age`,`ofc_reg`,";
        $sql.= " `ofc_edulev`,`ofc_graduated_sch`,`ofc_stsmar`,`ofc_numchi`,`ofc_roladr`,`ofc_rolvllsoi`,`ofc_rolvllno`,`ofc_rolplcid`,";
        $sql.= " `ofc_adr`,`ofc_vllsoi`,`ofc_vllno`,`ofc_plcid`,`ofc_tel`,`ofc_fb`,`ofc_line_id`,`optid`,`ofc_pos`,`period`,`work_exp`,`training_exp`,";
        $sql.= " `impression`,`feedback`,`ofc_photo`";
        $sql.= " from ofc_hygienist where ofcid=$ofcid";
        // echo  "xxxxx".$sql;
        $result = mysqli_query($conn,$sql);
        if($rows = mysqli_fetch_array($result)){
            $ofc_no = $rows["ofc_no"];
            $brtdte = getDateTimeDMY($rows["ofc_brtdte"]);
            //$brtday		= substr($rows["brtdte"],6,2);
            //$brtmon		= substr($rows["brtdte"],4,2);
            //$brtyear	= substr($rows["brtdte"],0,4);
            //$brtdte		= $brtday."-".$brtmon."-".$brtyear;
    
            $prv2		= substr($rows["ofc_rolplcid"],0,2);
            $amp2		= substr($rows["ofc_rolplcid"],0,4);
            $tmb2		= $rows["ofc_rolplcid"];
            $vll2		= $rows["ofc_rolplcid"].$rows["ofc_rolvllno"];
    
            $prv3		= substr($rows["ofc_plcid"],0,2);
            $amp3		= substr($rows["ofc_plcid"],0,4);
            $tmb3		= $rows["ofc_plcid"];
            $vll3		= $rows["ofc_plcid"].$rows["ofc_vllno"];

            /* รูปภาพประจำตัว */
            $file_resnme = $rows["ofc_photo"];
            if($file_resnme == ""){$picname="./php/images/adduser.png";}
            else{$picname="./php/images/".$file_resnme;}

            // $optid = $rows["optid"];

            // $savdte 	= substr($rows["savdte"],6,2)."-".substr($rows["savdte"],4,2)."-".substr($rows["savdte"],0,4);	
            // $upddte 	= substr($rows["upddte"],6,2)."-".substr($rows["upddte"],4,2)."-".substr($rows["upddte"],0,4);
        }
    }else{
        $picname="./php/images/adduser.png";
    }

?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ใบสมัครนักสุขภาวะ</h4>
    </div>
</div>
<hr class="mb-0">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">

                <div id="showSql"></div>
                <form class="needs-validation" novalidate name="frmProfile" id="frmProfile" method="post"
                    action="./profile/perupfilehygienist.php" enctype="multipart/form-data" onSubmit="" target="">
                    <div class="tab-content" id="myTabContent">
                        <!-- ################## page1 #################################################### -->

                        <div class="row">
                            <div class="col-12 col-sm-12 mt-3">
                                <!-- <input type="hidden" class="form-control" name="ofc_id" id="ofc_id" placeholder=""
                                    value="<?=$rows["ofc_id"];?>" readonly style="background-color:#CCCCCC"> -->
                                <input type="hidden" class="form-control" name="ofc_no" id="ofc_no" placeholder=""
                                    value="<?=$rows["ofc_no"];?>" readonly style="background-color:#CCCCCC">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3 text-center align-middle">

                                <input class="text_form" type="hidden" name="MAX_FILE_SIZE" value="2097152">
                                <img class="rounded float-center" id="uploadPreview" src="<?php echo $picname ?>" style=" cursor: pointer; border: 1px solid #030e3f;
                                        height: 140px;
                                        width: 140px;" onclick="getFile()">
                                <span style="position: relative; top: 5px;">

                                    <input type="file" name="fileupload" id="fileupload" accept="*"
                                        title="เลือกไฟล์รูปภาพ" value="" style="display: none;"
                                        onchange="PreviewImage();">

                                    <div id="btn btn-primary">
                                        <button id="submit"
                                            style="<?php echo ($rows['ofc_no']<>""?"display:btn btn-primary;":"display:none;") ?>"
                                            onClick="saveFile()">บันทึก</button>
                                    </div>
                                    <?php if($file_resnme) echo "<a href=\"./profile/perdelfilehygienist.php?ofc_no=".$ofc_no."&filename=".$picname."\" >ลบ</a>"; ?>

                                </span>


                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ส่วนที่ 1
                                    ข้อมูลส่วนตัวผู้สมัคร</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ofc_preid">คำนำหน้าชื่อ</label>
                                <select class="form-control" name="ofc_preid" id="ofc_preid">
                                    <?php
                                            $sql = "select preid,prenme from const_prenme order by preid";
                                            $result = mysqli_query($conn,$sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                    <option value="<?=$row["preid"];?>"
                                        <?php if ($rows["ofc_preid"]==$row["preid"]) echo "selected";?>>
                                        <?=$row["prenme"];?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_fname">ชื่อ</label>
                                <input type="text" class="form-control" name="ofc_fname" id="ofc_fname" placeholder=""
                                    value="<?=$rows["ofc_fname"];?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ofc_lname">นานสกุล</label>
                                <input type="text" class="form-control" name="ofc_lname" id="ofc_lname" placeholder=""
                                    value="<?=$rows["ofc_lname"];?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ofc_nickname">ชื่อเล่น</label>
                                <input type="text" class="form-control" name="ofc_nickname" id="ofc_nickname"
                                    placeholder="" value="<?=$rows["ofc_nickname"];?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ofc_pid">เลขบัตรประชาชน</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="ofc_pid" id="ofc_pid" placeholder=""
                                        value="<?=$rows["ofc_pid"];?>">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_brtdte">วันที่เกิด (วัน/เดือน/ปี)</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="ofc_brtdte" id="testdate1"
                                        placeholder="" value="<?php echo $brtdte; ?>" onchange="getAge()">
                                    <button class="btn btn-success" type="button" id="button-addon2"
                                        onClick="clearDate()">
                                        <i class="fas fa-sync-alt"></i></button>
                                </div>

                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_age">อายุ (ปี เดือน)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="ofc_age" id="ofc_age" maxlength="3"
                                        min="0" ,max="150" placeholder="อายุ (ปี)"
                                        <?php if ($rows["ofc_age"]) echo "value='".$rows["ofc_age"]."'"; else echo "value='0'"; ?>>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_reg">ศาสนา</label>
                                <select class="form-control" name="ofc_reg" id="ofc_reg">
                                    <?php
                                    $sql = "select regid,regnme from const_reg order by regid";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value="<?=$row["regid"];?>"
                                        <?php if ($rows["ofc_reg"]==$row["regid"]) echo "selected";?>>
                                        <?=$row["regnme"];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ofc_edulev">ระดับการศึกษาสูงสุด (วุฒการศึกษา)</label>
                                <select class="form-control" name="ofc_edulev" id="ofc_edulev">
                                    <?php
                                                $sql = "select edulevid,edulevnme from const_edulev order by edulevid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                    <option class="text_form" value="<?=$row["edulevid"];?>"
                                        <?php if ($rows["ofc_edulev"]==$row["edulevid"]) echo "selected";?>>
                                        <?=$row["edulevnme"];?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_graduated_sch">สถานศึกษา</label>
                                <input type="text" class="form-control" name="ofc_graduated_sch" id="ofc_graduated_sch"
                                    placeholder="" value="<?=$rows["ofc_graduated_sch"];?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_stsmar">สถานภาพ</label>
                                <select class="form-control" name="ofc_stsmar" id="ofc_stsmar">
                                    <?php
                                                $sql = "select * from const_stsmar order by stsmar";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                    <option value="<?=$row["stsmar"];?>"
                                        <?php if ($rows["ofc_stsmar"]==$row["stsmar"]) echo "selected";?>>
                                        <?=$row["stsmarnme"];?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_numchi">มีบุตรจำนวนกี่คน</label>
                                <input type="number" class="form-control" name="ofc_numchi" id="ofc_numchi"
                                    maxlength="3" min="0" ,max="150" placeholder="อายุ (ปี)"
                                    <?php if ($rows["ofc_numchi"]) echo "value='".$rows["ofc_numchi"]."'"; else echo "value='0'"; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 mt-3">
                                <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่ตามทะเบียนบ้าน
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ofc_roladr">บ้านเลขที่</label>
                                <input type="text" class="form-control" name="ofc_roladr" id="ofc_roladr" placeholder=""
                                    value="<?=$rows["ofc_roladr"];?>">
                            </div>
                            <div class="col-md-9 mb-3">
                                <label for="ofc_rolvllsoi">ถนน ซอย</label>
                                <input type="text" class="form-control" name="ofc_rolvllsoi" id="ofc_rolvllsoi"
                                    placeholder="" value="<?=$rows["ofc_rolvllsoi"];?>">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="province2">จังหวัด</label>
                                <font id=province2>
                                    <?php echo "<script>dochange('province2','".$prv2."','adr2');</script>"; ?>
                                </font>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="district2">อำเภอ</label>
                                <font id=district2>
                                    <?php echo "<script>dochange('district2','".$amp2."','adr2');</script>"; ?>
                                </font>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="subdist2">ตำบล</label>
                                <font id=subdist2>
                                    <?php echo "<script>dochange('subdist2','".$tmb2."','adr2');</script>"; ?>
                                </font>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="vll2">หมู่บ้าน</label>
                                <font id=vll2>
                                    <?php echo "<script>dochange('vll2','".$vll2."','adr2');</script>"; ?>
                                </font>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่ปัจจุบัน </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="che_adr" name="che_adr">
                                    <label class="custom-control-label"
                                        for="che_adr">**คัดลอกจากที่อยู่ตามทะเบียนบ้าน</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ofc_adr">บ้านเลขที่</label>
                                <input type="text" class="form-control" name="ofc_adr" id="ofc_adr" placeholder=""
                                    value="<?=$rows["ofc_adr"];?>">
                            </div>
                            <div class="col-md-9 mb-3">
                                <label for="ofc_vllsoi">ถนน ซอย</label>
                                <input type="text" class="form-control" name="ofc_vllsoi" id="ofc_vllsoi" placeholder=""
                                    value="<?=$rows["ofc_vllsoi"];?>">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="province3">จังหวัด</label>
                                <font id=province3>
                                    <?php echo "<script>dochange('province3','".$prv3."','adr3');</script>"; ?>
                                </font>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="district3">อำเภอ</label>
                                <font id=district3>
                                    <?php echo "<script>dochange('district3','".$amp3."','adr3');</script>"; ?>
                                </font>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="subdist3">ตำบล</label>
                                <font id=subdist3>
                                    <?php echo "<script>dochange('subdist3','".$tmb3."','adr3');</script>"; ?>
                                </font>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="vll3">หมู่บ้าน</label>
                                <font id=vll3>
                                    <?php echo "<script>dochange('vll3','".$vll3."','adr3');</script>"; ?>
                                </font>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="ofc_tel">เบอร์โทรศัพท์ (มือถือ)</label>
                                <input type="text" class="form-control" name="ofc_tel" id="ofc_tel" placeholder=""
                                    value="<?=$rows["ofc_tel"];?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_fb">facebook</label>
                                <input type="text" class="form-control" name="ofc_fb" id="ofc_fb" placeholder=""
                                    value="<?=$rows["ofc_fb"];?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_line_id">ไอดี Line</label>
                                <input type="text" class="form-control" name="ofc_line_id" id="ofc_line_id"
                                    placeholder="" value="<?=$rows["ofc_line_id"];?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="ofc_email">อีเมล</label>
                                <input type="text" class="form-control" name="ofc_email" id="ofc_email" placeholder=""
                                    value="<?=$rows["ofc_email"];?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ส่วนที่ 2
                                    ประวัตการทำงาน</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="optid">ชื่อองค์กร/หน่วยงาน</label>
                                <select class="form-control" name="optid" id="optid">
                                    <?php
                                                $sql = "select optid,optnme from opt where optid = $optid  order by optid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                    <option class="text_form" value="<?=$row["optid"];?>"
                                        <?php if ($rows["optid"]==$row["optid"]) echo "selected";?>>
                                        <?=$row["optnme"];?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="ofc_pos">ตำแหน่งงานปัจจุบัน</label>
                                <input type="text" class="form-control" name="ofc_pos" id="ofc_pos" placeholder=""
                                    value="<?=$rows["ofc_pos"];?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="period">ระยะเวลาในการทำงาน</label>
                                <input type="text" class="form-control" name="period" id="period" placeholder=""
                                    value="<?=$rows["period"];?>">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="work_exp">ประสบการณ์การทำงานกับกลุ่มเปราะบางในพื้นที่</label>
                                <textarea class="form-control" name="work_exp" id="work_exp"
                                    rows="3"><?=$rows["work_exp"];?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="training_exp">ประสบการณ์การเข้าอบรมพัฒนาศักยภาพ</label>
                                <textarea class="form-control" name="training_exp" id="training_exp"
                                    rows="3"><?=$rows["training_exp"];?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="impression">ความประทับใจในการทำงานชุมชน</label>
                                <textarea class="form-control" name="impression" id="impression"
                                    rows="3"><?=$rows["impression"];?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="feedback">ข้อเสนอแนะ</label>
                                <textarea class="form-control" name="feedback" id="feedback"
                                    rows="3"><?=$rows["feedback"];?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- <button type="submit" class="mt-3 btn app-btn-primary"
                    onClick="if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) saveUser();">บันทึก</button> -->
                    <hr>
                    <button class="mt-3 btn app-btn-primary" type="button"
                        onClick="if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) saveEnrooll();">บันทึก</button>

                    <hr class="mb-4">
                </form>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->

<script language=Javascript>
function saveEnrooll() {
    var xmlhttp = Inint_AJAX();
    var Url = "./profile/hygienist_form_crud.php";
    // alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "ofc_no=" + document.frmProfile.ofc_no.value;
    POSTBody += "&ofc_preid=" + document.frmProfile.ofc_preid.value;
    POSTBody += "&ofc_fname=" + document.frmProfile.ofc_fname.value;
    POSTBody += "&ofc_lname=" + document.frmProfile.ofc_lname.value;
    POSTBody += "&ofc_nickname=" + document.frmProfile.ofc_nickname.value;
    POSTBody += "&ofc_pid=" + document.frmProfile.ofc_pid.value;

    POSTBody += "&ofc_brtdte=" + document.frmProfile.ofc_brtdte.value;
    POSTBody += "&ofc_age=" + document.frmProfile.ofc_age.value;
    POSTBody += "&ofc_reg=" + document.frmProfile.ofc_reg.value;
    POSTBody += "&ofc_edulev=" + document.frmProfile.ofc_edulev.value;
    POSTBody += "&ofc_graduated_sch=" + document.frmProfile.ofc_graduated_sch.value;
    POSTBody += "&ofc_stsmar=" + document.frmProfile.ofc_stsmar.value;
    POSTBody += "&ofc_numchi=" + document.frmProfile.ofc_numchi.value;

    POSTBody += "&ofc_roladr=" + document.frmProfile.ofc_roladr.value;
    POSTBody += "&ofc_rolvllsoi=" + document.frmProfile.ofc_rolvllsoi.value;
    POSTBody += "&ofc_rolprv=" + document.frmProfile.province2.value;
    POSTBody += "&ofc_rolamp=" + document.frmProfile.district2.value;
    POSTBody += "&ofc_roltmb=" + document.frmProfile.subdist2.value;
    POSTBody += "&ofc_rolvll=" + document.frmProfile.vll2.value;

    POSTBody += "&che_adr=" + document.frmProfile.che_adr.value;
    if (document.frmProfile.che_adr.checked) {
        var i1 = 1;
    } //else var i1=0;
    POSTBody += "&che_adr=" + i1;

    POSTBody += "&ofc_adr=" + document.frmProfile.ofc_adr.value;
    POSTBody += "&ofc_vllsoi=" + document.frmProfile.ofc_vllsoi.value;
    POSTBody += "&ofc_prv=" + document.frmProfile.province3.value;
    POSTBody += "&ofc_amp=" + document.frmProfile.district3.value;
    POSTBody += "&ofc_tmb=" + document.frmProfile.subdist3.value;
    POSTBody += "&ofc_vll=" + document.frmProfile.vll3.value;

    POSTBody += "&ofc_tel=" + document.frmProfile.ofc_tel.value;
    POSTBody += "&ofc_fb=" + document.frmProfile.ofc_fb.value;
    POSTBody += "&ofc_line_id=" + document.frmProfile.ofc_line_id.value;
    POSTBody += "&ofc_email=" + document.frmProfile.ofc_email.value;

    POSTBody += "&optid=" + document.frmProfile.optid.value;
    POSTBody += "&ofc_pos=" + document.frmProfile.ofc_pos.value;
    POSTBody += "&period=" + document.frmProfile.period.value;
    POSTBody += "&work_exp=" + document.frmProfile.work_exp.value;
    POSTBody += "&training_exp=" + document.frmProfile.training_exp.value;
    POSTBody += "&impression=" + document.frmProfile.impression.value;
    POSTBody += "&feedback=" + document.frmProfile.feedback.value;

    POSTBody += "&act=save";
    // alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            eval("var decoded_data = " + xmlhttp.responseText);
            if (decoded_data['checkSave'] == "yes") {
                window.document.frmProfile.ofc_no.value = decoded_data['ofc_no0'];
                // window.location.href = '?page=enrolls&function=update&id=' + decoded_data['enroll_id0'];
                alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            } else alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
        } //else alert(
        // 'ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ'
        //);
    }
};

function clearForm() {
    //window.document.frmProfile.reset();
    form.reset();
    location.reload();

};


function checkStuid(e1) {
    if (document.frmProfile.ofc_no.value.length == 0) {
        alert(e1);
        return false;
    }
    return true;

};

function checkPerid(e1) {
    if (document.frmUser.ofcid.value.length == 0) {
        alert(e1);
        return false;
    }
    return true;

};

//อัพโหลดรูปภาพ
function getFile() {
    a1 = document.getElementById('ofc_no').value;
    //alert(a1)
    if (a1 == '') {
        alert("ไม่สามารถเพิ่มรูปได้");
    } else document.getElementById('fileupload').click();

};

function saveFile() {
    a1 = document.getElementById('fileupload').value;
    alert(a1);
    if (a1 == "") {
        alert("กรุณาแนบรูปภาพก่อนครับ")
    } else {
        //document.frmProfile.submit();
        // document.getElementById ('frmProfile').submit ()
        document.createElement('frmProfile').submit;
    }
};

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("fileupload").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };

};

function clearDate() {
    window.document.frmProfile.ofc_brtdte.value = "";
    window.document.frmProfile.ofc_age.value = 0;
}

/** คำนวณอายุ อัตโนมัติ จากอายุวันเดือนปีเกิด */
function getAge() {
    let now = new Date();
    let today = new Date(now.getYear(), now.getMonth(), now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    let d = document.getElementById("testdate1").value;
    let dateOne = (d.substr(6, 4) - 543) + "-" + d.substr(3, 2) + "-" + d.substr(0, 2);
    let dob = new Date(dateOne);

    window.document.frmProfile.ofc_age.value = 0;

    // var dob = new Date(dateString.substring(6, 10),
    //     dateString.substring(0, 2) - 1,
    //     dateString.substring(3, 5)
    // );

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";


    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
        var monthAge = monthNow - monthDob;
    else {
        yearAge--;
        var monthAge = 12 + monthNow - monthDob;
    }

    if (dateNow >= dateDob)
        var dateAge = dateNow - dateDob;
    else {
        monthAge--;
        var dateAge = 31 + dateNow - dateDob;

        if (monthAge < 0) {
            monthAge = 11;
            yearAge--;
        }
    }

    age = {
        years: yearAge,
        months: monthAge,
        days: dateAge
    };

    if (age.years > 1) yearString = " years";
    else yearString = " year";
    if (age.months > 1) monthString = " months";
    else monthString = " month";
    if (age.days > 1) dayString = " days";
    else dayString = " day";


    if ((age.years > 0) && (age.months > 0) && (age.days > 0)) {
        // ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
        window.document.frmProfile.ofc_age.value = age.years;
    } else if ((age.years == 0) && (age.months == 0) && (age.days > 0))
        // ageString = "days " + age.days + dayString + " วัน";
        window.document.frmProfile.ofc_age.value = 0;
    else if ((age.years > 0) && (age.months == 0) && (age.days == 0))
        // ageString = age.years + yearString + " old. Happy Birthday!!";
        window.document.frmProfile.ofc_age.value = age.years;
    else if ((age.years > 0) && (age.months > 0) && (age.days == 0)) {
        // ageString = age.years + yearString + " and " + age.months + monthString + " old.";
        window.document.frmProfile.ofc_age.value = age.years;
    } else if ((age.years == 0) && (age.months > 0) && (age.days > 0)) {
        // ageString = age.months + monthString + " and " + age.days + dayString + " old.";
        window.document.frmProfile.ofc_age.value = 0;
    } else if ((age.years > 0) && (age.months == 0) && (age.days > 0)) {
        // ageString = age.years + yearString + " and " + age.days + dayString + " old.";
        window.document.frmProfile.ofc_age.value = age.years;
    } else if ((age.years == 0) && (age.months > 0) && (age.days == 0))
        // ageString = age.months + monthString + " old.";
        window.document.frmProfile.ofc_age.value = 0;
    else {
        // ageString = "คำนวณอายุไม่ได้!";
        window.document.frmProfile.ofc_age.value = 0;
    }


    // return ageString;
    // console.log(ageString);
}
</script>