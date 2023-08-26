<?php
    $perid   = $_GET["id"];
    if($perid){
        $sql = "select perid,pid,preid,nme,surnme,brtdte,age,sex,reg,nnt,race,stsmar,numchi,numchistd,edulev,currlevid,occid,sal,posit,";
        $sql.= "wrkplace,wrkvllno,wrkplcid,wrktel,roladr,rolvllsoi,rolvllno,rolplcid,adr,vllsoi,vllno,plcid,tel,congenital,percmm,";
        $sql.= "o1.ofcnme as savofc,p.savdte,o2.ofcnme as updofc,p.upddte";
        $sql.= " from person p";
        $sql.= " left join ofcusers o1 on o1.ofcid=p.savofc";
        $sql.= " left join ofcusers o2 on o2.ofcid=p.updofc";
        $sql.= " where perid=$perid";
        $result = mysqli_query($conn,$sql);
        //echo "sql1-> ".$sql;
        if($rows = mysqli_fetch_array($result)){
            $brtdte = getDateTimeDMY($rows["brtdte"]);
            //$brtday		= substr($rows["brtdte"],6,2);
            //$brtmon		= substr($rows["brtdte"],4,2);
            //$brtyear	= substr($rows["brtdte"],0,4);
            //$brtdte		= $brtday."-".$brtmon."-".$brtyear;
    
            $prv1		= substr($rows["wrkplcid"],0,2);
            $amp1		= substr($rows["wrkplcid"],0,4);
            $tmb1		= $rows["wrkplcid"];
            $vll1		= $rows["wrkplcid"].$rows["wrkvllno"];
    
            $prv2		= substr($rows["rolplcid"],0,2);
            $amp2		= substr($rows["rolplcid"],0,4);
            $tmb2		= $rows["rolplcid"];
            $vll2		= $rows["rolplcid"].$rows["rolvllno"];
    
            $prv3		= substr($rows["plcid"],0,2);
            $amp3		= substr($rows["plcid"],0,4);
            $tmb3		= $rows["plcid"];
            $vll3		= $rows["plcid"].$rows["vllno"];

            $savdte 	= substr($rows["savdte"],6,2)."-".substr($rows["savdte"],4,2)."-".substr($rows["savdte"],0,4);	
            $upddte 	= substr($rows["upddte"],6,2)."-".substr($rows["upddte"],4,2)."-".substr($rows["upddte"],0,4);
        }
     }

?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> แก้ไขข้อมูลผู้ปกครอง/ผู้ดูแลอุปการะเด็ก</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
<hr class="mb-0">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <!-- ?php print_r($_POST); ?> -->

                <div id="showSql"></div>
                <form name="frmPerson" id="frmPerson" method="post" action="" enctype="" onSubmit="" target="">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลพื้นฐาน </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="pid">เลขบัตรประชาชน</label>
                            <input type="text" class="form-control" name="pid" id="pid" maxlength="13" placeholder=""
                                value="<?=$rows["pid"];?>">
                            <!-- รหัสบุคคล -->
                            <input type="hidden" class="form-control" name="perid" id="perid" placeholder=""
                                value="<?=$rows["perid"];?>" readonly style="background-color:#CCCCCC">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nme">คำนำหน้าชื่อ*</label>
                            <div class="input-group">
                                <select class="form-control" name="preid" id="preid">
                                    <?php
                                        $sql = "select preid,prenme from constpre order by preid";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value="<?=$row["preid"];?>"
                                        <?php if ($rows["preid"]==$row["preid"]) echo "selected";?>>
                                        <?=$row["prenme"];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nme">ชื่อ*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nme" id="nme" placeholder="ชื่อ"
                                    value="<?=$rows["nme"];?>">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nme">นามสกุล*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="surnme" id="surnme" placeholder="นามสกุล"
                                    value="<?=$rows["surnme"];?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="brtdte">วันที่เกิด (วัน/เดือน/ปี)</label>
                            <input type="text" class="form-control" name="brtdte" id="testdate" placeholder=""
                                value="<?php echo $brtdte; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="age">อายุ (ปี)</label>
                            <input type="number" class="form-control" name="age" id="age" maxlength="3" min="0"
                                ,max="150" placeholder=""
                                <?php if ($rows["age"]) echo "value='".$rows["age"]."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-3 mt-3">
                            <label>เพศ</label><br>
                            <div class="form-group">
                                <!-- <label for="sex" class="col-form-label">เพศ : </label> -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="sex1" value="1"
                                        <?php if($rows["sex"]=="1") echo "checked";?> checked>
                                    <label class="form-check-label" for="sex1">ชาย</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="sex2" value="2"
                                        <?php if($rows["sex"]=="2") echo "checked";?>>
                                    <label class="form-check-label" for="sex2">หญิง</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="reg">ศาสนา</label>
                            <select class="form-control" name="reg" id="reg">
                                <?php
                                                $sql = "select * from constreg order by reg";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["reg"];?>"
                                    <?php if ($rows["reg"]==$row["reg"]) echo "selected";?>>
                                    <?=$row["regnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nnt">สัญชาติ</label>
                            <input type="text" class="form-control" name="nnt" id="nnt" placeholder=""
                                <?php if ($rows["nnt"]) echo "value='".$rows["nnt"]."'"; else echo "value='ไทย'"; ?>>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="race">เชื้อชาติ</label>
                            <input type="text" class="form-control" name="race" id="race" placeholder=""
                                <?php if ($rows["race"]) echo "value='".$rows["race"]."'"; else echo "value='ไทย'"; ?>>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="stsmar">สถานภาพ</label>
                            <select class="form-control" name="stsmar" id="stsmar">
                                <?php
                                                $sql = "select * from conststsmar order by stsmar";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["stsmar"];?>"
                                    <?php if ($rows["stsmar"]==$row["stsmar"]) echo "selected";?>>
                                    <?=$row["stsmarnme"];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="numchi">จำนวนบุตรที่มีชีวิตอยู่</label>
                            <input type="text" class="form-control" name="numchi" id="numchi" placeholder=""
                                value="<?=$rows["numchi"];?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="numchistd">จำนวนบุตรที่กำลังเรียนอยู่</label>
                            <input type="text" class="form-control" name="numchistd" id="numchistd" placeholder=""
                                value="<?=$rows["numchistd"];?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edulev">ระดับการศึกษาสูงสุด</label>
                            <select class="form-control" name="edulev" id="edulev">
                                <?php
                                                $sql = "select * from constedulev order by edulev";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["edulev"];?>"
                                    <?php if ($rows["edulev"]==$row["edulev"]) echo "selected";?>>
                                    <?=$row["edulevnme"];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="currlevid">ระดับชั้นการศึกษาปัจจุบัน</label>
                            <select class="form-control" name="currlevid" id="currlevid">
                                <?php
                                                $sql = "select * from constcurrlev order by currlevid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["currlevid"];?>"
                                    <?php if ($rows["currlevid"]==$row["currlevid"]) echo "selected";?>>
                                    <?=$row["currlevnme"];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="occid">อาชีพ</label>
                            <select class="form-control" name="occid" id="occid">
                                <?php
                                                $sql = "select * from constocc order by occid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["occid"];?>"
                                    <?php if ($rows["occid"]==$row["occid"]) echo "selected";?>>
                                    <?=$row["occnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="position">ตำแหน่ง</label>
                            <input type="text" class="form-control" name="position" id="position" placeholder=""
                                value="<?=$rows["posit"];?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sal">รายได้ต่อเดือน (บาท)</label>
                            <input type="text" class="form-control" name="sal" id="sal" placeholder=""
                                value="<?=$rows["sal"];?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="congenital">โรคประจำตัว</label>
                            <input type="text" class="form-control" name="congenital" id="congenital" placeholder=""
                                value="<?=$rows["congenital"];?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่สถานที่ทำงาน </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="wrkplace">สถานที่ทำงาน</label>
                            <input type="text" class="form-control" name="wrkplace" id="wrkplace" placeholder=""
                                value="<?=$rows["wrkplace"];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="province1">จังหวัด</label>
                            <font id=province1>
                                <?php echo "<script>dochange('province1','".$prv1."','adr1');</script>"; ?>
                            </font>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="district1">อำเภอ</label>
                            <font id=district1>
                                <?php echo "<script>dochange('district1','".$amp1."','adr1');</script>"; ?>
                            </font>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="subdist1">ตำบล</label>
                            <font id=subdist1>
                                <?php echo "<script>dochange('subdist1','".$tmb1."','adr1');</script>"; ?>
                            </font>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="vll1">หมู่บ้าน</label>
                            <font id=vll1>
                                <?php echo "<script>dochange('vll1','".$vll1."','adr1');</script>"; ?>
                            </font>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="wrktel">เบอร์โทรศัพท์สถานที่ทำงาน</label>
                            <input type="text" class="form-control" name="wrktel" id="wrktel" placeholder=""
                                value="<?=$rows["wrktel"];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ที่อยู่ตามสำเนาทะเบียนบ้าน </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="roladr">บ้านเลขที่</label>
                            <input type="text" class="form-control" name="roladr" id="roladr" placeholder=""
                                value="<?=$rows["roladr"];?>">
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="rolvllsoi">ถนน ตรอก ซอย</label>
                            <input type="text" class="form-control" name="rolvllsoi" id="rolvllsoi" placeholder=""
                                value="<?=$rows["rolvllsoi"];?>">
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
                                    for="che_adr">**กรณีที่อยู่ปัจจุบันเหมือนกับที่อยู่ตามทะเบียนบ้าน</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="adr">บ้านเลขที่</label>
                            <input type="text" class="form-control" name="adr" id="adr" placeholder=""
                                value="<?=$rows["adr"];?>">
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="vllsoi">ถนน ตรอก ซอย</label>
                            <input type="text" class="form-control" name="vllsoi" id="vllsoi" placeholder=""
                                value="<?=$rows["vllsoi"];?>">
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
                        <div class="col-md-6 mb-3">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="tel" id="tel" placeholder=""
                                value="<?=$rows["tel"];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="percmm">หมายเหตุ</label>
                            <textarea class="form-control" name="percmm" id="percmm"
                                rows="3"><?=$rows["percmm"];?></textarea>
                        </div>
                    </div>
                    <hr class="mb-2">
                    <div class="col-md-12 mb-3">
                        <!--button class="btn btn-success btn-lg btn-block" type="submit" onClick="if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) savePerson();">บันทึก</button-->
                        <!-- <button class="btn btn-success text-white" type="button"
                            onClick="if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) savePerson();">บันทึก</button> -->
                        <button class="btn btn-success text-white" type="button"
                            onClick="if(checkPerid('ระบุข้อมูลมีเครื่องหมาย (*)ก่อนค่ะ/ครับ')==true){ if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) savePerson()};">บันทึก</button>
                        <button class="btn btn-primary text-white" type="reset"
                            onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>
                        <!-- <button class="btn btn-danger text-white" type="button"
                            onClick="if(checkPerid('ระบุบุคคลที่ต้องการลบก่อนค่ะ/ครับ')==true){ if(confirm('ต้องการลบข้อมูลหรือไม่')==true) delPerson()};">ลบ</button> -->
                        <!-- <button class="btn btn-info text-white" type="submit"
                            onClick="if(confirm('ต้องการปิดหน้าจอหรือไม่')==true) window.close();">ปิดหน้าจอ</button> -->
                    </div>

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
                                value="<?=$savdte?>" readonly="true" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="updofc" id="updofc" placeholder=""
                                value="<?=$rows["updofc"];?>" readonly="true" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="upddte" id="upddte" placeholder=""
                                value="<?=$upddte?>" readonly="true" required>
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

<script language=Javascript>
//ฟังก์ชันบันทึกช้อมูลบุคคล
function savePerson() {

    var xmlhttp = Inint_AJAX();
    var Url = "./persons/person_form_crud.php";
    //alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "perid=" + document.frmPerson.perid.value;
    POSTBody += "&pid=" + document.frmPerson.pid.value;
    POSTBody += "&preid=" + document.frmPerson.preid.value;
    POSTBody += "&nme=" + document.frmPerson.nme.value;
    POSTBody += "&surnme=" + document.frmPerson.surnme.value;
    POSTBody += "&brtdte=" + document.frmPerson.brtdte.value;
    POSTBody += "&age=" + document.frmPerson.age.value;
    //POSTBody += "&brtday="+document.frmPerson.brtday.value;
    //POSTBody += "&brtmon="+document.frmPerson.brtmon.value;
    //POSTBody += "&brtyear="+document.frmPerson.brtyear.value;

    var e1 = document.frmPerson.sex;
    for (var i = 0; i < e1.length; i++) {
        if (e1[i].checked) {
            POSTBody += "&sex=" + e1[i].value;
        }
    }

    POSTBody += "&reg=" + document.frmPerson.reg.value;
    POSTBody += "&nnt=" + document.frmPerson.nnt.value;
    POSTBody += "&race=" + document.frmPerson.race.value;
    POSTBody += "&stsmar=" + document.frmPerson.stsmar.value;
    POSTBody += "&numchi=" + document.frmPerson.numchi.value;
    POSTBody += "&numchistd=" + document.frmPerson.numchistd.value;
    POSTBody += "&edulev=" + document.frmPerson.edulev.value;
    POSTBody += "&currlevid=" + document.frmPerson.currlevid.value;
    POSTBody += "&occid=" + document.frmPerson.occid.value;
    POSTBody += "&sal=" + document.frmPerson.sal.value;
    POSTBody += "&position=" + document.frmPerson.position.value;

    POSTBody += "&wrkplace=" + document.frmPerson.wrkplace.value;
    POSTBody += "&wrkprv=" + document.frmPerson.province1.value;
    POSTBody += "&wrkamp=" + document.frmPerson.district1.value;
    POSTBody += "&wrktmb=" + document.frmPerson.subdist1.value;
    POSTBody += "&wrkvll=" + document.frmPerson.vll1.value;
    POSTBody += "&wrktel=" + document.frmPerson.wrktel.value;

    POSTBody += "&roladr=" + document.frmPerson.roladr.value;
    POSTBody += "&rolvllsoi=" + document.frmPerson.rolvllsoi.value;
    POSTBody += "&rolprv=" + document.frmPerson.province2.value;
    POSTBody += "&rolamp=" + document.frmPerson.district2.value;
    POSTBody += "&roltmb=" + document.frmPerson.subdist2.value;
    POSTBody += "&rolvll=" + document.frmPerson.vll2.value;

    POSTBody += "&che_adr=" + document.frmPerson.che_adr.value;
    if (document.frmPerson.che_adr.checked) {
        var i1 = 1;
    } //else var i1=0;
    POSTBody += "&che_adr=" + i1;

    POSTBody += "&adr=" + document.frmPerson.adr.value;
    POSTBody += "&vllsoi=" + document.frmPerson.vllsoi.value;
    POSTBody += "&prv=" + document.frmPerson.province3.value;
    POSTBody += "&amp=" + document.frmPerson.district3.value;
    POSTBody += "&tmb=" + document.frmPerson.subdist3.value;
    POSTBody += "&vll=" + document.frmPerson.vll3.value;
    POSTBody += "&tel=" + document.frmPerson.tel.value;
    POSTBody += "&congenital=" + document.frmPerson.congenital.value;
    POSTBody += "&percmm=" + document.frmPerson.percmm.value;

    POSTBody += "&act=save";
    //alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            eval("var decoded_data = " + xmlhttp.responseText);
            if (decoded_data['checkSave'] == "yes") {
                window.document.frmPerson.perid.value = decoded_data['perid0'];
                window.document.frmPerson.perid.value = decoded_data['perid0'];
                window.document.frmPerson.savofc.value = decoded_data['savofc0'];
                window.document.frmPerson.savdte.value = decoded_data['savdte0'];
                window.document.frmPerson.updofc.value = decoded_data['updofc0'];
                window.document.frmPerson.upddte.value = decoded_data['upddte0'];
                // alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                Swal.fire({
                    text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                // window.history.replaceState(null, null, window.location.pathname);
                window.history.replaceState(null, null, window.location.href);

                //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            } else {
                Swal.fire({
                    text: 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลเลขบัตรประชาชนซ้ำอีกครั้งค่ะ/ครับ',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000
                })
                window.history.replaceState(null, null, window.location.href);
                //alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
            }

        } //else alert('ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ');
    }
};

function clearForm() {
    //window.document.frmPerson.reset();
    form.reset();
    location.reload();

};

function delPerson() {
    var xmlhttp = Inint_AJAX();
    var Url = "admin_person_crud.php";
    //alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "perid=" + document.frmPerson.perid.value;
    POSTBody += "&act=delete";
    //alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //eval("var decoded_data = "+xmlhttp.responseText);
            //window.document.frmPerson.perid.value = decoded_data['perid0'];
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            //clearForm();
            alert("ลบข้อมูลเรียบร้อยแล้ว");
            $("#frmPerson")[0].reset(); // reset form

        }
    }
};

function checkPerid(e1) {
    if (document.frmPerson.nme.value.length == '' && document.frmPerson.surnme.value.length == '') {
        alert(e1);
        return false;
    }
    return true;

};
</script>