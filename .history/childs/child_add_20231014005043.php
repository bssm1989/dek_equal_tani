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
        CONCAT(o1.`ofcnme`) AS recorded_by,p.savdte,CONCAT(o2.`ofcnme`) AS updofc,p.upddte 
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
            
            $savdte 	= substr($rows["savdte"],8,2)."-".substr($rows["savdte"],5,2)."-".substr($rows["savdte"],0,4);	
            $upddte 	= substr($rows["upddte"],8,2)."-".substr($rows["upddte"],5,2)."-".substr($rows["upddte"],0,4);
        }
     }else{
        $picname="./php/images/adduser.png";
    }

?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> เพิ่มข้อมูลเด็ก </h4>
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
                        <div class="col-12 col-sm-12 mt-3">
                            <!-- <input type="hidden" class="form-control" name="ofc_id" id="ofc_id" placeholder=""
                                    value="<?=$rows["ofc_id"];?>" readonly style="background-color:#CCCCCC"> -->
                            <input type="hidden" class="form-control" name="perid" id="perid" placeholder=""
                                value="<?=$rows["perid"];?>" readonly style="background-color:#CCCCCC">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3 text-center align-middle">

                            <input class="text_form" type="hidden" name="MAX_FILE_SIZE" value="2097152">
                            <img class="rounded float-center" id="uploadPreview" src="<?php echo $picname ?>" style=" cursor: pointer; border: 1px solid #030e3f;
                                        height: 140px;
                                        width: 140px;" onclick="getFile()">
                            <span style="position: relative; top: 5px;">

                                <input type="file" name="fileupload" id="fileupload" accept="*" title="เลือกไฟล์รูปภาพ"
                                    value="" style="display: none;" onchange="PreviewImage();">

                                <div id="btn btn-primary">
                                    <button id="submit"
                                        style="<?php echo ($rows['perid']<>""?"display:btn btn-primary;":"display:none;") ?>"
                                        onClick="saveFile()">บันทึก</button>
                                </div>
                                <?php if($file_resnme) echo "<a href=\"./profile/perdelfilehygienist.php?perid=".$perid."&filename=".$picname."\" >ลบ</a>"; ?>

                            </span>


                        </div>

                    </div>

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
                                    onClick="popitup('./childs/person_form_search.php?pid='+window.document.frmPerson.pid.value+'&perid='+window.document.frmPerson.perid.value,'winselect','height=600,width=800');">
                                    <i class="fas fa-search"></i></button>
                                <!-- รหัสบุคคล -->
                                <input type="hidden" class="form-control" name="perid" id="perid" placeholder=""
                                    value="<?=$rows["perid"];?>" readonly style="background-color:#CCCCCC">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="titid">คำนำหน้าชื่อ*</label>
                            <div class="input-group">
                                <select class="form-control" name="titid" id="titid">
                                    <?php
                                        $sql = "select titid,titnme from titname order by titid";
                                        $result = mysqli_query($conn,$sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value="<?=$row["titid"];?>"
                                        <?php if ($rows["titid"]==$row["titid"]) echo "selected";?>>
                                        <?=$row["titnme"];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="name">ชื่อ*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ"
                                    value="<?=$rows["name"];?>">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sname">นามสกุล*</label>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="sname" id="sname"
                                        placeholder="นามสกุล" value="<?=$rows["sname"];?>">

                                    <button class="btn btn-success" type="button" id="button-addon2"
                                        onClick="popitup('./childs/person_form_search.php?name='+window.document.frmPerson.name.value+'&sname='+window.document.frmPerson.sname.value+'&perid='+window.document.frmPerson.perid.value,'winselect','height=600,width=800');">
                                        <i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="genid">เพศ</label>
                            <select class="form-control" name="genid" id="genid">
                                <?php
                                    $sql = "select genid,gennme from gender order by genid";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                <option value="<?=$row["genid"];?>"
                                    <?php if ($rows["genid"]==$row["genid"]) echo "selected";?>>
                                    <?=$row["gennme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="brtdte">วันที่เกิด (วัน/เดือน/ปี)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="brtdte" id="testdate" placeholder=""
                                    value="<?php echo $brtdte; ?>" onchange="getAge()">
                                <button class="btn btn-success" type="button" id="button-addon2" onClick="clearDate()">
                                    <i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="age">อายุ (ปี)</label>
                            <input type="number" class="form-control" name="age" id="age" maxlength="3" min="0"
                                ,max="150" placeholder=""
                                <?php if ($age_now) echo "value='".$age_now."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="religid">ศาสนา</label>
                            <select class="form-control" name="religid" id="religid">
                                <?php
                                    $sql = "select religid,relignme from relig order by religid";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                <option value="<?=$row["religid"];?>"
                                    <?php if ($rows["religid"]==$row["religid"]) echo "selected";?>>
                                    <?=$row["relignme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="religoth">กรณีศาสนาอื่น ๆ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="religoth" id="religoth"
                                    placeholder="ระบุ ..." value="<?=$rows["religoth"];?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ที่ตั้งที่พักอาศัยนักเรียน ในปัจจุบัน</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="adr">บ้านเลขที่</label>
                            <input type="text" class="form-control" name="adr" id="adr" placeholder=""
                                value="<?=$rows["adr"];?>">
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="soi">ถนน ซอย</label>
                            <input type="text" class="form-control" name="soi" id="soi" placeholder=""
                                value="<?=$rows["soi"];?>">
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
                            <label for="postcode">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" name="postcode" id="postcode" placeholder=""
                                value="<?=$rows["postcode"];?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="pertel">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="pertel" id="pertel" placeholder=""
                                value="<?=$rows["pertel"];?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded"> ข้อมูลนักเรียน </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="chiord">เป็นบุตรคนที่เท่าไหร่</label>
                            <input type="number" class="form-control" name="chiord" id="chiord" maxlength="3" min="0"
                                ,max="150" placeholder="อายุ (ปี)"
                                <?php if ($rows["chiord"]) echo "value='".$rows["chiord"]."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="livewid">นักเรียนอาศัยอยู่กับใคร</label>
                            <select class="form-control" name="livewid" id="livewid">
                                <?php
                                                $sql = "select livewid,livewnme from livew order by livewid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["livewid"];?>"
                                    <?php if ($rows["livewid"]==$row["livewid"]) echo "selected";?>>
                                    <?=$row["livewnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="famsttid">สถานภาพครอบครัว</label>
                            <select class="form-control" name="famsttid" id="famsttid">
                                <?php
                                                $sql = "select famsttid,famsttnme from famstt order by famsttid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["famsttid"];?>"
                                    <?php if ($rows["famsttid"]==$row["famsttid"]) echo "selected";?>>
                                    <?=$row["famsttnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">
                                การเดินทางจากที่พักอาศัยไปโรงเรียน </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="distschkm">ระยะทางกี่กิโลเมตร </label>
                            <input type="number" class="form-control" name="distschkm" id="distschkm" maxlength="3"
                                min="0" ,max="150" placeholder="หน่วย:: กิโลเมตร"
                                <?php if ($rows["distschkm"]) echo "value='".$rows["distschkm"]."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="distschm">ระยะทางกี่เมตร </label>
                            <input type="number" class="form-control" name="distschm" id="distschm" maxlength="3"
                                min="0" ,max="150" placeholder="หน่วย:: เมตร"
                                <?php if ($rows["distschm"]) echo "value='".$rows["distschm"]."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="distschhrs">ใช้เวลากี่ชั่วโมง</label>
                            <input type="number" class="form-control" name="distschhrs" id="distschhrs" maxlength="3"
                                min="0" ,max="150" placeholder="หน่วย:: ชั่วโมง"
                                <?php if ($rows["distschhrs"]) echo "value='".$rows["distschhrs"]."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="distschmin">ใช้เวลากี่นาที</label>
                            <input type="number" class="form-control" name="distschmin" id="distschmin" maxlength="3"
                                min="0" ,max="150" placeholder="หน่วย:: นาที"
                                <?php if ($rows["distschmin"]) echo "value='".$rows["distschmin"]."'"; else echo "value='0'"; ?>>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="farepay">ค่าใช้จ่ายในการเดินทางไป-กลับ(บาท/เดือน)</label>
                            <input type="number" class="form-control" name="farepay" id="farepay" maxlength="3"
                                min="0" ,max="150" placeholder="หน่วย:: กี่บาท/เดือน"
                                <?php if ($rows["farepay"]) echo "value='".$rows["farepay"]."'"; else echo "value='0'"; ?>>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="schmethid">วิธีเดินทางหลัก</label>
                            <select class="form-control" name="schmethid" id="schmethid">
                                <?php
                                                $sql = "select schmethid,schmethnme from schmethod order by schmethid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["schmethid"];?>"
                                    <?php if ($rows["schmethid"]==$row["schmethid"]) echo "selected";?>>
                                    <?=$row["schmethnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="chidetail">รายละเอียดเชิงคุณภาพ</label>
                            <input type="text" class="form-control" name="chidetail" id="chidetail"
                                placeholder="" value="<?=$rows["chidetail"];?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">
                            ความเหลื่อมล้ำ </p>
                        </div>
                    </div>

                    <!-- <div class="row">                       
                        <div class="col-md-3 mb-3">
                            <label for="dispfrmid">ลักษณะความเหลื่อมล้ำ</label>
                            <select class="form-control" name="dispfrmid" id="dispfrmid">
                                <?php
                                                $sql = "select dispfrmid,dispfrmnme from dispform order by dispfrmid";
                                                $result = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                <option value="<?=$row["dispfrmid"];?>"
                                    <?php if ($rows["dispfrmid"]==$row["dispfrmid"]) echo "selected";?>>
                                    <?=$row["dispfrmnme"];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->

                    
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
    var Url = "./childs/child_crud.php";
    // alert("xxxxxxxxxxx");
    var POSTBody = "";
    POSTBody += "perid=" + document.frmPerson.perid.value;
    POSTBody += "&pid=" + document.frmPerson.pid.value;
    POSTBody += "&titid=" + document.frmPerson.titid.value;
    POSTBody += "&name=" + document.frmPerson.name.value;
    POSTBody += "&sname=" + document.frmPerson.sname.value;
    POSTBody += "&genid=" + document.frmPerson.genid.value;
    POSTBody += "&brtdte=" + document.frmPerson.brtdte.value;
    POSTBody += "&age=" + document.frmPerson.age.value;
    POSTBody += "&religid=" + document.frmPerson.religid.value;
    POSTBody += "&religoth=" + document.frmPerson.religoth.value;

    POSTBody += "&adr=" + document.frmPerson.adr.value;
    POSTBody += "&soi=" + document.frmPerson.soi.value;
    POSTBody += "&prv=" + document.frmPerson.province3.value;
    POSTBody += "&amp=" + document.frmPerson.district3.value;
    POSTBody += "&tmb=" + document.frmPerson.subdist3.value;
    POSTBody += "&vll=" + document.frmPerson.vll3.value;
    POSTBody += "&postcode=" + document.frmPerson.postcode.value;
    POSTBody += "&pertel=" + document.frmPerson.pertel.value;

    POSTBody += "&chiord=" + document.frmPerson.chiord.value;
    POSTBody += "&livewid=" + document.frmPerson.livewid.value;
    POSTBody += "&famsttid=" + document.frmPerson.famsttid.value;

    POSTBody += "&distschkm=" + document.frmPerson.distschkm.value;
    POSTBody += "&distschm=" + document.frmPerson.distschm.value;
    POSTBody += "&distschhrs=" + document.frmPerson.distschhrs.value;
    POSTBody += "&distschmin=" + document.frmPerson.distschmin.value;
    POSTBody += "&farepay=" + document.frmPerson.farepay.value;
    POSTBody += "&schmethid=" + document.frmPerson.schmethid.value;
    POSTBody += "&chidetail=" + document.frmPerson.chidetail.value;

    // POSTBody += "&dispfrmid=" + document.frmPerson.dispfrmid.value;

    POSTBody += "&act=save";
    // alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            // eval("var decoded_data = " + xmlhttp.responseText);
            // if (decoded_data['checkSave'] == "yes") {
            //     window.document.frmPerson.perid.value = decoded_data['perid0'];
            //     // window.document.frmPerson.recorded_by.value = decoded_data['recorded_by0'];
            //     // window.document.frmPerson.savdte.value = decoded_data['savdte0'];
            //     // window.document.frmPerson.updofc.value = decoded_data['updofc0'];
            //     // window.document.frmPerson.upddte.value = decoded_data['upddte0'];
            //     // window.location.href = '?page=persons&function=add&id=' + decoded_data['perid0'];
            //     alert("บันทึกข้อมูลเรียบร้อยแล้ว");
            //     // Swal.fire({
            //     //     text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
            //     //     icon: 'success',
            //     //     showConfirmButton: false,
            //     //     timer: 2000
            //     // })
            //     // window.history.replaceState(null, null, window.location.pathname)


            //     // window.document.getElementById('showSql').innerHTML = xmlhttp.responseText;
            // } else if (decoded_data['checkSave'] == "no") {
            //     window.document.frmPerson.perid.value = decoded_data['perid0'];
            //     // window.document.frmPerson.recorded_by.value = decoded_data['recorded_by0'];
            //     // window.document.frmPerson.savdte.value = decoded_data['savdte0'];
            //     // window.document.frmPerson.updofc.value = decoded_data['updofc0'];
            //     // window.document.frmPerson.upddte.value = decoded_data['upddte0'];
            //     //window.location.href = '?page=persons&function=add&id=' + decoded_data['perid0'];
            //     alert("ไม่สามารถบันทึกข้อมูลได้");
            //     // Swal.fire({
            //     //     text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
            //     //     icon: 'success',
            //     //     showConfirmButton: false,
            //     //     timer: 2000
            //     // })
            //     // window.history.replaceState(null, null, window.location.pathname)


            //     //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            // } else {
            //     Swal.fire({
            //         text: 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลเลขบัตรประชาชนซ้ำอีกครั้งค่ะ/ครับ',
            //         icon: 'error',
            //         showConfirmButton: false,
            //         timer: 3000
            //     })
            //     window.history.replaceState(null, null, window.location.href);
            //     //alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
            // }

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
    if (document.frmPerson.name.value.length == '' && document.frmPerson.sname.value.length == '') {
        alert(e1);
        return false;
    }
    return true;

};

//อัพโหลดรูปภาพ
function getFile() {
    a1 = document.getElementById('perid').value;
    //alert(a1)
    if (a1 == '') {
        alert("ไม่สามารถเพิ่มรูปได้ กรุณาบันทึกข้อมูลเด็กก่อน");
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