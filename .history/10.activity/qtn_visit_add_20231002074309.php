<?php
$actid = $_GET["actid"]; // Get activity ID from page showing list of activities
if ($actid) {
    // Construct your SQL query to fetch activity details and related information
    $sql = "SELECT
                a.actid,
                a.actnme,
                a.acttypid,
                a.actdtestr,
                a.actdteend,
                a.actplc,
                cv.vllnmegen AS place_village,
                a.actattdno,
                a.actdetail
            FROM
                activity a
            JOIN
                acttyp at ON a.acttypid = at.acttypid
            JOIN
                const_vllnmegen cv ON a.plcid = cv.plcid
            WHERE
                a.actid = $actid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $actnme = $row['actnme'];
        $acttypid = $row['acttypid'];
        $actdtestr = $row['actdtestr'];
        $actdteend = $row['actdteend'];
        $actplc = $row['actplc'];
        $place_village = $row['place_village'];
        $actattdno = $row['actattdno'];
        $actdetail = $row['actdetail'];
        $actid = $row['actid'];
    }
}
$acttypQuery = "SELECT * FROM acttyp";
$acttypResult = mysqli_query($conn, $acttypQuery);
?>

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลกิจกรรม</h4>
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
                    <b>จัดการข้อมูลกิจกรรม</b>
                </h5>

                <!-- • รหัสกิจกรรม
• ชื่อกิจกรรม
• รหัสประเภทกิจกรรม
• วันที่เริ่มจัดกิจกรรม
• วันที่จัดกิจกรรมเสร็จ
• สถานที่จัดกิจกรรม
• จังหวัดอ าเภอต าบล ที่จัดกิจกรรม
• จ านวนผู้เข้าร่วมกิจกรรม
• รายละเอียดการจัดกิจกรรม -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">
                    <input type="hidden" name="actid" id="actid" value="<?php echo $actid; ?>" />
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="shadow-sm p-2 mb-3 bg-success text-white rounded">ข้อมูลทั่วไป</p>
                        </div>
                    </div>


                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actnme">ชื่อกิจกรรม</label>
                        <input type="text" class="form-control" name="actnme" id="actnme" placeholder="ชื่อกิจกรรม" value="<?php echo $actnme; ?>"><!-- required>-->
                    </div>
                  
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="acttypid">รหัสประเภทกิจกรรม</label>
                        
                        <!-- You can replace this input with a dropdown menu populated from a query -->
                        <!-- <input type="text" class="form-control" name="acttypid" id="acttypid" placeholder="รหัสประเภทกิจกรรม" value="<?php echo $acttypid; ?>">required> -->
                   <select class="form-select" name="acttypid" id="acttypid" required>
                                <?php
                                while ($acttypRow = mysqli_fetch_assoc($acttypResult)) {
                                    $selected = ($acttypRow['acttypid'] == $acttypid) ? "selected" : "";
                                    echo "<option value='{$acttypRow['acttypid']}' {$selected}>{$acttypRow['acttypnme']}</option>";
                                }
                                ?>
                            </select>
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actdtestr">วันที่เริ่มจัดกิจกรรม</label>
                        <input type="text" class="form-control datepicker" name="actdtestr" id="actdtestr" placeholder="วันที่เริ่มจัดกิจกรรม" value="<?php echo $actdtestr; ?>"><!-- required>-->
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actdteend">วันที่จัดกิจกรรมเสร็จ</label>
                        <input type="text" class="form-control datepicker" name="actdteend" id="actdteend" placeholder="วันที่จัดกิจกรรมเสร็จ" value="<?php echo $actdteend; ?>"><!-- required>-->
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actplc">สถานที่จัดกิจกรรม</label>
                        <input type="text" class="form-control" name="actplc" id="actplc" placeholder="สถานที่จัดกิจกรรม" value="<?php echo $actplc; ?>"><!-- required>-->
                    </div>

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="place_village">จังหวัด อำเภอ ตำบล ที่จัดกิจกรรม</label>
                        <input type="text" class="form-control" name="place_village" id="place_village" placeholder="จังหวัด อำเภอ ตำบล ที่จัดกิจกรรม" value="<?php echo $actplc; ?>"><!-- required>-->
                        <input type="text" class="form-control" name="place_village" id="place_village" placeholder="จังหวัด อำเภอ ตำบล ที่จัดกิจกรรม" value="<?php echo $place_village; ?>"><!-- required>-->
                    </div>
                    <div class="col-12 col-sm-4 mb-3">

                        <div id="addr1" class="address">
                            <!-- get value from php place_id -->
                            <input type="hidden" id="addr1-addressCode" name="place_id" value="<?= $place_id; ?>" />

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

                    <div class="col-12 col-sm-4 mb-3">
                        <label for="actattdno">จำนวนผู้เข้าร่วมกิจกรรม</label>
                        <input type="text" class="form-control" name="actattdno" id="actattdno" placeholder="จำนวนผู้เข้าร่วมกิจกรรม" value="<?php echo $actattdno; ?>"><!-- required>-->
                    </div>

                    <div class="col-12 col-sm-12 mb-3">
                        <label for="actdetail">รายละเอียดการจัดกิจกรรม</label>
                        <textarea class="form-control" name="actdetail" id="actdetail" placeholder="รายละเอียดการจัดกิจกรรม"><!-- required>--><?php echo $actdetail; ?></textarea>


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
                            <input type="text" class="form-control" name="savofc" id="savofc" placeholder="" value="<?= $rows["savofc"]; ?>" readonly="true"><!-- required>-->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="savdte">วันที่บันทึก</label>
                            <input type="text" class="form-control" name="savdte" id="savdte" placeholder="" value="<?php echo $savdte; ?>" readonly="true"><!-- required>-->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="updofc" id="updofc" placeholder="" value="<?= $rows["updofc"]; ?>" readonly="true"><!-- required>-->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                            <input type="text" class="form-control" name="upddte" id="upddte" placeholder="" value="<?php echo $upddte; ?>" readonly="true"><!-- required>-->
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
                actnme: {
                    required: true
                },
                acttypid: {
                    required: true
                },
                actdtestr: {
                    required: true
                },
                actdteend: {
                    required: true
                },
                actplc: {
                    required: true
                },
                place_village: {
                    required: true
                },
                actattdno: {
                    required: true
                },
                actdetail: {
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
                    data['actdteend'] = data['actdteend'].replace(/-/g, "");
                    data['actdtestr'] = data['actdtestr'].replace(/-/g, "");

                    data['action'] = data['actid'] ? 'update' : 'insert';

                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        url: "10.activity/insert_activity.php",
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
                                    // window.location.href = "?page=10.activity";
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
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d", // Change the date format as needed
        "locale": "th",
        "yearinput": false,

        onReady: function(selectedDates, dateStr, instance) {
            // const yearDropdown = instance.yearElements[0]; // Updated selector
            //check if year >2400
            const yearDropdown = instance.yearElements[0]; // Updated selector
            // yearDropdown.value = parseInt(yearDropdown.value) + 543;
            const buddhistYear = parseInt(yearDropdown.value) + 543;
            month2digit = instance.selectedDates[0].getMonth() + 1;
            if (month2digit < 10) {
                month2digit = "0" + month2digit;
            }
            day2digit = instance.selectedDates[0].getDate();
            if (day2digit < 10) {
                day2digit = "0" + day2digit;
            }

            const formattedDate = `${buddhistYear}-${month2digit}-${day2digit}`;
            instance.input.value = formattedDate;

            // yearDropdown.value = parseInt(yearDropdown.value) + 543;
        },
        onselect: function(selectedDates, dateStr, instance) {
            const yearDropdown = instance.yearElements[0]; // Updated selector
            yearDropdown.value = parseInt(yearDropdown.value) + 543;
            console.log(yearDropdown.value);
        },
        onOpen: function(selectedDates, dateStr, instance) {
            // const selectedDate = instance.latestSelectedDateObj; // Get the selected date object
            // if (selectedDate) {
            //     const buddhistYear = selectedDate.getFullYear() + 543;
            //     const formattedDate = `${buddhistYear}-${selectedDate.getDate()}-${selectedDate.getMonth() + 1}`;
            //     instance.input.value = formattedDate; // Set the input value to the formatted date
            // }
        },
        onValueUpdate: function(selectedDates, dateStr, instance) {
            // debugger;
            // const selectedDate = selectedDates[0];
            // if(selectedDate.getFullYear()>2400){
            //     instance.currentYear = selectedDate.getFullYear() - 543;
            //     instance.yearElements[0].value = selectedDate.getFullYear() - 543;
            //     const yearDropdown = instance.yearElements[0]; // Updated selector

            // const buddhistYear =instance.currentYear + 543;
            // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
            // // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
            // // instance.input.value = formattedDate;

            // instance.input.value = formattedDate; 

            // }// Set the input value to the formatted date
        },
        onYearChange: function(selectedDates, dateStr, instance) {

            // if(instance.yearElements[0].value>2400){
            //     instance.yearElements[0].value=instance.yearElements[0].value-543;
            //     const yearDropdown = instance.yearElements[0]; // Updated selector
            // yearDropdown.value = parseInt(yearDropdown.value)+543;
            // }else{
            //     const yearDropdown = instance.yearElements[0]; // Updated selector
            // yearDropdown.value = parseInt(yearDropdown.value) + 543;

            // }

        },
        onMonthChange: function(selectedDates, dateStr, instance) {


            //     if(instance.yearElements[0].value>2400){

            //         instance.yearElements[0].value=instance.yearElements[0].value-543;
            //         const yearDropdown = instance.yearElements[0]; // Updated selector
            //     yearDropdown.value = parseInt(yearDropdown.value)+543;
            //     }else{
            //                     const yearDropdown = instance.yearElements[0]; // Updated selector
            //     yearDropdown.value = parseInt(yearDropdown.value) + 543;

            //         }
            //
        },
        onDayCreate: function(selectedDates, dateStr, instance) {
            if (dateStr.length < 10) {
                //dateStr 25640909 cut to year 2564 month 09 day 09
                dateStr = dateStr.substring(0, 4) + "-" + dateStr.substring(4, 6) + "-" + dateStr.substring(6, 8);
                //check if year >2400
                if (dateStr.substring(0, 4) > 2400) {
                    //year >2400
                    //change year to buddhist year
                    instance.currentYear = dateStr.substring(0, 4) - 543;
                    instance.yearElements[0].value = dateStr.substring(0, 4) - 543;
                    const yearDropdown = instance.yearElements[0]; // Updated selector
                    yearDropdown.value = parseInt(yearDropdown.value) + 543;
                    instance.selectedDates[0].setYear(dateStr.substring(0, 4) - 543);
                    instance.selectedDates[0].setMonth(dateStr.substring(5, 7) - 1);
                    instance.selectedDates[0].setDate(dateStr.substring(8, 10));
                    //change input value to buddhist year
                    instance.input.value = dateStr;
                } else {
                    //year <2400
                    //change input value to buddhist year
                    instance.input.value = dateStr;
                }

            } else {
                if (instance.yearElements[0].value > 2400) {
                    instance.currentYear = instance.yearElements[0].value - 543;
                    instance.yearElements[0].value = instance.yearElements[0].value - 543;
                    const yearDropdown = instance.yearElements[0]; // Updated selector
                    yearDropdown.value = parseInt(yearDropdown.value) + 543;
                } else {
                    //     const yearDropdown = instance.yearElements[0]; // Updated selector
                    //    // yearDropdown.value = parseInt(yearDropdown.value) + 543;
                    //     const buddhistYear = parseInt(yearDropdown.value) + 543;
                    //     month2digit = instance.selectedDates[0].getMonth() + 1;
                    //     if (month2digit < 10) {
                    //         month2digit = "0" + month2digit;
                    //     }   
                    //     day2digit = instance.selectedDates[0].getDate();
                    //     if (day2digit < 10) {
                    //         day2digit = "0" + day2digit;
                    //     }

                    //     const formattedDate = `${buddhistYear}-${month2digit}-${day2digit}`;
                    //     instance.input.value = formattedDate;

                }
            }

            console.log(instance.currentYear);

        },

        // Convert the selected Gregorian year to Buddhist year




        onChange: function(selectedDates, dateStr, instance) {
            // Convert the selected Gregorian year to Buddhist year
            const selectedDate = selectedDates[0];
            if (selectedDate.getFullYear() > 2400) {
                instance.currentYear = selectedDate.getFullYear() - 543;
                instance.yearElements[0].value = selectedDate.getFullYear() - 543;
                const yearDropdown = instance.yearElements[0]; // Updated selector

                const buddhistYear = instance.currentYear + 543; // Add 543 to convert to Buddhist year

                // Update the input value with the converted year
                const inputElement = instance.input;
                //d-m-Y
                month2digi = selectedDate.getMonth() + 1;
                if (month2digi < 10) {
                    month2digi = "0" + month2digi;
                }
                //yyyy-mm-dd
                const formattedDate = `${buddhistYear}-${month2digi}-${selectedDate.getDate()}`;
                // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
                inputElement.value = formattedDate;
            } else {
                const yearDropdown = instance.yearElements[0]; // Updated selector  
                const buddhistYear = instance.currentYear + 543; // Add 543 to convert to Buddhist year
                const inputElement = instance.input;
                //d-m-Y ex 9-09-2564 month 2 digit
                month2digi = selectedDate.getMonth() + 1;
                if (month2digi < 10) {
                    month2digi = "0" + month2digi;
                }


                const formattedDate = `${buddhistYear}-${month2digi}-${selectedDate.getDate()}`;
                // const formattedDate = `${buddhistYear}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
                inputElement.value = formattedDate;
                // Update the input value with the converted year
            }
        },

    });
</script>
<script language=Javascript>
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