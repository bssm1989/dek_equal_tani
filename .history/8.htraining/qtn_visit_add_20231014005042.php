<?php
$hhtrnid = $_GET["hhtrnid"]; // Get hhtrnid from page showing the list of htraining
if ($hhtrnid) {
    // Construct your SQL query to fetch htraining details and related information
    $sql = "SELECT ht.hhtrnid, ht.perid, ht.htrndtestr, ht.htrndteend, ht.htrntit, ht.prvid, ht.htrndetail,
                   CONCAT(p.name, ' ', p.sname) AS participant_name, prv.prvnme AS training_province
            FROM htraining ht
            JOIN person p ON ht.perid = p.perid
            JOIN prv ON ht.prvid = prv.prvid
            WHERE ht.hhtrnid = $hhtrnid"; // Modify the condition based on your database structure
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $perid = $row['perid'];
        $htrndtestr = $row['htrndtestr'];
        $htrndteend = $row['htrndteend'];
        $htrntit = $row['htrntit'];
        $prvid = $row['prvid'];
        $htrndetail = $row['htrndetail'];
        $participant_name = $row['participant_name'];
        $training_province = $row['training_province'];
        $hhtrnid = $row['hhtrnid'];
        
    }
}
?>
  <!-- 
  iiii          tttt                                                                                          kkkkkkkk           
 i::::i      ttt:::t                                                                                          k::::::k           
  iiii       t:::::t                                                                                          k::::::k           
             t:::::t                                                                                          k::::::k           
iiiiiiittttttt:::::ttttttt         wwwwwww           wwwww           wwwwwww ooooooooooo   rrrrr   rrrrrrrrr   k:::::k    kkkkkkk
i:::::it:::::::::::::::::t          w:::::w         w:::::w         w:::::woo:::::::::::oo r::::rrr:::::::::r  k:::::k   k:::::k 
 i::::it:::::::::::::::::t           w:::::w       w:::::::w       w:::::wo:::::::::::::::or:::::::::::::::::r k:::::k  k:::::k  
 i::::itttttt:::::::tttttt            w:::::w     w:::::::::w     w:::::w o:::::ooooo:::::orr::::::rrrrr::::::rk:::::k k:::::k   
 i::::i      t:::::t                   w:::::w   w:::::w:::::w   w:::::w  o::::o     o::::o r:::::r     r:::::rk::::::k:::::k    
 i::::i      t:::::t                    w:::::w w:::::w w:::::w w:::::w   o::::o     o::::o r:::::r     rrrrrrrk:::::::::::k     
 i::::i      t:::::t                     w:::::w:::::w   w:::::w:::::w    o::::o     o::::o r:::::r            k:::::::::::k     
 i::::i      t:::::t    tttttt            w:::::::::w     w:::::::::w     o::::o     o::::o r:::::r            k::::::k:::::k    
i::::::i     t::::::tttt:::::t             w:::::::w       w:::::::w      o:::::ooooo:::::o r:::::r           k::::::k k:::::k   
i::::::i     tt::::::::::::::t              w:::::w         w:::::w       o:::::::::::::::o r:::::r           k::::::k  k:::::k  
i::::::i       tt:::::::::::tt               w:::w           w:::w         oo:::::::::::oo  r:::::r           k::::::k   k:::::k  
iiiiiiii         ttttttttttt                  www             www            ooooooooooo    rrrrrrr           kkkkkkkk    kkkkkkk -->


<!-- 

                                                                                                               
                                                                                                               
                                                                                                       lllllll 
                                                                                                       l:::::l 
                                                                                                       l:::::l 
                                                                                                       l:::::l 
ppppp   ppppppppp   rrrrr   rrrrrrrrrvvvvvvv           vvvvvvv         ssssssssss       eeeeeeeeeeee    l::::l 
p::::ppp:::::::::p  r::::rrr:::::::::rv:::::v         v:::::v        ss::::::::::s    ee::::::::::::ee  l::::l 
p:::::::::::::::::p r:::::::::::::::::rv:::::v       v:::::v       ss:::::::::::::s  e::::::eeeee:::::eel::::l 
pp::::::ppppp::::::prr::::::rrrrr::::::rv:::::v     v:::::v        s::::::ssss:::::se::::::e     e:::::el::::l 
 p:::::p     p:::::p r:::::r     r:::::r v:::::v   v:::::v          s:::::s  ssssss e:::::::eeeee::::::el::::l 
 p:::::p     p:::::p r:::::r     rrrrrrr  v:::::v v:::::v             s::::::s      e:::::::::::::::::e l::::l 
 p:::::p     p:::::p r:::::r               v:::::v:::::v                 s::::::s   e::::::eeeeeeeeeee  l::::l 
 p:::::p    p::::::p r:::::r                v:::::::::v            ssssss   s:::::s e:::::::e           l::::l 
 p:::::ppppp:::::::p r:::::r                 v:::::::v             s:::::ssss::::::se::::::::e         l::::::l
 p::::::::::::::::p  r:::::r                  v:::::v              s::::::::::::::s  e::::::::eeeeeeee l::::::l
 p::::::::::::::pp   r:::::r                   v:::v                s:::::::::::ss    ee:::::::::::::e l::::::l
 p::::::pppppppp     rrrrrrr                    vvv                  sssssssssss        eeeeeeeeeeeeee llllllll
 p:::::p                                                                                                       
 p:::::p                                                                                                       
p:::::::p                                                                                                      
p:::::::p                                                                                                      
p:::::::p                                                                                                      
ppppppppp                                                                                                      
                                                                                                               

 -->

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> จัดการข้อมูลประวัติการอบรม</h4>
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
                    <b>จัดการข้อมูลประวัติการอบรม</b>
                </h5>

                <!-- รหัสประวัติการติดตาม/การเยี่ยมเยียน
• รหัสบุคคล รหัสเด็ก
• วันที่เริ่มติดตาม/เยี่ยมเยียน (แต่ละครั้ง) เปิดไว้กรณีติดตามหลายวัน
• วันที่ติดตาม/เยี่ยมเยียนเสร็จ
• ติดตาม/เยี่ยมเยียนด้วยวิธีใด
• รายละเอียดการติดตาม/เยี่ยมเยียน -->
                <form name="frmScreening" id="frmScreening" method="post" action="" enctype="" onSubmit="" target="">


                    <div class="col-12 col-sm-4 mb-3">
                        <label for="eduid">บุคคล</label>
                        <!-- //div group -->
                        <!-- input hidden hhtrnid -->
                        <input type="hidden" class="form-control" name="hhtrnid" id="hhtrnid" placeholder="" value="<?php echo $hhtrnid; ?>" readonly="true" >
                        <div class="input-group">
                            <!-- Search for a person... to thai -->
                            <input type="text" id="personSelect" name="personName" class="form-control" placeholder="ค้นหาบุคคล" value="<?php echo $participant_name; ?>" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="changePersonButton" ">Change</button>
                            </div>
                        </div>
                        <div id="personDropdown" class="dropdown-menu" aria-labelledby="personSelect">
                                    <!-- Dropdown items will be populated here -->
                            </div>
                             <input type="hidden" id="perid" name="perid" value="<?php echo $perid; ?>" />

                        </div>
                       

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="htrndtestr">วันที่เริ่มอบรม</label>
                            <input type="text" class="form-control datepicker" name="htrndtestr" id="htrndtestr" placeholder="วันที่เริ่มอบรม" value="<?php echo $htrndtestr; ?>" required>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="htrndteend">วันที่อบรมเสร็จ</label>
                            <input type="text" class="form-control datepicker" name="htrndteend" id="htrndteend" placeholder="วันที่อบรมเสร็จ" value="<?php echo $htrndteend; ?>" required>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="htrntit">เรื่องที่อบรม</label>
                            <input type="text" class="form-control" name="htrntit" id="htrntit" placeholder="เรื่องที่อบรม" value="<?php echo $htrntit; ?>" required>
                        </div>

                        <!-- <div class="col-12 col-sm-4 mb-3">
                            <label for="prvid">จังหวัดที่อบรม</label> -->
                            <!-- You can replace this input with a dropdown menu populated from a query -->
                            <!-- <input type="text" class="form-control" name="prvid" id="prvid" placeholder="จังหวัดที่อบรม" value="<?php echo $prvid; ?>" required> -->
                        <!-- </div  > -->
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="prvSelect">จังหวัดที่อบรม</label>
                            <!-- //div group -->
                            <!-- input hidden hhtrnid -->
                            <div class="input-group">
                                <!-- Search for a person... to thai -->
                                <input type="text" id="prvSelect" name="prvSelect" class="form-control" placeholder="ค้นหาจังหวัดที่อบรม" value="<?php echo $training_province; ?>" required>

                            </div>
                            <div id="prvDropdown" class="dropdown-menu" aria-labelledby="prvSelect">
                                <!-- Dropdown items will be populated here -->
                            </div>
                            <input type="hidden" id="prvid" name="prvid" value="<?php echo $prvid; ?>" />
                        </div>
                        <div class="col-12 col-sm-12 mb-3">
                            <label for="htrndetail">รายละเอียดการอบรม</label>
                            <textarea class="form-control" name="htrndetail" id="htrndetail" placeholder="รายละเอียดการอบรม" required><?php echo $htrndetail; ?></textarea>
                        </div>
                        <script>
                            // Function to enable all input fields
                            function enableInputFieldsAndButton(setInput) {
                                $('#personSelect').prop('disabled', setInput ? false : true);
                                $('#htrndtestr, #htrndteend, #htrntit, #prvid, #htrndetail,#prvSelect').prop('disabled', setInput);
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
                                        url: "8.htraining/searchPerson.php",
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

                            $('#prvSelect').on('input', function() {
                                var searchQuery = $(this).val();
                                console.log('Search query:', searchQuery);
                                if (searchQuery.length >= 2) {
                                    // Make an AJAX call to fetch matching results
                                    $.ajax({
                                        url: "8.htraining/searchPrv.php",
                                        method: "GET",
                                        dataType: "json",
                                        data: {
                                            query: searchQuery
                                        },
                                        success: function(data) {
                                            // Clear previous results
                                            $('#prvDropdown').empty();

                                            // Populate the dropdown with search results
                                            data.forEach(function(result) {
                                                var option = $('<div id="prvitem" class="dropdown-item prv"></div>');
                                                option.text(result.text); // Change this to the property you want to display
                                                option.attr('data-value', result.id); // Change this to the property containing the person's ID
                                                $('#prvDropdown').append(option);
                                                $('#prvDropdown').show();

                                                // Handle click event for each result
                                                option.on('click', function() {
                                                    var selectedValue = $(this).attr('data-value');
                                                    var selectedText = $(this).text();
                                                    $('#prvSelect').val(selectedText); // Set the selected text in the input field
                                                    $('#prvid').val(selectedValue); // Set the selected ID in the hidden input
                                                    $('#prvDropdown').hide();

                                                    // Enable input fields and show the change button
                                                   
                                                });
                                            });
                                        }
                                    });
                                } else {
                                    // Clear dropdown if the input is too short
                                    $('#prvDropdown').empty();
                                }
                            });
                            
                        </script>
                        <!--//app-card-body-->

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
                                <input type="text" class="form-control" name="recorded_by" id="recorded_by" placeholder="" value="<?= $rows["recorded_by"]; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="savdte">วันที่บันทึก</label>
                                <input type="text" class="form-control" name="savdte" id="savdte" placeholder="" value="<?php echo $savdte; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="updofc">ผู้ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="updofc" id="updofc" placeholder="" value="<?= $rows["updofc"]; ?>" readonly="true" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="upddte">วันที่ปรับปรุงแก้ไข</label>
                                <input type="text" class="form-control" name="upddte" id="upddte" placeholder="" value="<?php echo $upddte; ?>" readonly="true" >
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
        <?php if ($hhtrnid) { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(false);
            console.log("enableInputFieldsAndButton(false);");

        <?php } else { ?>
            // Enable input fields and show the change button
            enableInputFieldsAndButton(true);
            console.log("enableInputFieldsAndButton(true);");

        <?php } ?>
    });
    $(document).ready(function() {
        $("#frmScreening").validate({
            rules: {
                // ... (existing validation rules)
                personName: {
                    required: true
                },
                htrndtestr: {
                    required: true
                },
                htrndteend: {
                    required: true
                },
                htrntit: {
                    required: true
                },
                prvid: {
                    required: true
                },
                htrndetail: {
                    required: true
                },
                // ... (other validation rules for new elements)
            },
            ignore: [],
            messages: {
                // Add custom error messages here
            },
            submitHandler: function(form) {
                console.log("submitHandler");
                // Serialize form data into JSON format
                var formData = $(form).serializeArray();
                var jsonData = {};
                $.each(formData, function(index, field) {
                    jsonData[field.name] = field.value;
                });

                // Determine the action based on whether perid is present or not
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
                    data['htrndteend'] = data['htrndteend'].replace(/-/g, "");
                    data['htrndtestr'] = data['htrndtestr'].replace(/-/g, "");
                    data['action'] = data['hhtrnid'] ? 'update' : 'insert';

                    // Send data to the server for insertion or update
                    $.ajax({
                        type: "POST",
                        url: "8.htraining/insert_htraining.php",
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
                                    // window.location.href = "?page=8.htraining";
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