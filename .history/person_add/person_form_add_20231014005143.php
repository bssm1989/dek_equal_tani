<?php
    $tempY=date("Y");
    $tempY=(int)$tempY+543;

    $perid   = $_GET["id"];
    if($perid){
        $sql = "SELECT p.perid,pid,preid,nme,surnme,brtdte,age,sex,reg,stsmar,numchi,numchistd,edulev,currlevid,
        blood_type,occid,add_occid,sal,roladr,rolvllsoi,rolvllno,rolplcid,tel,adr,vllsoi,vllno,plcid,
        lat,lon,house_conid,picname1,picname2,congenital_disease,congenital_disease_oth,
        medical_permis,medical_permis_oth,medical_permis_office,vaccination_id,num_covid,
        pertypid,elderly_grpid,distypid,hav_attendant,
        main_attendant_nme,main_attendant_surnme,main_attendant_brtdte,main_attendant_rel,
        main_attendant_occid,main_attendant_sal,main_attendant_tel,p.optid,alive,percmm,
        CONCAT(o1.`ofcnme`) AS recorded_by,p.recorded_date,CONCAT(o2.`ofcnme`) AS updofc,p.upddte 
        FROM person p LEFT JOIN person_qtn_additional a ON p.perid = a.perid
        LEFT JOIN ofc o1 ON o1.ofcid=p.recorded_by
        LEFT JOIN ofc o2 ON o2.ofcid=p.updofc";
        $sql.= " where p.perid=$perid";
        $result = mysqli_query($conn,$sql);
        // echo "sql1-> ".$sql;
        if($rows = mysqli_fetch_array($result)){
            $brtdte = getDateTimeDMY($rows["brtdte"]);
                                            
            $age_now    = $rows["age"];
            $numchi     = $rows["numchi"];
            $numchistd  = $rows["numchistd"];
            $sal        = $rows["sal"];
            $main_attendant_sal = $rows["main_attendant_sal"];
            //$brtday		= substr($rows["brtdte"],6,2);
            //$brtmon		= substr($rows["brtdte"],4,2);
            //$brtyear	= substr($rows["brtdte"],0,4);
            //$brtdte		= $brtday."-".$brtmon."-".$brtyear;

            /* รูปภาพบ้าน1 */
            $file_home1 = $rows["picname1"];
            if($file_home1){$picname1="./php/images/".$file_home1;}

             /* รูปภาพบ้าน2 */
            $file_home2 = $rows["picname2"];
            if($file_home2){$picname2="./php/images/".$file_home2;}
            //else{$picname2="./php/images/add-user.png";}
            // echo "xxxxx =".$picname1;

            $disease = explode(",", $rows["congenital_disease"]);  
            $congenital_disease1 = $disease[0];
            $congenital_disease2 = $disease[1];
            $congenital_disease3 = $disease[2];
            $congenital_disease4 = $disease[3];
            $congenital_disease5 = $disease[4];
            $congenital_disease6 = $disease[5];
            $congenital_disease7 = $disease[6];
            $congenital_disease8 = $disease[7];
            $congenital_disease9 = $disease[8];
            $congenital_disease10 = $disease[9];
            $congenital_disease11 = $disease[10];
            $congenital_disease12 = $disease[11];

            $permis = explode(",", $rows["medical_permis"]);  
            $medical_permis1 = $permis[0];
            $medical_permis2 = $permis[1];
            $medical_permis3 = $permis[2];
            $medical_permis4 = $permis[3];
            $medical_permis5 = $permis[4];
            $medical_permis6 = $permis[5];
                       
                
            $prv2		= substr($rows["rolplcid"],0,2);
            $amp2		= substr($rows["rolplcid"],0,4);
            $tmb2		= $rows["rolplcid"];
            $vll2		= $rows["rolplcid"].$rows["rolvllno"]; 
            
            $prv3		= substr($rows["plcid"],0,2);
            $amp3		= substr($rows["plcid"],0,4);
            $tmb3		= $rows["plcid"];
            $vll3		= $rows["plcid"].$rows["vllno"];   
            
            $recorded_date 	= substr($rows["recorded_date"],8,2)."-".substr($rows["recorded_date"],5,2)."-".substr($rows["recorded_date"],0,4);	
            $upddte 	= substr($rows["upddte"],8,2)."-".substr($rows["upddte"],5,2)."-".substr($rows["upddte"],0,4);
        }
     }

?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> เพิ่มข้อมูลกลุ่มเปราะบาง</h4>
    </div>
    <div class="col-auto">
        <!-- <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a> -->
    </div>
</div>
<hr class="mb-0">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <!-- ?php print_r($_POST); ?> -->

                <div id="showSql"></div>
                <form name="frmPerson" id="frmPerson" method="post" action="./persons/perupfile_home.php"
                    enctype="multipart/form-data" onSubmit="" target="">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลพื้นฐาน </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="pid">เลขบัตรประชาชน</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="pid" id="pid" maxlength="13"
                                    placeholder="" value="<?=$rows["pid"];?>">
                                <button class="btn btn-success" type="button" id="button-addon2"
                                    onClick="popitup('./person_add/person_form_search.php?pid='+window.document.frmPerson.pid.value+'&perid='+window.document.frmPerson.perid.value,'winselect','height=600,width=800');">
                                    <i class="fas fa-search"></i></button>
                                <!-- รหัสบุคคล -->
                                <input type="hidden" class="form-control" name="perid" id="perid" placeholder=""
                                    value="<?=$rows["perid"];?>" readonly style="background-color:#CCCCCC">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="preid">คำนำหน้าชื่อ*</label>
                            <div class="input-group">
                                <select class="form-control" name="preid" id="preid">
                                    <?php
                                        $sql = "select preid,prenme from const_prenme order by preid";
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
                            <label for="surnme">นามสกุล*</label>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="surnme" id="surnme"
                                        placeholder="นามสกุล" value="<?=$rows["surnme"];?>">

                                    <button class="btn btn-success" type="button" id="button-addon2"
                                        onClick="popitup('./person_add/person_form_search.php?nme='+window.document.frmPerson.nme.value+'&surnme='+window.document.frmPerson.surnme.value+'&perid='+window.document.frmPerson.perid.value,'winselect','height=600,width=800');">
                                        <i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="brtdte">วันที่เกิด (วัน/เดือน/ปี)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="brtdte" id="testdate" placeholder=""
                                    value="<?php echo $brtdte; ?>" onchange="getAge()">
                                <button class="btn btn-success" type="button" id="button-addon2" onClick="clearDate()">
                                    <i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="age">อายุ (ปี)</label>
                            <input type="number" class="form-control" name="age" id="age" maxlength="3" min="0"
                                ,max="150" placeholder=""
                                <?php if ($age_now) echo "value='".$age_now."'"; else echo "value='0'"; ?>>
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
                                    $sql = "select regid,regnme from const_reg order by regid";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                <option value="<?=$row["regid"];?>"
                                    <?php if ($rows["reg"]==$row["regid"]) echo "selected";?>>
                                    <?=$row["regnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="stsmar">สถานภาพ</label>
                            <select class="form-control" name="stsmar" id="stsmar">
                                <?php
                                                $sql = "select * from const_stsmar order by stsmar";
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

                        <div class="col-md-3 mb-3">
                            <label for="numchi">จำนวนบุตรที่มีชีวิตอยู่</label>
                            <input type="number" class="form-control" name="numchi" id="numchi" maxlength="3" min="0"
                                ,max="150" placeholder=""
                                <?php if ($numchi) echo "value='".$numchi."'"; else echo "value='0'"; ?>>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="numchistd">จำนวนบุตรที่กำลังเรียนอยู่</label>
                            <input type="number" class="form-control" name="numchistd" id="numchistd" maxlength="3"
                                min="0" ,max="150" placeholder=""
                                <?php if ($numchistd) echo "value='".$numchistd."'"; else echo "value='0'"; ?>>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="edulev">ระดับการศึกษาสูงสุด</label>
                            <select class="form-control" name="edulev" id="edulev">
                                <?php
                                                $sql = "select edulevid,edulevnme from const_edulev order by edulevid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["edulevid"];?>"
                                    <?php if ($rows["edulev"]==$row["edulevid"]) echo "selected";?>>
                                    <?=$row["edulevnme"];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="currlevid">ระดับชั้นการศึกษาปัจจุบัน</label>
                            <select class="form-control" name="currlevid" id="currlevid">
                                <?php
                                                $sql = "select currlevid,currlevnme from const_currlev order by currlevid";
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
                        <div class="col-md-3 mb-3">
                            <label for="blood_type">กรุ๊ปเลือด</label>
                            <input type="text" class="form-control" name="blood_type" id="blood_type" placeholder=""
                                value="<?=$rows["blood_type"];?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="occid">อาชีพ</label>
                            <select class="form-control" name="occid" id="occid">
                                <?php
                                                $sql = "select occid,occnme from const_occ order by occid";
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
                            <label for="add_occid">อาชีพเสริม (ถ้ามี)</label>
                            <input type="text" class="form-control" name="add_occid" id="add_occid" placeholder=""
                                value="<?=$rows["add_occid"];?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sal">รายได้ต่อเดือน (บาท)</label>
                            <input type="text" class="form-control" name="sal" id="sal" placeholder=""
                                <?php if ($sal) echo "value='".$sal."'"; else echo "value='0'"; ?>>
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
                                    for="che_adr">**คัดลอกจากที่อยู่ตามทะเบียนบ้าน</label>
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
                            <label for="vllsoi">ถนน ซอย</label>
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
                        <div class="col-md-3 mb-3">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="tel" id="tel" placeholder=""
                                value="<?=$rows["tel"];?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลเชิงพื้นที่ </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="lat">พิกัดบ้าน ละติจูด</label>
                            <input type="text" class="form-control" name="lat" id="lat" placeholder=""
                                <?php if ($rows["lat"]) echo "value='".$rows["lat"]."'"; else echo "value='0'"; ?>>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="lon">พิกัดบ้าน ลองจิจูด</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="lon" id="lon" placeholder=""
                                    <?php if ($rows["lon"]) echo "value='".$rows["lon"]."'"; else echo "value='0'"; ?>>
                                <button class="btn btn-primary text-white" type="button"
                                    onClick="if(confirm('ต้องการกำหนดพิกัดจริงหรือไม่')==true) getLocation();"><i class="fas fa-map-marker-alt"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="house_conid">สภาพบ้าน</label>
                            <select class="form-control" name="house_conid" id="house_conid">
                                <?php
                                                $sql = "select house_conid,house_connme from const_house_conditions order by house_conid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["house_conid"];?>"
                                    <?php if ($rows["house_conid"]==$row["house_conid"]) echo "selected";?>>
                                    <?=$row["house_connme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="fileupload">รูปภาพบ้าน</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="fileupload" name="fileupload"
                                    accept="image/x-png,image/gif,image/jpeg,image/jpg" onchange="readURL1(this)">
                                <div id="imgControl1" class="d-none">
                                    <img id="imgUpload1" class="img-fluid my-3">
                                    <div class="d-grid">
                                        <button class="btn btn-primary" name="submit"
                                            onClick="saveFile()">อัปโหลด</button>
                                    </div>
                                </div>
                                <div class="imgControl1">
                                    <img id="imgUpload1" class="img-fluid my-3" src="<?php echo $picname1 ?>">
                                    <div class="d-grid">
                                        <?php if($file_home1) echo "<a href=\"./persons/perdelfile_home.php?perid=".$perid."&picname1=".$picname1."\" >ลบ</a>"; ?>
                                    </div>
                                </div>

                                <!-- <button type="submit" class="btn app-btn-secondary"><i class="fas fa-search"></i> อัปโหลด
                                </button> -->
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="fileupload2">รูปภาพบ้าน</label>
                            <div class="input-group mb-3">
                                <!-- <input type="file" class="form-control" name="picname2" id="picname2" placeholder=""
                                    value="<?=$rows["picname2"];?>"> -->
                                <input type="file" class="form-control" id="fileupload2" name="fileupload2"
                                    accept="image/x-png,image/gif,image/jpeg,image/jpg" onchange="readURL2(this)">
                                <div id="imgControl2" class="d-none">
                                    <img id="imgUpload2" class="img-fluid my-3">
                                    <div class="d-grid">
                                        <button class="btn btn-primary" name="submit"
                                            onClick="saveFile2()">อัปโหลด</button>
                                    </div>
                                </div>
                                <div class="imgControl2">
                                    <img id="imgUpload2" class="img-fluid my-3" src="<?php echo $picname2 ?>">
                                    <div class="d-grid">
                                        <?php if($file_home2) echo "<a href=\"./persons/perdelfile_home.php?perid=".$perid."&picname2=".$picname2."\" >ลบ</a>"; ?>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลด้านสุขภาพ </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <label>ท่านมีโรคประจำตัวหรือปัญหาสุขภาพหรือไม่ : </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease1" name="congenital_disease1" value="1"
                                    <?php if($congenital_disease1 =="1") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease1">1.ความดันโลหิตสูง </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease2" name="congenital_disease2" value="2"
                                    <?php if($congenital_disease2 =="2") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease2">2.เบาหวาน</label>
                            </div>

                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease3" name="congenital_disease3" value="3"
                                    <?php if($congenital_disease3 =="3") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease3">3.โรคหัวใจ</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease4" name="congenital_disease4" value="4"
                                    <?php if($congenital_disease4 =="4") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease4">4.อัมพฤกษ์/อัมพาต</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease5" name="congenital_disease5" value="5"
                                    <?php if($congenital_disease5 =="5") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease5">5.โรคปอด/หอบหืด</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease6" name="congenital_disease6" value="6"
                                    <?php if($congenital_disease6 =="6") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease6">6.โรคมะเร็ง</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease7" name="congenital_disease7" value="7"
                                    <?php if($congenital_disease7 =="7") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease7">7.เก๊าท์/ข้อเสื่อม</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease8" name="congenital_disease8" value="8"
                                    <?php if($congenital_disease8 =="8") echo "checked";?>>
                                <label class="custom-control-label"
                                    for="congenital_disease8">8.อัลไซเมอร์/สมองเสื่อม</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease9" name="congenital_disease9" value="9"
                                    <?php if($congenital_disease9 =="9") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease9">9.มีอาการทางจิตเวช</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease10" name="congenital_disease10" value="10"
                                    <?php if($congenital_disease10 =="10") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease10">10.โรคอ้วน</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease11" name="congenital_disease11" value="11"
                                    <?php if($congenital_disease11 =="11") echo "checked";?>>
                                <label class="custom-control-label"
                                    for="congenital_disease11">11.โรคสมองและหลอดเลือด</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="congenital_disease12" name="congenital_disease12" value="12"
                                    <?php if($congenital_disease12 =="12") echo "checked";?>>
                                <label class="custom-control-label" for="congenital_disease12">12.อื่นๆ ระบุ</label>
                                <input type="text" class="form-control" name="congenital_disease_oth"
                                    id="congenital_disease_oth" placeholder=""
                                    value="<?=$rows["congenital_disease_oth"];?>">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <label>สิทธิการรักษาพยาบาล </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="medical_permis1" name="medical_permis1" value="1"
                                    <?php if($medical_permis1 =="1") echo "checked";?>>
                                <label class="custom-control-label" for="medical_permis1">1.บัตรทอง </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="medical_permis2" name="medical_permis2" value="2"
                                    <?php if($medical_permis2 =="2") echo "checked";?>>
                                <label class="custom-control-label" for="medical_permis2">2.ประกันชีวิต</label>
                            </div>

                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="medical_permis3" name="medical_permis3" value="3"
                                    <?php if($medical_permis3 =="3") echo "checked";?>>
                                <label class="custom-control-label" for="medical_permis3">3.ประกันสังคม</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="medical_permis4" name="medical_permis4" value="4"
                                    <?php if($medical_permis4 =="4") echo "checked";?>>
                                <label class="custom-control-label" for="medical_permis4">4.เบิกต้นสังกัด</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="medical_permis5" name="medical_permis5" value="5"
                                    <?php if($medical_permis5 =="5") echo "checked";?>>
                                <label class="custom-control-label" for="medical_permis5">5.จ่ายเอง</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="medical_permis6" name="medical_permis6" value="6"
                                    <?php if($medical_permis6 =="6") echo "checked";?>>
                                <label class="custom-control-label" for="medical_permis6">6.อื่นๆ ระบุ</label>
                                <input type="text" class="form-control" name="medical_permis_oth"
                                    id="medical_permis_oth" placeholder="" value="<?=$rows["medical_permis_oth"];?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="medical_permis_office">สถานที่รักษา</label>
                            <input type="text" class="form-control" name="medical_permis_office"
                                id="medical_permis_office" placeholder="" value="<?=$rows["medical_permis_office"];?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="vaccination_id">การรับวัคซีน</label>
                            <select class="form-control" name="vaccination_id" id="vaccination_id">
                                <?php
                                                $sql = "select vaccination_id,vaccination_nme from const_vaccination order by vaccination_id";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["vaccination_id"];?>"
                                    <?php if ($rows["vaccination_id"]==$row["vaccination_id"]) echo "selected";?>>
                                    <?=$row["vaccination_nme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="num_covid">ท่านเคยติดโรคโควิด (COVID-19) กี่ครั้ง</label>
                            <input type="text" class="form-control" name="num_covid" id="num_covid" placeholder=""
                                value="<?=$rows["num_covid"];?>">
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลกลุ่มเปราะบาง </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="pertypid">ประเภทกลุ่มเปราะบาง</label>
                            <select class="form-control" name="pertypid" id="pertypid">
                                <?php
                                                $sql = "select pertypid,pertypnme from const_pertyp order by pertypid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["pertypid"];?>"
                                    <?php if ($rows["pertypid"]==$row["pertypid"]) echo "selected";?>>
                                    <?=$row["pertypnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="elderly_grpid">ผู้สูงอายุจัดอยู่ในกลุ่ม</label>
                            <select class="form-control" name="elderly_grpid" id="elderly_grpid">
                                <?php
                                                $sql = "select elderly_grpid,elderly_grpnme from const_elderly_grp order by elderly_grpid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["elderly_grpid"];?>"
                                    <?php if ($rows["elderly_grpid"]==$row["elderly_grpid"]) echo "selected";?>>
                                    <?=$row["elderly_grpnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="distypid">ประเภทความพิการและลักษณะความพิการ
                                (ที่ระบุในบัตรประจำตัวคนพิการ)</label>
                            <select class="form-control" name="distypid" id="distypid">
                                <?php
                                                $sql = "select distypid,distypnme from const_disability_type order by distypid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["distypid"];?>"
                                    <?php if ($rows["distypid"]==$row["distypid"]) echo "selected";?>>
                                    <?=$row["distypnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลผู้ดูแล </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <label>ท่านมีผู้ดูแลหรือไม่ </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input id="hav_attendant1" name="hav_attendant" type="radio"
                                    class="custom-control-input" value="1"
                                    <?php if($rows["hav_attendant"]=="1") echo "checked";?> checked>
                                <label class="custom-control-label" for="hav_attendant1">ไม่มีผู้ดูแล </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-3">
                            <div class="form-check">
                                <input id="hav_attendant2" name="hav_attendant" type="radio"
                                    class="custom-control-input" value="2"
                                    <?php if($rows["hav_attendant"]=="2") echo "checked";?>>
                                <label class="custom-control-label"
                                    for="hav_attendant2">มีผู้ดูแล-สมาชิกครอบครัว</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 mb-3">
                            <div class="form-check">
                                <input id="hav_attendant3" name="hav_attendant" type="radio"
                                    class="custom-control-input" value="3"
                                    <?php if($rows["hav_attendant"]=="3") echo "checked";?>>
                                <label class="custom-control-label"
                                    for="hav_attendant3">มีผู้ดูแล-จ้างคนนอกครอบครัวมาดูแล</label>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_nme">ชื่อผู้ดูแลหลัก</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="main_attendant_nme"
                                    id="main_attendant_nme" placeholder="ชื่อ"
                                    value="<?=$rows["main_attendant_nme"];?>">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_surnme">ชื่อสกุลผู้ดูแลหลัก</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="main_attendant_surnme"
                                    id="main_attendant_surnme" placeholder="นามสกุล"
                                    value="<?=$rows["main_attendant_surnme"];?>">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_brtdte">วันเดือนปีเกิดผู้ดูแลหลัก</label>
                            <input type="text" class="form-control" name="main_attendant_brtdte" id="testdate1"
                                placeholder="" value="<?php echo $main_attendant_brtdte; ?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_rel">ความสัมพันธ์ เกี่ยวข้องกับกลุ่มเปราะบาง</label>
                            <select class="form-control" name="main_attendant_rel" id="main_attendant_rel">
                                <?php
                                    $sql = "select reltypid,reltypnme from const_reltyp order by reltypid";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?=$row["reltypid"];?>"
                                    <?php if ($rows["main_attendant_rel"]==$row["reltypid"]) echo "selected";?>>
                                    <?=$row["reltypnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_occid">อาชีพ</label>
                            <select class="form-control" name="main_attendant_occid" id="main_attendant_occid">
                                <?php
                                                $sql = "select * from const_occ order by occid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["occid"];?>"
                                    <?php if ($rows["main_attendant_occid"]==$row["occid"]) echo "selected";?>>
                                    <?=$row["occnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_sal">รายได้ต่อเดือน (บาท) ผู้ดูแล</label>
                            <input type="text" class="form-control" name="main_attendant_sal" id="main_attendant_sal"
                                placeholder=""
                                <?php if ($main_attendant_sal) echo "value='".$main_attendant_sal."'"; else echo "value='0'"; ?>>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="main_attendant_tel">โทรศัพท์</label>
                            <input type="text" class="form-control" name="main_attendant_tel" id="main_attendant_tel"
                                placeholder="" value="<?=$rows["main_attendant_tel"];?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลอื่นๆ </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="optid">แหล่งข้อมูล สังกัด อปท.</label>
                            <select class="form-control" name="optid" id="optid">
                                <?php
                                                $sql = "select optid,optnme from opt order by optid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option class="text_form" value="<?=$row["optid"];?>"
                                    <?php if ($rows["optid"]==$row["optid"]) echo "selected";?>>
                                    <?=$row["optnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <label>สถานภาพการมีชีวิต ของกลุ่มเปราะบาง </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-2 mb-3">
                            <div class="form-check">
                                <input id="alive_0" name="alive" type="radio" class="custom-control-input" value="0"
                                    <?php if($rows["alive"]=="0") echo "checked";?> checked>
                                <label class="custom-control-label" for="alive_0">ระบุไม่ได้ </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2 mb-3">
                            <div class="form-check">
                                <input id="alive_1" name="alive" type="radio" class="custom-control-input" value="1"
                                    <?php if($rows["alive"]=="1") echo "checked";?>>
                                <label class="custom-control-label" for="alive_1">มีชีวิตอยู่</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2 mb-3">
                            <div class="form-check">
                                <input id="alive_2" name="alive" type="radio" class="custom-control-input" value="2"
                                    <?php if($rows["alive"]=="2") echo "checked";?>>
                                <label class="custom-control-label" for="alive_2">เสียชีวิตแล้ว</label>
                            </div>
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
                            <label for="recorded_by">ผู้บันทึก</label>
                            <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder=""
                                value="<?=$rows["recorded_by"];?>" readonly="true" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="recorded_date">วันที่บันทึก</label>
                            <input type="text" class="form-control" name="recorded_date" id="recorded_date" placeholder=""
                                value="<?=$recorded_date?>" readonly="true" required>
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
    // alert("xxxxxxxxxxx");
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
    POSTBody += "&stsmar=" + document.frmPerson.stsmar.value;
    POSTBody += "&numchi=" + document.frmPerson.numchi.value;
    POSTBody += "&numchistd=" + document.frmPerson.numchistd.value;
    POSTBody += "&edulev=" + document.frmPerson.edulev.value;
    POSTBody += "&currlevid=" + document.frmPerson.currlevid.value;
    POSTBody += "&blood_type=" + document.frmPerson.blood_type.value;
    POSTBody += "&occid=" + document.frmPerson.occid.value;
    POSTBody += "&add_occid=" + document.frmPerson.add_occid.value;
    POSTBody += "&sal=" + document.frmPerson.sal.value;

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

    POSTBody += "&lat=" + document.frmPerson.lat.value;
    POSTBody += "&lon=" + document.frmPerson.lon.value;
    POSTBody += "&house_conid=" + document.frmPerson.house_conid.value;

    //POSTBody += "&che_adr=" + document.frmPerson.che_adr.value;
    // if (document.frmPerson.che_adr.checked) {
    //     var i1 = 1;
    // } else var i1=0;
    // POSTBody += "&che_adr=" + i1;

    if (document.frmPerson.congenital_disease1.checked) {
        var i1 = 1;
    } else var i1 = 0;
    POSTBody += "&congenital_disease1=" + i1;

    if (document.frmPerson.congenital_disease2.checked) {
        var i1 = 2;
    } else var i1 = 0;
    POSTBody += "&congenital_disease2=" + i1;

    if (document.frmPerson.congenital_disease3.checked) {
        var i1 = 3;
    } else var i1 = 0;
    POSTBody += "&congenital_disease3=" + i1;

    if (document.frmPerson.congenital_disease4.checked) {
        var i1 = 4;
    } else var i1 = 0;
    POSTBody += "&congenital_disease4=" + i1;

    if (document.frmPerson.congenital_disease5.checked) {
        var i1 = 5;
    } else var i1 = 0;
    POSTBody += "&congenital_disease5=" + i1;

    if (document.frmPerson.congenital_disease6.checked) {
        var i1 = 6;
    } else var i1 = 0;
    POSTBody += "&congenital_disease6=" + i1;

    if (document.frmPerson.congenital_disease7.checked) {
        var i1 = 7;
    } else var i1 = 0;
    POSTBody += "&congenital_disease7=" + i1;

    if (document.frmPerson.congenital_disease8.checked) {
        var i1 = 8;
    } else var i1 = 0;
    POSTBody += "&congenital_disease8=" + i1;

    if (document.frmPerson.congenital_disease9.checked) {
        var i1 = 9;
    } else var i1 = 0;
    POSTBody += "&congenital_disease9=" + i1;

    if (document.frmPerson.congenital_disease10.checked) {
        var i1 = 10;
    } else var i1 = 0;
    POSTBody += "&congenital_disease10=" + i1;

    if (document.frmPerson.congenital_disease11.checked) {
        var i1 = 11;
    } else var i1 = 0;
    POSTBody += "&congenital_disease11=" + i1;

    if (document.frmPerson.congenital_disease12.checked) {
        var i1 = 12;
    } else var i1 = 0;
    POSTBody += "&congenital_disease12=" + i1;

    POSTBody += "&congenital_disease_oth=" + document.frmPerson.congenital_disease_oth.value;

    if (document.frmPerson.medical_permis1.checked) {
        var i1 = 1;
    } else var i1 = 0;
    POSTBody += "&medical_permis1=" + i1;

    if (document.frmPerson.medical_permis2.checked) {
        var i1 = 2;
    } else var i1 = 0;
    POSTBody += "&medical_permis2=" + i1;

    if (document.frmPerson.medical_permis3.checked) {
        var i1 = 3;
    } else var i1 = 0;
    POSTBody += "&medical_permis3=" + i1;

    if (document.frmPerson.medical_permis4.checked) {
        var i1 = 4;
    } else var i1 = 0;
    POSTBody += "&medical_permis4=" + i1;

    if (document.frmPerson.medical_permis5.checked) {
        var i1 = 5;
    } else var i1 = 0;
    POSTBody += "&medical_permis5=" + i1;

    if (document.frmPerson.medical_permis6.checked) {
        var i1 = 6;
    } else var i1 = 0;
    POSTBody += "&medical_permis6=" + i1;

    POSTBody += "&medical_permis_oth=" + document.frmPerson.medical_permis_oth.value;
    POSTBody += "&medical_permis_office=" + document.frmPerson.medical_permis_office.value;
    POSTBody += "&vaccination_id=" + document.frmPerson.vaccination_id.value;
    POSTBody += "&num_covid=" + document.frmPerson.num_covid.value;
    POSTBody += "&pertypid=" + document.frmPerson.pertypid.value;
    POSTBody += "&elderly_grpid=" + document.frmPerson.elderly_grpid.value;
    POSTBody += "&distypid=" + document.frmPerson.distypid.value;

    var e2 = document.frmPerson.hav_attendant;
    for (var i = 0; i < e2.length; i++) {
        if (e2[i].checked) {
            POSTBody += "&hav_attendant=" + e2[i].value;
        }
    }

    POSTBody += "&main_attendant_nme=" + document.frmPerson.main_attendant_nme.value;
    POSTBody += "&main_attendant_surnme=" + document.frmPerson.main_attendant_surnme.value;
    POSTBody += "&main_attendant_brtdte=" + document.frmPerson.main_attendant_brtdte.value;
    POSTBody += "&main_attendant_rel=" + document.frmPerson.main_attendant_rel.value;
    POSTBody += "&main_attendant_occid=" + document.frmPerson.main_attendant_occid.value;
    POSTBody += "&main_attendant_sal=" + document.frmPerson.main_attendant_sal.value;
    POSTBody += "&main_attendant_tel=" + document.frmPerson.main_attendant_tel.value;

    POSTBody += "&optid=" + document.frmPerson.optid.value;

    var e3 = document.frmPerson.alive;
    for (var i = 0; i < e3.length; i++) {
        if (e3[i].checked) {
            POSTBody += "&alive=" + e3[i].value;
        }
    }

    POSTBody += "&percmm=" + document.frmPerson.percmm.value;

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
                window.document.frmPerson.perid.value = decoded_data['perid0'];
                window.document.frmPerson.recorded_by.value = decoded_data['recorded_by0'];
                window.document.frmPerson.recorded_date.value = decoded_data['recorded_date0'];
                window.document.frmPerson.updofc.value = decoded_data['updofc0'];
                window.document.frmPerson.upddte.value = decoded_data['upddte0'];
                window.location.href = '?page=persons&function=add&id=' + decoded_data['perid0'];
                alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                // Swal.fire({
                //     text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                //     icon: 'success',
                //     showConfirmButton: false,
                //     timer: 2000
                // })
                // window.history.replaceState(null, null, window.location.pathname)


                // window.document.getElementById('showSql').innerHTML = xmlhttp.responseText;
            } else if (decoded_data['checkSave'] == "no") {
                window.document.frmPerson.perid.value = decoded_data['perid0'];
                // window.document.frmPerson.recorded_by.value = decoded_data['recorded_by0'];
                // window.document.frmPerson.recorded_date.value = decoded_data['recorded_date0'];
                // window.document.frmPerson.updofc.value = decoded_data['updofc0'];
                // window.document.frmPerson.upddte.value = decoded_data['upddte0'];
                //window.location.href = '?page=persons&function=add&id=' + decoded_data['perid0'];
                alert("ไม่สามารถบันทึกข้อมูลได้");
                // Swal.fire({
                //     text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                //     icon: 'success',
                //     showConfirmButton: false,
                //     timer: 2000
                // })
                // window.history.replaceState(null, null, window.location.pathname)


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

function readURL1(input) {
    if (input.files[0]) {
        let reader = new FileReader();
        document.querySelector('#imgControl1').classList.replace("d-none", "d-block");
        reader.onload = function(e) {
            let element = document.querySelector('#imgUpload1');
            element.setAttribute("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    }
}

function readURL2(input) {
    if (input.files[0]) {
        let reader = new FileReader();
        document.querySelector('#imgControl2').classList.replace("d-none", "d-block");
        reader.onload = function(e) {
            let element = document.querySelector('#imgUpload2');
            element.setAttribute("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


function saveFile() {
    a1 = document.getElementById('fileupload').value;
    //alert(a1);
    if (a1 == "") {
        alert("กรุณาแนบรูปภาพก่อนครับ")
    } else {
        //document.frmPerson.submit();
        // document.getElementById ('frmPerson').submit ()
        document.createElement('frmPerson').submit;
    }
};

function saveFile2() {
    a1 = document.getElementById('fileupload2').value;
    //alert(a1);
    if (a1 == "") {
        alert("กรุณาแนบรูปภาพก่อนครับ")
    } else {
        //document.frmPerson.submit();
        // document.getElementById ('frmPerson').submit ()
        document.createElement('frmPerson').submit;
    }
};

function clearDate() {
    window.document.frmPerson.brtdte.value = "";
    window.document.frmPerson.age.value = 0;
}

/** คำนวณอายุ อัตโนมัติ จากอายุวันเดือนปีเกิด */
function getAge() {
    let now = new Date();
    let today = new Date(now.getYear(), now.getMonth(), now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    let d = document.getElementById("testdate").value;
    let dateOne = (d.substr(6, 4) - 543) + "-" + d.substr(3, 2) + "-" + d.substr(0, 2);
    let dob = new Date(dateOne);

    window.document.frmPerson.age.value = 0;

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
        window.document.frmPerson.age.value = age.years;
    } else if ((age.years == 0) && (age.months == 0) && (age.days > 0))
        // ageString = "days " + age.days + dayString + " วัน";
        window.document.frmPerson.age.value = 0;
    else if ((age.years > 0) && (age.months == 0) && (age.days == 0))
        // ageString = age.years + yearString + " old. Happy Birthday!!";
        window.document.frmPerson.age.value = age.years;
    else if ((age.years > 0) && (age.months > 0) && (age.days == 0)) {
        // ageString = age.years + yearString + " and " + age.months + monthString + " old.";
        window.document.frmPerson.age.value = age.years;
    } else if ((age.years == 0) && (age.months > 0) && (age.days > 0)) {
        // ageString = age.months + monthString + " and " + age.days + dayString + " old.";
        window.document.frmPerson.age.value = 0;
    } else if ((age.years > 0) && (age.months == 0) && (age.days > 0)) {
        // ageString = age.years + yearString + " and " + age.days + dayString + " old.";
        window.document.frmPerson.age.value = age.years;
    } else if ((age.years == 0) && (age.months > 0) && (age.days == 0))
        // ageString = age.months + monthString + " old.";
        window.document.frmPerson.age.value = 0;
    else {
        // ageString = "คำนวณอายุไม่ได้!";
        window.document.frmPerson.age.value = 0;
    }


    // return ageString;
    // console.log(ageString);
}

/** กำหนดพิกัด */
// var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "เบราว์เซอร์นี้ไม่รองรับตำแหน่งทางภูมิศาสตร์";
    }
}

function showPosition(position) {
    window.document.frmPerson.lat.value = position.coords.latitude;
    window.document.frmPerson.lon.value = position.coords.longitude;
}
</script>