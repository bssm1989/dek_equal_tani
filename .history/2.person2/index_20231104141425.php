<?php
@session_start();
$optid = $_SESSION['optid'];

// Make sure to update the database connection settings if needed

// Replace the empty SQL query with your modified query to fetch data from the person, hedu, disptyp, titname, and education tables, and join them accordingly.
// You will need to adjust the JOIN conditions based on your table structure.
$sql = "SELECT
p.perid AS person_id,
p.pid AS national_id,
p.titid AS title_id,
t.titnme AS title_name,
p.name,
p.sname AS surname,
p.genid AS gender_id,
g.gennme AS gender_name,
p.religid AS religion_id,
r.relignme AS religion_name,
p.brtdte AS birth_date,
p.age,
p.adr AS address,
p.soi AS street,
p.vllid AS village_id,
v.vllnme AS village_name,
p.plcid AS place_id,
plc.plcnme AS place_name,
p.postcode,
p.pertel AS phone_number,
p.hholdid AS household_id,
c.chiord AS child_order,
l.livewnme AS living_with,
f.famsttnme AS family_status,



c.distschkm AS distance_km_m,
c.distschm AS distance_m,
c.distschhrs AS distance_hours,
c.distschmin AS distance_minutes,
c.farepay AS fare_per_month,
m.schmethid AS main_transportation_id,
m.schmethnme AS main_transportation,
c.chidetail AS child_detail,
df.dispfrmnme AS display_form
FROM
person p
LEFT JOIN
titname t ON p.titid = t.titid
LEFT JOIN
gender g ON p.genid = g.genid
LEFT JOIN
relig r ON p.religid = r.religid
LEFT JOIN
vll v ON p.vllid = v.vllid
LEFT JOIN
plc ON p.plcid = plc.plcid
LEFT JOIN
child c ON p.perid = c.perid
LEFT JOIN
livew l ON c.livewid = l.livewid
LEFT JOIN
famstt f ON c.famsttid = f.famsttid
LEFT JOIN
schmethod m ON c.schmethid = m.schmethid
LEFT JOIN
disptyp dt ON p.perid = dt.perid
LEFT JOIN
dispform df ON df.dispfrmid = dt.dispfrmid;
";

// Execute the SQL query and fetch the results into the $results array
// You will need to replace the $conn variable with your database connection variable
$results = mysqli_query($conn, $sql);

// Function to get the educational level (you can keep this function as it is)
function getEducationLevel($edulev)
{
    // Function logic to get the educational level based on the given edulev
    // ...
    // Return the educational level
    // return $education_level;
}
?>

<!-- Rest of your HTML code as before -->

<!-- Existing HTML code -->
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0"> ข้อมูลประวัติการศึกษา</h4>
    </div>

    <div class="col-auto">
        <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a>
    </div>
</div>
<hr class="mb-0">
<div class="row g-2 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <!-- Include the PHP code here -->
                <!-- ... PHP code from the previous response ... -->

                <!-- Start of the new search box and dropdown -->
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBoxPersonID" class="form-label">ค้นหารหัสบุคคล:</label>
                        <input type="text" class="form-control" id="searchBoxPersonID" placeholder="พิมพ์รหัสบุคคลที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxPID" class="form-label">ค้นหาเลขบัตรประชาชน:</label>
                        <input type="text" class="form-control" id="searchBoxPID" placeholder="พิมพ์เลขบัตรประชาชนที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxTitlename" class="form-label">ค้นหาคำนำหน้าชื่อ:</label>
                        <input type="text" class="form-control" id="searchBoxTitlename" placeholder="พิมพ์คำนำหน้าชื่อที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxName" class="form-label">ค้นหาชื่อ:</label>
                        <input type="text" class="form-control" id="searchBoxName" placeholder="พิมพ์ชื่อที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxSurname" class="form-label">ค้นหาสกุล:</label>
                        <input type="text" class="form-control" id="searchBoxSurname" placeholder="พิมพ์สกุลที่ต้องการค้นหา...">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBox" class="form-label">ค้นหาลักษณะความเหลื่อมล้ำ:</label>
                        <input type="text" class="form-control" id="searchBox" placeholder="พิมพ์คำที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="dispfrmnmeDropdown" class="form-label">ลักษณะความเหลื่อมล้ำ:</label>
                        <select class="form-select" id="dispfrmnmeDropdown">
                            <!-- Dropdown options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <label for="searchBoxEduLevel" class="form-label">ค้นหาระดับการศึกษา:</label>
                        <input type="text" class="form-control" id="searchBoxEduLevel" placeholder="พิมพ์ระดับการศึกษาที่ต้องการค้นหา...">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="edulevDropdown" class="form-label">ระดับการศึกษา:</label>
                        <select class="form-select" id="edulevDropdown">
                            <!-- Dropdown options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="searchBoxProvince" class="form-label">จังหวัด,อำเภอ,ตำบล:</label>
                        <input type="text" class="form-control" id="searchBoxProvince" placeholder="พิมพ์จังหวัด,อำเภอ,ตำบลที่ต้องการค้นหา...">
                    </div>
                </div>

                
                <table id="myTableAll" class="display responsive nowrap" style="width:100%">
                    <!-- Table headings in Thai language -->
                    <thead class="table-light">
                        <tr>




                            <th>#</th>
                            <th data-priority="2">รหัสบุคคล</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>รหัสคำนำหน้าชื่อ</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>เพศ</th>
                            <th>ศาสนา</th>
                            <th>ปีเดือนวันเกิด</th>
                            <th>อายุ</th>
                            <th>ที่อยู่ปัจจุบัน บ้านเลขที่</th>
                            <th>ถนน ซอย</th>
                            <th>หมู่ที่</th>
                            <th>จังหวัดอำเภอตำบล</th>
                            <th>รหัสไปรษณีย์</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>รหัสครัวเรือน (กรณี กรอกข้อมูลครัวเรือนให้กลับมาอัปเดตที่นี่ด้วย)</th>
                            <th>รหัสครัวเรือน (กรณี กรอกข้อมูลครัวเรือนให้กลับมาอัปเดตที่นี่ด้วย)</th>
                            <th>เป็นบุตรคนที่</th>
                            <th>นักเรียนอาศัยอยู่กับใคร</th>
                            <th>รหัสสถานภาพครอบครัว</th>
                            <th>การเดินทางจากที่พักอาศัยไปโรงเรียน (ระยะทาง กิโลเมตร/เมตร)</th>
                            <th>การเดินทางจากที่พักอาศัยไปโรงเรียน (เวลา ชั่วโมง/นาที)</th>
                            <th>ค่าใช้จ่ายในการเดินทางไป-กลับ (บาท/เดือน)</th>
                            <th>รหัสวิธีเดินทางหลัก</th>
                            <th>รายละเอียดเชิงคุณภาพ</th>
                            <th>รหัสลักษณะความเหลื่อมล้ำ</th>
                            <!-- button edit delete -->
                            <th>แก้ไข</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($results)) {
                            // Extract the data from the current row
                            $perid = $row['person_id'];
                            $pid = $row['national_id'];
                            $titnme = $row['title_name'];
                            $name = $row['name'];
                            $sname = $row['surname'];
                            $genname = $row['gender_name'];
                            $relionname = $row['religion_name'];
                            $brtdte = $row['birth_date'];
                            $age = $row['age'];
                            $adr = $row['address'];
                            $soi = $row['street'];
                            $vllid = $row['village_id'];
                            $plcnme = $row['place_name'];
                            $postcode = $row['postcode'];
                            $pertel = $row['phone_number'];
                            $hholdid = $row['household_id'];
                            $child_order = $row['child_order'];
                            $living_with = $row['living_with'];
                            $family_status = $row['family_status'];
                            $distance_km_m = $row['distance_km'] . "กม. " . $row['distance_m'] . "ม.";
                            $distance_hours = $row['distance_hours'];
                            $fare_per_month = $row['fare_per_month'];
                            $main_transportation_id = $row['main_transportation_id'];
                            $child_detail = $row['child_detail'];
                            $display_form = $row['display_form'];

                        ?>
                            <tr id="row_<?= $perid ?>">






                                <td><?= $counter ?></td>
                                <td><?= $perid ?></td>
                                <td><?= $pid ?></td>
                                <td><?= $titnme ?></td>
                                <td><?= $name ?></td>
                                <td><?= $sname ?></td>
                                <td><?= $genname ?></td>
                                <td><?= $relionname ?></td>
                                <td><?= $brtdte ?></td>
                                <td><?= $age ?></td>
                                <td><?= $adr ?></td>
                                <td><?= $soi ?></td>
                                <td><?= $vllid ?></td>
                                <td><?= $plcnme ?></td>
                                <td><?= $postcode ?></td>
                                <td><?= $pertel ?></td>
                                <td><?= $hholdid ?></td>
                                <td><?= $hholdid ?></td>
                                <td><?= $child_order ?></td>
                                <td><?= $living_with ?></td>
                                <td><?= $family_status ?></td>
                                <td><?= $distance_km_m ?></td>
                                <td><?= $distance_hours ?></td>
                                <td><?= $fare_per_month ?></td>
                                <td><?= $main_transportation_id ?></td>
                                <td><?= $child_detail ?></td>
                                <td><?= $display_form ?></td>
                                <!-- button edit delete -->
                                <td>

                                                                 <div class="btn-group" role="group">
                                    <a href="?page=<?= $_GET['page'] ?>&function=add&perid=<?= $perid ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="deletePerson(
                        '<?= $perid ?>', 
                        '<?= $name ?>', 
                        '<?= $sname ?>'
                    )" class="btn btn-sm btn-danger text-white ">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                                </td>
                            </tr>
                        <?php
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!-- End of your HTML code -->

<!-- ... Rest of your HTML and PHP code as before ... -->


<!-- Rest of your HTML and PHP code as before -->
<!-- delete person -->
<script>
    function deletePerson(id, name, lastName) {
        Swal.fire({
            title: "ลบข้อมูล",
            text: `คุณต้องการลบข้อมูลของ ${name} ${lastName} ใช่หรือไม่?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "ใช่, ลบข้อมูล",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                // Call the delete function here
                // deletePersonData(id);
            }
        });
    }

    function deletePersonData(id) {
        // Send an AJAX request to delete the person's data
        $.ajax({
            type: "POST",
            url: "2.person2/delete_person.php", // Replace with your delete script URL
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('#row_' + id).remove();
                    // Remove the deleted row from the DataTable
                    dataTable.row($(`tr[data-id="${id}"]`)).remove().draw();
                    Swal.fire("ลบข้อมูลสำเร็จ", "ข้อมูลถูกลบแล้ว", "success");
                } else {
                    Swal.fire("เกิดข้อผิดพลาด", "ไม่สามารถลบข้อมูลได้", "error");
                }
            },
            error: function(xhr, status, error) {
                Swal.fire("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้", "error");
            }
        });
    }
</script>

<script language=Javascript>
    $(document).ready(function() {
        // Function to get distinct values from the dispform table


        const dataTable = $('#myTableAll').DataTable({
            responsive: true,
            columnDefs: [{
                    responsivePriority: 2,
                    targets: 2
                },
                {
                    responsivePriority: 3,
                    targets: 3
                },
                {
                    responsivePriority: 4,
                    targets: 4
                },
                {
                    responsivePriority: 2,
                    targets: -1
                }
            ],

        });

        // Event listener to trigger the search on the dispfrmnme column when the dropdown or search box changes
        $('#searchBox, #dispfrmnmeDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBox').val().trim();
            const selectedValue = $('#dispfrmnmeDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(7).search(searchBoxValue || selectedValue).draw();
        });
        $('#searchBoxEduLevel, #edulevDropdown').on('keyup change', function() {
            const searchBoxValue = $('#searchBoxEduLevel').val().trim();
            const selectedValue = $('#edulevDropdown').val();

            // Perform the custom search based on the values in the search box and the dropdown
            dataTable.column(8).search(searchBoxValue || selectedValue).draw();
        });
        // Fetch the distinct dispfrmnme values from the get_dispform_values.php file and populate the dropdown options
        $.ajax({
            url: 'educations/get_dispform_values.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const dropdown = $('#dispfrmnmeDropdown');
                dropdown.empty();
                dropdown.append('<option value="">ทั้งหมด</option>'); // Add an option to show all values

                // Add the fetched dispfrmnme values to the dropdown
                data.forEach(function(value) {
                    dropdown.append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
        $.ajax({
            url: 'educations/get_edulev_values.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const dropdown = $('#edulevDropdown');
                dropdown.empty();
                dropdown.append('<option value="">ทั้งหมด</option>'); // Add an option to show all values

                // Add the fetched dispfrmnme values to the dropdown
                data.forEach(function(value) {
                    dropdown.append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
        $('#searchBoxPersonID, #searchBoxPID, #searchBoxTitlename, #searchBoxName, #searchBoxSurname').on('keyup', function() {
            const searchBoxPersonIDValue = $('#searchBoxPersonID').val().trim();
            const searchBoxPIDValue = $('#searchBoxPID').val().trim();
            const searchBoxTitlenameValue = $('#searchBoxTitlename').val().trim();
            const searchBoxNameValue = $('#searchBoxName').val().trim();
            const searchBoxSurnameValue = $('#searchBoxSurname').val().trim();

            // Perform the custom search based on the values in the search boxes
            dataTable
                .column(1).search(searchBoxPersonIDValue)
                .column(2).search(searchBoxPIDValue)
                .column(3).search(searchBoxTitlenameValue)
                .column(4).search(searchBoxNameValue)
                .column(5).search(searchBoxSurnameValue)
                .draw();
        });

        $('#searchBoxProvince').on('keyup', function() {
            const searchBoxProvinceValue = $('#searchBoxProvince').val().trim();


            // Perform the custom search based on the values in the search boxes
            dataTable
                .column(6).search(searchBoxProvinceValue)

                .draw();
        });
    });
</script>