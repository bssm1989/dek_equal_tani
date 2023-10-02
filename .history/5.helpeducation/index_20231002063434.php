<?php
@session_start();
$optid = $_SESSION['optid'];

// Make sure to update the database connection settings if needed

// Replace the empty SQL query with your modified query to fetch data from the person, hwork, and prv tables, and join them accordingly.
// You will need to adjust the JOIN conditions based on your table structure.
$sql = "SELECT 
            h.hwrkid, p.pid as person_id,
            p.name,
            p.sname,
             h.occid as occupation_id, h.wrknme as workplace_name, 
            prv.prvnme as province_name, h.wrkpos as workplace_position, h.wrkstarty as start_year, 
            h.wrkperiody as work_period_years, h.wrkperiodm as work_period_months, 
            h.wrkendy as end_year, h.wrkendreas as end_reason , df.dispfrmnme as dispfrmnme
        FROM 
            hwork h
        LEFT JOIN 
            person p ON h.perid = p.perid
        LEFT JOIN 
            prv ON h.prvid = prv.prvid
            LEFT JOIN 
            disptyp dt ON p.perid = dt.perid
        LEFT JOIN 
            dispform df ON dt.dispfrmid = df.dispfrmid";

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
        <h4 class="app-page-title mb-0">ข้อมูลประวัติการประกอบอาชีพ</h4>
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

                <form name="frmUserSearch" id="frmUserSearch" method="post" action="" enctype="" onSubmit="" target="">
                    <table class="table responsive nowrap" id="myTableAll">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle text-center" scope='col'>#</th>
                                <th class="align-middle text-start" scope='col'>รหัสประวัติการช่วยเหลือด้านการศึกษา</th>

                                <th class="align-middle text-start" scope='col'>รหัสบุคคล</th>
                                <th class="align-middle text-start" scope='col'>คำนำหน้าชื่อ</th>
                                <th class="align-middle text-start" scope='col'>ชื่อ</th>
                                <th class="align-middle text-start" scope='col'>สกุล</th>
                                <th class="align-middle text-start" scope='col'>ระดับการศึกษาขณะที่ได้รับการช่วยเหลือ</th>
                                <th class="align-middle text-start" scope='col'>ชั้นปีที่ได้รับทุน</th>
                                <th class="align-middle text-start" scope='col'>ปีการศึกษาที่ได้รับทุน</th>
                                <th class="align-middle text-start" scope='col'>เป็นทุนรายเดือนหรือปีหรือครั้งคราว</th>
                                <th class="align-middle text-start" scope='col'>จำนวนเงินที่ได้รับต่อครั้ง</th>
                                <th class="align-middle text-start" scope='col'>รายละเอียดอื่น ๆ</th>
                                <th>แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the $results array to display the data in the table
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($results)) {
                                // Extract the data from the current row
                                $hheduid = $row['hheduid'];
                                $perid = $row['perid'];
                                $eduid = $row['eduid'];
                                $titnme = $row['titnme'];
                                $name = $row['name'];
                                $sname = $row['sname'];
                                $hedulev = $row['hedulev'];
                                $hedusemester = $row['hedusemester'];
                                $hedufundtyp = $row['hedufundtyp'];
                                $hedumoney = $row['hedumoney'];
                                $hedudetail = $row['hedudetail'];
                            ?>
                                <!-- Display the data in each row of the table -->
                                <tr id="row<?= $hheduid ?>" data-id="<?= $hheduid ?>">
                                    <td class="align-middle text-center"><?= $counter ?></td>
                                    <td class="align-middle text-start"><?= $hheduid ?></td>
                                    <td class="align-middle text-start"><?= $perid ?></td>
                                    <td class="align-middle text-start"><?= $titnme ?></td>
                                    <td class="align-middle text-start"><?= $name ?></td>
                                    <td class="align-middle text-start"><?= $sname ?></td>
                                    <td class="align-middle text-start"><?= getEducationLevel($eduid) ?></td>
                                    <td class="align-middle text-start"><?= $hedulev ?></td>
                                    <td class="align-middle text-start"><?= $hedusemester ?></td>
                                    <td class="align-middle text-start"><?= $hedufundtyp === 1 ? 'รายเดือน' : ($hedufundtyp === 2 ? 'รายปี' : 'รายครั้งคราว') ?></td>
                                    <td class="align-middle text-start"><?= $hedumoney ?></td>
                                    <td class="align-middle text-start"><?= $hedudetail ?></td>
                                    <td>
                                    <div class="btn-group" role="group">
                                        <a href="?page=<?= $_GET['page'] ?>&function=add&perid=<?= $ ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger text-white"
                                            onclick="deletePerson2(
                                                '<?= $hheduid ?>',
                                                '<?= $name ?>',
                                                '<?= $sname ?>',
                                                'hhelpedu',
                                                'hheduid'
                                            );">
                                            <i class="fas fa-trash"></i>
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
                    <!-- </form> -->
                </form>
                <!--//app-card-body-->

            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->
<?php
mysqli_close($conn);
?>


<!-- Rest of your HTML and PHP code as before -->
<script language=Javascript>
    $(document).ready(function() {
        // Function to get distinct values from the dispform table


        const dataTable = $('#myTableAll').DataTable({
            language: {
                "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                "info": "แสดง _START_ - _END_ จากทั้งหมด _TOTAL_ รายการ",
                "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": 'ค้นหา',
                "paginate": {
                    "previous": "ก่อนหน้านี้",
                    "next": "หน้าต่อไป"
                }
          
        }, responsive: true,
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