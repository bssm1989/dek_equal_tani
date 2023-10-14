<!-- Dropzone.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>


<?php
$qtn_visid   = $_GET["id"];
if ($qtn_visid) {
    $sql = "SELECT q.`qtn_visid`,a.perid,a.pid,CONCAT(prenme,nme,' ',surnme) AS nme,a.sex,a.brtdte,`weight`,`height`,`waistline`,`blood_pressure`,`help`,helpoth,
    p.roladr,p.rolvllno,e.plcnmegen AS rolplc,a.tel,o.optnme,t.pertypnme,
    `qtn_assessor`,`pos_ofcid`,`qtn_round`,`qtn_date`,`qtnvs1`,`qtnvs2`,`qtnvs3`,`qtnvs4`,`qtnvs5`,`qtnvs6`,`qtnvs7`,`qtnvs8`,`qtnvs_sum`,`qtnvsoth`,
    CONCAT(o1.`ofcnme`) AS recorded_by,q.savdte,CONCAT(o2.`ofcnme`) AS updofc,q.upddte 
    FROM `questionnaire_visit` q INNER JOIN person a ON q.perid = a.perid
    LEFT JOIN `person_qtn_additional` p ON a.perid = p.perid
    LEFT JOIN `const_plcnmegen` e ON p.rolplcid=e.plcidgen
    LEFT JOIN `const_prenme` pre ON a.preid=pre.preid 
    LEFT JOIN opt o ON a.optid = o.optid 
    LEFT JOIN `const_pertyp` t ON p.pertypid = t.pertypid
    LEFT JOIN ofc o1 ON o1.ofcid=q.recorded_by
    LEFT JOIN ofc o2 ON o2.ofcid=q.updofc";
    $sql .= " where q.qtn_visid=$qtn_visid";
    $result = mysqli_query($conn, $sql);
    // echo "sql1-> ".$sql;
    if ($rows = mysqli_fetch_array($result)) {
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
        $qtnvs_sum = $sum . " : " . $res;

        $savdte     = substr($rows["savdte"], 8, 2) . "-" . substr($rows["savdte"], 5, 2) . "-" . substr($rows["savdte"], 0, 4);
        $upddte     = substr($rows["upddte"], 8, 2) . "-" . substr($rows["upddte"], 5, 2) . "-" . substr($rows["upddte"], 0, 4);
    }
} else {
    $qtn_assessor = $ofcname;
}
?>
<!-- TEMPLATE FOR INSTITUTE FORM -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ข้อมูลสถาบัน</h4>
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
                    <b>ข้อมูลสถาบัน</b>
                </h5>
                <form name="frmInstitute" id="frmInstitute" method="post" action="" enctype="" onSubmit="" target="">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ข้อมูลทั่วไป</p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="insttypid">ประเภทสถาบัน</label>
                            <select class="form-control" name="insttypid" id="insttypid" required>
                                <option value="">เลือกประเภทสถาบัน</option>
                                <?php
                                // Fetch institution type data from the database
                                // Replace the database connection details with your actual credentials

                                $sql = "SELECT insttypid, insttypnme FROM insttyp ORDER BY insttypnme";
                                $result = mysqli_query($conn, $sql);

                                // Loop through the results and create option elements for the dropdown
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['insttypid'] . '">' . $row['insttypnme'] . '</option>';
                                }

                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="instregister">จดทะเบียนหรือไม่</label>
                            <select class="form-control" name="instregister" id="instregister" required>
                                <option value="1">มี</option>
                                <option value="0">ไม่มี</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="instnme">ชื่อสถาบัน</label>
                                    <input type="text" class="form-control" name="instnme" id="instnme" placeholder="ชื่อสถาบัน" required>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="prvid">จังหวัดที่ตั้ง</label>
                                    <select class="form-control" name="prvid" id="prvid" required>
                                        <option value="">เลือกจังหวัด</option>
                                        <?php


                                        $sql = "SELECT prvid, prvnme FROM prv ORDER BY prvnme";
                                        $result = mysqli_query($conn, $sql);

                                        // Loop through the results and create option elements for the dropdown
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['prvid'] . '">' . $row['prvnme'] . '</option>';
                                        }

                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="instname">ชื่อผู้รับผิดชอบสถาบัน</label>
                                    <input type="text" class="form-control" name="instname" id="instname" placeholder="ชื่อผู้รับผิดชอบสถาบัน" required>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="inssname">นามสกุลผู้รับผิดชอบสถาบัน</label>
                                    <input type="text" class="form-control" name="inssname" id="inssname" placeholder="นามสกุลผู้รับผิดชอบสถาบัน" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="inststdno">นักเรียนในความดูแล ณ ปัจจุบัน</label>
                                    <input type="number" class="form-control" name="inststdno" id="inststdno" placeholder="จำนวนนักเรียน" required>
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="instinc">รายรับจากการสนับสนุน/รับบริจาค</label>
                                    <input type="number" class="form-control" name="instinc" id="instinc" placeholder="รายรับทั้งปี (บาท)" required>
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="instlandrai">ที่ดิน (ไร่)</label>
                                    <input type="number" class="form-control" name="instlandrai" id="instlandrai" placeholder="ที่ดิน (ไร่)" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="instlandngan">ที่ดิน (งาน)</label>
                                    <input type="number" class="form-control" name="instlandngan" id="instlandngan" placeholder="ที่ดิน (งาน)" required>
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="instbulding">อาคาร (หลัง)</label>
                                    <input type="number" class="form-control" name="instbulding" id="instbulding" placeholder="อาคาร (หลัง)" required>
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label for="instvehicle">ยานพาหนะที่ใช้งานได้ (คัน)</label>
                                    <input type="number" class="form-control" name="instvehicle" id="instvehicle" placeholder="ยานพาหนะที่ใช้งานได้ (คัน)" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="instimg1">รูปภาพ 1 (หลังคาและฝาผนัง)</label>
                                    <!-- Replace the input field with the Dropzone container -->
                                    <div id="imageDropzone" class="dropzone"></div>
                                    <input type="hidden" name="instimg1_url" id="instimg1_url" value="">
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="instimg2">รูปภาพ 2 (พื้นและภายใน)</label>
                                    <div class="dropzone" id="instimg2"></div>
                                    <input type="hidden" name="instimg2_url" id="instimg2_url" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Function to enable all input fields
                        function enableInputFieldsAndButton(setInput) {
                            $('#personSelect').prop('disabled', setInput ? false : true);
                            $('#personSelect, #occid, #prvid, #wrknme, #wrkstarty, #work_period_years, #work_period_months, #wrkendy, #wrkendreas').prop('disabled', true);
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
                                    url: "3.historyeducation/searchPerson.php",
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


                    <hr>
                    <?php if (!$perid) { ?>
                        <input type="submit" class="mt-3 btn btn-primary text-white" name="submit" value="บันทึก" />
                    <?php } else { ?>
                        <input type="submit" class="mt-3 btn btn-primary text-white" name="submit" value="แก้ไข" />
                        <!-- button cancle -->
                        <input type="button" class="mt-3 btn btn-warning  text-white" name="cancle" value="ยกเลิก" onClick="window.location.href='?page=person'" />
                    <?php } ?>
                    <button class="mt-3 btn btn-danger text-white" type="reset" onClick="if(confirm('ต้องการเคลียร์ข้อมูลหรือไม่')==true) clearForm();">เคลียร์หน้าจอ</button>

                    <hr class="mb-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="recorded_by">ผู้บันทึก</label>
                            <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $rows["recorded_by"]; ?>" readonly="true" required>
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



<script language=Javascript>
    function saveInstitute() {
        // Gather the form data
        var formData = $("#frmInstitute").serialize();
        formData += "&action=add";
        formData += "&instimg2=" + encodeURIComponent($("#instimg2_url").val()); // Add the image URL to the form data
        formData += "&instimg1=" + encodeURIComponent($("#instimg1_url").val()); // Add the image URL to the form data

        // Make the AJAX request using jQuery
        $.ajax({
            type: "POST",
            url: "./institute/qtn_institute_crud.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    // You can perform any other actions after a successful save here
                } else {
                    alert(response.message);
                    // You can handle errors or show appropriate messages here
                }
            },
            error: function() {
                alert("An error occurred while saving institute data.");
            }
        });
    }

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
    $(document).ready(function() {
        // Event listener for the image input field
        $("#instimg1").change(function() {
            // Trigger the image upload via AJAX
            uploadImage();
        });

        // Function to handle image upload via AJAX
        function uploadImage() {
            var formData = new FormData($("#frmInstitute")[0]);
            $.ajax({
                url: "./institute/upload_image.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Display the thumbnail on the client-side
                        $("#thumbnailImage").attr("src", response.thumbnail_url);
                        $("#thumbnailContainer").show();
                    } else {
                        alert("Image upload failed. Please try again.");
                    }
                },
                error: function() {
                    alert("An error occurred during image upload.");
                }
            });
        }
    });
    Dropzone.autoDiscover = false;

    // Initialize Dropzone on the element with id="imageDropzone"
    var myDropzone = new Dropzone("#imageDropzone", {
        url: "./upload_image.php", // Replace with the PHP file that handles the image upload on the server
        acceptedFiles: "image/*", // Allow only image files
        addRemoveLinks: true, // Show remove links for uploaded images
        maxFiles: 1, // Limit the number of files that can be uploaded (set to 1 for single image upload)
        maxFilesize: 5, // Maximum file size in MB
        dictDefaultMessage: "ลากและวางไฟล์รูปภาพที่นี่หรือคลิกเพื่ออัปโหลด", // Set the default message
        dictRemoveFile: "ลบรูปภาพ", // Set the text for the remove link
        init: function() {
            this.on("success", function(file, response) {
                // Handle successful file upload
                if (response.success) {
                    // Display the thumbnail
                    var thumbnailUrl = response.thumbnail_url;

                    // Store the image URL in the hidden input field
                    $("#instimg1_url").val(thumbnailUrl);
                }
            });
        }
    });
    var myDropzone = new Dropzone("#instimg2", {
        url: "./upload_image.php", // Replace with the PHP file that handles the image upload on the server
        acceptedFiles: "image/*", // Allow only image files
        addRemoveLinks: true, // Show remove links for uploaded images
        maxFiles: 1, // Limit the number of files that can be uploaded (set to 1 for single image upload)
        maxFilesize: 5, // Maximum file size in MB
        dictDefaultMessage: "ลากและวางไฟล์รูปภาพที่นี่หรือคลิกเพื่ออัปโหลด", // Set the default message
        dictRemoveFile: "ลบรูปภาพ", // Set the text for the remove link
        init: function() {
            this.on("success", function(file, response) {
                // Handle successful file upload
                if (response.success) {
                    // Display the thumbnail
                    var thumbnailUrl = response.thumbnail_url;

                    // Store the image URL in the hidden input field
                    $("#instimg2_url").val(thumbnailUrl);
                }
            });
        }
    });
</script>
<!-- Dropzone.js -->