<?php
@session_start();
$optid = $_SESSION['optid'];

$sql = "SELECT h.hhjobid, h.perid, p.pid, t.titnme, p.name, p.sname, h.hjobdte, h.hjobmoney, h.hjobobject, h.hjobknowledge, h.hjobtranfer, h.hjobdetail FROM hhelpjob h LEFT JOIN person p ON h.perid = p.perid LEFT JOIN titname t ON p.titid = t.titid;";

$results = mysqli_query($conn, $sql);
// Return the educational level name based on the given eduid



?>
<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ประวัติการช่วยเหลือด้านอาชีพ</h4>
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
                           
                                <th class="align-middle text-center">รหัสประวัติการช่วยเหลือด้านอาชีพ</th>
                                <th class="align-middle text-start" >รหัสบุคคล</th>
                                <th class="align-middle text-start" >คำนำหน้าชื่อ</th>
                                <th class="align-middle text-start" >ชื่อ</th>
                                <th class="align-middle text-start" >สกุล</th>
                                <th class="align-middle text-start" >วันที่ให้ความช่วยเหลือ</th>
                                <th class="align-middle text-start" >ให้เงินสด</th>
                                <th class="align-middle text-start" >ให้สิ่งของ/อุปกรณ์</th>
                                <th class="align-middle text-start" >ให้ความรู้</th>
                                <th class="align-middle text-start" >ส่งต่อให้หน่วยงาน</th>
                                <th class="align-middle text-start" >รายละเอียดการช่วยเหลือ</th>
                                <th class="align-middle text-start">แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the $results array to display the data in the table
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($results)) {
                                // Extract the data from the current row
                                $hhjobid = $row['hhjobid'];
                                $perid = $row['perid'];
                                $pid = $row['pid'];
                                $titnme = $row['titnme'];
                                $name = $row['name'];
                                $sname = $row['sname'];
                                $hjobdte = $row['hjobdte'];
                                $hjobmoney = $row['hjobmoney'];
                                $hjobobject = $row['hjobobject'];
                                $hjobknowledge = $row['hjobknowledge'];
                                $hjobtranfer = $row['hjobtranfer'];
                                $hjobdetail = $row['hjobdetail'];
                            ?>
                                <!-- Display the data in each row of the table -->
                                <!-- make tr set id with hhjobid -->
                                <tr id="row<?= $hhjobid ?>" data-id="<?= $hhjobid ?>">
                                   
                                <td class="align-middle text-center"><?= $hhjobid ?></td>
                                    <td class="align-middle text-start"><?= $perid ?></td>
                                    <td class="align-middle text-start"><?= $titnme ?></td>
                                    <td class="align-middle text-start"><?= $name ?></td>
                                    <td class="align-middle text-start"><?= $sname ?></td>
                                    <td class="align-middle text-start"><?= $hjobdte ?></td>
                                    <td class="align-middle text-start"><?= $hjobmoney ? 'ให้เงินสด' : 'ไม่ให้เงินสด' ?></td>
                                    <td class="align-middle text-start"><?= $hjobobject ? 'ให้สิ่งของ/อุปกรณ์' : 'ไม่ให้สิ่งของ/อุปกรณ์' ?></td>
                                    <td class="align-middle text-start"><?= $hjobknowledge ? 'ให้ความรู้' : 'ไม่ให้ความรู้' ?></td>
                                    <td class="align-middle text-start"><?= $hjobtranfer ? 'ส่งต่อให้หน่วยงาน' : 'ไม่ส่งต่อให้หน่วยงาน' ?></td>
                                    <td class="align-middle text-start"><?= $hjobdetail ?></td>
                                    <td class="align-middle text-center">
                                        <a href="?page=<?= $_GET['page'] ?>&function=edit&hhjobid=<?= $hhjobid ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" onclick="deletePerson2(<?= $hhjobid ?>, '<?= $name ?>', '<?= $sname ?>', 'hhelpjob', 'hhjobid')"><i class="fas fa-trash-alt"></i></button>   
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
                },
                responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 },
                { responsivePriority: 3, targets: -2 },
                { responsivePriority: 4, targets: -3 },
                { responsivePriority: 5, targets: -4 },
                { responsivePriority: 6, targets: -5 },
                { responsivePriority: 7, targets: -6 },
                { responsivePriority: 8, targets: -7 },
                { responsivePriority: 9, targets: -8 },
                { responsivePriority: 10, targets: -9 },
                { responsivePriority: 11, targets: -10 },
                { responsivePriority: 12, targets: -11 },
                { responsivePriority: 13, targets: -12 },
                { responsivePriority: 14, targets: -13 },
                { responsivePriority: 15, targets: -14 },
                { responsivePriority: 16, targets: -15 },
                { responsivePriority: 17, targets: -16 },
                { responsivePriority: 18, targets: -17 },
                { responsivePriority: 19, targets: -18 },
                { responsivePriority: 20, targets: -19 },
                { responsivePriority: 21, targets: -20 },
                { responsivePriority: 22, targets: -21 },
                { responsivePriority: 23, targets: -22 },
                { responsivePriority: 24, targets: -23 },
                { responsivePriority: 25, targets: -24 },
                { responsivePriority: 26, targets: -25 },
                { responsivePriority: 27, targets: -26 },
                { responsivePriority: 28, targets: -27 },
                { responsivePriority: 29, targets: -28 },
                { responsivePriority: 30, targets: -29 },
                { responsivePriority: 31, targets: -30 },
                { responsivePriority: 32, targets: -31 },
                { responsivePriority: 33, targets: -32 },
                { responsivePriority: 34, targets: -33 },
                { responsivePriority: 35, targets: -34 },
                { responsivePriority: 36, targets: -35 },
                { responsivePriority: 37, targets: -36 },
                { responsivePriority: 38, targets: -37 },
             
            ],
            }
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