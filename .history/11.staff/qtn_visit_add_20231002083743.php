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
// Query to fetch titname options for dropdown
$titnameQuery = "SELECT * FROM titname";
$titnameResult = mysqli_query($conn, $titnameQuery);
// Query to fetch titname options for dropdown

$staffposQuery = "SELECT * FROM staffpos";
$staffposResult = mysqli_query($conn, $staffposQuery);
// Query to fetch titname options for dropdown
$staffprioQuery = "SELECT * FROM staffprio";
$staffprioResult = mysqli_query($conn, $staffprioQuery);

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
                    <!-- input hidden staffid -->
                    <input type="hidden" name="staffid" id="staffid" value="<?php echo $staffid; ?>" />
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ข้อมูลทั่วไป</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="title_id">รหัสคำนำหน้าชื่อ</label>
                        <select class="form-select" name="title_id" id="title_id" > <!--required> -->
                            <?php
                            while ($titnameRow = mysqli_fetch_assoc($titnameResult)) {
                                $selected = ($titnameRow['titid'] == $title_id) ? "selected" : "";
                                echo "<option value='{$titnameRow['titid']}' {$selected}>{$titnameRow['titnme']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Add other input fields for staff information here -->
                    <div class="row">
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="staffnme">ชื่อ</label>
                            <input type="text" class="form-control" name="staffnme" id="staffnme" placeholder="ชื่อ" value="<?php echo $staffnme; ?>" > <!--required> -->
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="staffsnme">สกุล</label>
                            <input type="text" class="form-control" name="staffsnme" id="staffsnme" placeholder="สกุล" value="<?php echo $staffsnme; ?>" > <!--required> -->
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="stafftell">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="stafftell" id="stafftell" placeholder="เบอร์โทรศัพท์" value="<?php echo $stafftell; ?>" > <!--required> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="staffemail">อีเมล์</label>
                            <input type="email" class="form-control" name="staffemail" id="staffemail" placeholder="อีเมล์" value="<?php echo $staffemail; ?>" > <!--required> -->
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="stafforg">หน่วยงานที่สังกัด</label>
                            <input type="text" class="form-control" name="stafforg" id="stafforg" placeholder="หน่วยงานที่สังกัด" value="<?php echo $stafforg; ?>" > <!--required> -->
                        </div>

                        <!-- <div class="col-12 col-sm-4 mb-3">
                            <label for="plcid">จังหวัด อำเภอ ตำบล หน่วยงานที่สังกัด</label>
                            <input type="text" class="form-control" name="plcid" id="plcid" placeholder="จังหวัด อำเภอ ตำบล หน่วยงานที่สังกัด" value="<?php echo $plcid; ?>" > <!--required> -->
                        </div> -->
                    </div>
                    <div class="col-12 col-sm-4 mb-3">

                        <div id="addr1" class="address">
                            <!-- get value from php place_id -->
                            <input type="hidden" id="addr1-addressCode" name="plcid" value="<?= $plcid; ?>" />

                            <div class="notification"></div>
                        </div>
                    </div>
                    <script src="testCrud/data/address-data.js"></script>
                    <script src="testCrud/manage-addr.js"></script>
                    <script>
                        $(document).ready(function() {
                            const addr1 = new AddressDropdowns('addr1', addressData);
                            addr1.init();


                            $.validator.addMethod('eightDigits', function(value, element) {
                                console.log('Custom validation method called:', value, element);

                                const isValid = /^[0-9]{8}$/.test(value) && value !== '00000000';
                                console.log('Validation result:', isValid);

                                return this.optional(element) || isValid;
                            }, 'Please enter an 8-digit code.');
                            $('#editForm').validate({
                                rules: {
                                    name: 'required',
                                    'addr1-addressCode': {
                                        required: true,
                                        eightDigits: true
                                    },

                                },
                                ignore: [],
                                messages: {
                                    name: 'Please enter your name',
                                    'addr1-addressCode': {
                                        required: 'Please enter an address code',
                                        eightDigits: 'Please enter an 8-digit code.'
                                    },
                                    'addr2-addressCode': {
                                        required: 'Please enter an address code',
                                        eightDigits: 'Please enter an 8-digit code.'
                                    }
                                },
                                errorPlacement: function(error, element) {
                                    // Show the error message inside the corresponding notification div
                                    element.closest('.notification').html(error);

                                    // Add red border to the address div
                                    element.closest('.address').css('border', '2px solid red');
                                },
                                success: function(label, element) {
                                    // Remove red border when validation succeeds
                                    $(element).closest('.address').css('border', 'none');
                                },
                                submitHandler: function(form) {
                                    if ($('#editForm').valid()) {
                                        console.log('Form submitted successfully.');
                                        console.log('Name:', $('#name').val());
                                        console.log('Address 1:', addr1.getConcatenatedAddressCode());
                                        console.log('Address 2:', addr2.getConcatenatedAddressCode());
                                        console.log('Address 3:', addr3.getConcatenatedAddressCode());

                                    }
                                }
                            });
                        });
                    </script>
                    <div class="row">
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="staffposid">รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้</label>
                            <select class="form-select" name="staffposid" id="staffposid" > <!--required> -->
                                <?php
                                while ($staffposRow = mysqli_fetch_assoc($staffposResult)) {
                                    $selected = ($staffposRow['staffposid'] == $staffposid) ? "selected" : "";
                                    echo "<option value='{$staffposRow['staffposid']}' {$selected}>{$staffposRow['staffposnme']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="staffprioid">รหัสสิทธิการเข้าถึงข้อมูล</label>
                            <select class="form-select" name="staffprioid" id="staffprioid" > <!--required> -->
                                <?php
                                while ($staffprioRow = mysqli_fetch_assoc($staffprioResult)) {
                                    $selected = ($staffprioRow['staffprioid'] == $staffprioid) ? "selected" : "";
                                    echo "<option value='{$staffprioRow['staffprioid']}' {$selected}>{$staffprioRow['staffprionme']}</option>";
                                }
                                ?>
                            </select>

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
                            <label for="savofc">ผู้บันทึก</label>
                            <input type="text" class="form-control" name="savofc" id="savofc" placeholder="" value="<?= $rows["savofc"]; ?>" readonly="true" > <!--required> -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="savdte">วันที่บันทึก</label>
                            <input type="text" class="form-control" name="savdte" id="savdte" placeholder="" value="<?php echo $savdte; ?>" readonly="true" > <!--required> -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="updofc" id="updofc" placeholder="" value="<?= $rows["updofc"]; ?>" readonly="true" > <!--required> -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="upddte" id="upddte" placeholder="" value="<?php echo $upddte; ?>" readonly="true" > <!--required> -->
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
        $("#frmScreening").validate({
            rules: {
                // ... (existing validation rules)
                staffnme: {
                    required: true
                },
                staffsnme: {
                    required: true
                },
                stafftell: {
                    required: true
                },
                staffemail: {
                    required: true,
                    email: true
                },
                stafforg: {
                    required: true
                },
                plcid: {
                    required: true
                },
                staffposid: {
                    required: true
                },
                staffprioid: {
                    required: true
                },
                // ... (other validation rules for new elements)
            },
            ignore: [],
            messages: {
                // Add custom error messages here
            },
            submitHandler: function(form) {
                // Serialize form data into JSON format
                var formData = $(form).serializeArray();
                var jsonData = {};
                $.each(formData, function(index, field) {
                    jsonData[field.name] = field.value;
                });

                // Determine the action based on whether heduid is present or not
                if ($('#heduid').val()) {
                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: 'คุณกำลังจะอัปเดตข้อมูล การดำเนินการนี้ไม่สามารถย้อนกลับได้',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'อัปเดต',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            performAjaxRequest(jsonData);
                        }
                    });
                } else {
                    performAjaxRequest(jsonData);
                }

                function performAjaxRequest(data) {
                    // Add the action parameter to indicate the action to be performed
                    data['action'] = data['staffid'] ? 'update' : 'insert';
                    data['plcid'] = data['plcid'].slice(0, 6);
                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        url: "11.staff/insert_staff.php",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                // Show success message
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'ตกลง'
                                }).then(() => {
                                    // Go to the next page
                                    window.location.href = "?page=11.staff";
                                });
                            } else {
                                // Show error message
                                Swal.fire({
                                    title: 'ข้อผิดพลาด',
                                    text: "เกิดข้อผิดพลาด: " + response.message,
                                    icon: 'error',
                                    confirmButtonText: 'ตกลง'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle Ajax error
                            console.error(error);
                            Swal.fire({
                                title: 'ข้อผิดพลาด',
                                text: 'เกิดข้อผิดพลาดขณะส่งแบบฟอร์ม',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    });
                }
            }
        });
    });

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