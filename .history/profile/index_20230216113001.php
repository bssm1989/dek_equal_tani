<?php
    $ofcid   = $_SESSION['ofcid'];
    // $ofcopt = $_SESSION['user_optid'];
    // if(isset($ofcid) && !empty($ofcid)){
    if($ofcid){
        $sql = "SELECT `ofcid`,`ofcnme`,`pos`,`usrnme`,`pio`,`org`,`status`,`optid`,`email`,`profile_photo` 
        FROM ofc where ofcid=$ofcid";
        $result = mysqli_query($conn,$sql);
        // $rows = mysqli_fetch_array($result);
        // echo "sql1-> ".$sql;
        if($rows = mysqli_fetch_array($result)){
            $optid = $rows["optid"];

            /* รูปภาพประจำตัว */
            $file_resnme = $rows["profile_photo"];
            if($file_resnme){$picname="./php/images/".$file_resnme;}
            else{$picname="./php/images/adduser.png";}
        }
    }else{
        $picname="./php/images/adduser.png";
    }
?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> บัญชีของฉัน</h4>
    </div>
    <div class="col-auto">
        <!-- <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a> -->
    </div>
</div>
<hr class="mb-0">
<div class="row gy-4">
    <form name="frmUser" id="frmUser" method="post" action="./profile/perupfile.php" enctype="multipart/form-data"
        onSubmit="" target="">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                </div>
                                <!--//icon-holder-->

                            </div>
                            <!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">ข้อมูลผู้ใช้งาน</h4>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        <div class="item mb-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-12">
                                    <div class="item-label"><strong></strong></div>
                                    <div class="item-data">
                                        <input class="text_form" type="hidden" name="MAX_FILE_SIZE" value="2097152">
                                        <img class="profile-image" id="uploadPreview" src="<?php echo $picname ?>"
                                            style=" height: 125px; width: 125px;" onclick="getFile()">
                                        <span style="position: relative; top: 5px;">
                                            <input type="file" name="fileupload" id="fileupload" accept="*"
                                                title="เลือกไฟล์รูปภาพ" value="" style="display: none;"
                                                onchange="PreviewImage();">
                                            <div class="input-group mb-3">
                                                <button id="submit" type="submit" class="btn app-btn-secondary"
                                                    style="<?php echo ($ofcid<>""?"display:btn btn-primary;":"display:none;") ?>"
                                                    onClick="saveFile()"> บันทึก
                                                </button>
                                                <?php if($file_resnme) echo "<a href=\"./profile/perdelfile.php?ofcid=".$ofcid."&filename=".$picname."\" type='button' class='btn app-btn-secondary' >ลบ</a>"; ?>

                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item mb-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-12">
                                    <div class="item-label"><strong>ชื่อ-นามสกุล</strong></div>
                                    <div class="item-data">
                                        <input type="text" class="form-control" id="ofcnme" name="ofcnme"
                                            value="<?=$rows["ofcnme"];?>" placeholder="first name" required>
                                        <input type="hidden" class="form-control" id="ofcid" name="ofcid"
                                            value="<?=$rows["ofcid"];?>" placeholder="ofcid" required>
                                        <!-- รหัสผู้ใช้ ofcid -->
                                    </div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item mb-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-12">
                                    <div class="item-label"><strong>อีเมลล์</strong></div>
                                    <div class="item-data">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="<?=$rows["email"];?>" placeholder="email" required>
                                    </div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item mb-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-12">
                                    <div class="item-label"><strong>หน่วยงาน</strong></div>
                                    <div class="item-data">
                                        <select class="form-control" name="optid" id="optid" required>
                                            <?php
                                            $sql = "select optid,optnme from opt where optid = $optid";
                                            $sql.= " order by optid,optnme";
                                            $result = mysqli_query($conn,$sql);
                                            while ($row = mysqli_fetch_array($result)) {                                                
                                               echo print_r($sql);
                                                
                                        ?>
                                            <option value="<?=$row["optid"];?>"
                                                <?php if ($rows["optid"]==$row["optid"]) echo "selected";?>>
                                                <?=$row["optnme"];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                    </div>
                    <!--//app-card-body-->
                    <div class="app-card-footer p-4 mt-auto">
                        <a class="btn app-btn-secondary" href="#"
                            onClick="if(confirm('ต้องการบันทึกข้อมูลหรือไม่')==true) saveUserUpdate();">อัพเดทข้อมูล</a>
                    </div>
                    <!--//app-card-footer-->

                </div>
                <!--//app-card-->
            </div>
            <!--//col-->

            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z" />
                                        <path fill-rule="evenodd"
                                            d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </div>
                                <!--//icon-holder-->

                            </div>
                            <!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">ความปลอดภัย</h4>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        <div class="item mb-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-9">
                                    <div class="item-label"><strong>ชื่อผู้ใช้งาน</strong></div>
                                    <div class="item-data">
                                        <input type="text" class="form-control" id="usrnme" name="usrnme"
                                            value="<?=$rows["usrnme"];?>" placeholder="usrnme">
                                    </div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <a class="btn-sm app-btn-secondary" href="#"
                                        onClick="if(confirm('ต้องการเปลี่ยนชื่อผู้ใช้งานหรือไม่')==true) changeUser();">เปลี่ยนชื่อผู้ใช้งาน</a>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item mb-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-9">
                                    <div class="item-label"><strong>รหัสผ่าน</strong></div>
                                    <div class="item-data">
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="password" name="password"
                                                value="" placeholder="password">
                                            <a class="btn btn-light" onclick="togglePassword()">
                                                <i class="fa fa-eye align-middle text-center"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <a class="btn-sm app-btn-secondary" href=""
                                        onClick="if(confirm('ต้องการเปลี่ยนรหัสผ่านหรือไม่')==true) changeUserPWD();">เปลี่ยนรหัสผ่าน</a>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                    </div>
                    <!--//app-card-body-->

                </div>
                <!--//app-card-->
            </div>
    </form>

</div>
<!--//row-->

<!--//row-->
<script language=Javascript>
//ฟังก์ชันบันทึกช้อมูลบุคคล
function saveUserUpdate() {

    var xmlhttp = Inint_AJAX();
    //alert("xxxxxxxxxxx");
    var Url = "./profile/profile_crud.php";
    var POSTBody = "";
    POSTBody += "ofcid=" + document.frmUser.ofcid.value;
    POSTBody += "&ofcnme=" + document.frmUser.ofcnme.value;
    POSTBody += "&email=" + document.frmUser.email.value;
    POSTBody += "&optid=" + document.frmUser.optid.value;
    //POSTBody += "&username=" + document.frmUser.username.value;
    //POSTBody += "&password=" + document.frmUser.password.value;
    //POSTBody += "&permission=" + document.frmUser.permission.value;

    POSTBody += "&act=update";
    //alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            eval("var decoded_data = " + xmlhttp.responseText);
            if (decoded_data['checkSave'] == "yes") {
                window.document.frmUser.ofcid.value = decoded_data['ofcid0'];
                //alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                Swal.fire({
                    text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                window.history.replaceState(null, null, window.location.pathname)

                //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            } else {
                Swal.fire({
                    text: 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                })
                window.history.replaceState(null, null, window.location.pathname)
                //alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
            }
        } //else alert('ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ');
    }
};

function changeUser() {
    var xmlhttp = Inint_AJAX();
    //alert("xxxxxxxxxxx");
    var Url = "./profile/profile_crud.php";
    var POSTBody = "";
    POSTBody += "ofcid=" + document.frmUser.ofcid.value;
    POSTBody += "&username=" + document.frmUser.usrnme.value;
    POSTBody += "&act=changeuser";
    //alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            eval("var decoded_data = " + xmlhttp.responseText);
            if (decoded_data['checkSave'] == "yes") {
                window.document.frmUser.ofcid.value = decoded_data['ofcid0'];
                //alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                Swal.fire({
                    text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                window.history.replaceState(null, null, window.location.pathname)

                //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            } else {
                Swal.fire({
                    text: 'ไม่สามารถบันทึกข้อมูลได้ มีชื่อผู้ใช้นี้แล้ว! กรุณากรอกข้อมูลใหม่',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                })
                window.history.replaceState(null, null, window.location.pathname)
                //alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
            }
        } //else alert('ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ');
    }
};

function changeUserPWD() {
    var xmlhttp = Inint_AJAX();
    //alert("xxxxxxxxxxx");
    var Url = "./profile/profile_crud.php";
    var POSTBody = "";
    POSTBody += "ofcid=" + document.frmUser.ofcid.value;
    POSTBody += "&password=" + document.frmUser.password.value;
    POSTBody += "&act=changepwd";
    //alert(POSTBody);
    xmlhttp.open('POST', Url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(POSTBody);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            eval("var decoded_data = " + xmlhttp.responseText);
            if (decoded_data['checkSave'] == "yes") {
                window.document.frmUser.ofcid.value = decoded_data['ofcid0'];
                alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                // Swal.fire({
                //     text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                //     icon: 'success',
                //     showConfirmButton: false,
                //     timer: 2000
                // })
                // window.history.replaceState(null, null, window.location.pathname)

                //window.document.getElementById('showSql').innerHTML=xmlhttp.responseText;
            } else {
                // Swal.fire({
                //     text: 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ',
                //     icon: 'error',
                //     showConfirmButton: false,
                //     timer: 2000
                // })
                // window.history.replaceState(null, null, window.location.pathname)
                alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้งค่ะ/ครับ');
            }
        } //else alert('ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเลขบัตรประชาชนนี้ซ้ำกับบุคคลอื่นที่อยู่ในฐานข้อมูล กรุณาตรวจสอบข้อมูลก่อนค่ะ/ครับ');
    }
};

function clearForm() {
    //window.document.frmUser.reset();
    form.reset();
    location.reload();

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
    a1 = document.getElementById('ofcid').value;
    //alert(a1)
    if (a1 == '') {
        alert("ไม่สามารถเพิ่มรูปได้");
    } else document.getElementById('fileupload').click();

};

function saveFile() {
    a1 = document.getElementById('fileupload').value;
    // alert(a1);
    if (a1 == "") {
        alert("กรุณาแนบรูปภาพก่อนครับ")
    } else {
        //document.frmProfile.submit();
        // document.getElementById ('frmProfile').submit ()
        document.createElement('frmUser').submit;
    }
};

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("fileupload").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };

};

/** script password */
function togglePassword() {
    var pw = document.getElementById("password");
    (pw.type === "password") ? pw.type = "text": pw.type = "password";
    //exit();
}
</script>