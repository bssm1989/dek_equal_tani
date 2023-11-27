<?php 
    @session_start();
    $optid = $_SESSION['optid'];

    $sql = "SELECT * FROM staff
           
            LEFT JOIN titname ON staff.titid = titname.titid
            -- LEFT JOIN const_vllnmegen ON staff.plcid = const_vllnmegen.plcid
            LEFT JOIN staffpos ON staff.staffposid = staffpos.staffposid
            LEFT JOIN staffprio ON staff.staffprioid = staffprio.staffprioid";
    $results = mysqli_query($conn, $sql);
?>

<div class="row justify-content-between card-header text-right mb-0">
    <div class="col-auto">
        <h4 class="app-page-title mb-0">ข้อมูลผู้ใช้งานโปรแกรม</h4>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-primary text-white"><i class="fas fa-plus"></i>
            เพิ่มข้อมูลใหม่</a>
    </div>
</div>
<hr class="mb-0">
<div class="row g-2 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <table class="table responsive nowrap" id="staffTable">
                    <thead class="table-light">
                        <tr>
                            
                        
                        
                        
                        
                        
                        
                        
                        
                        <th class="align-middle text-center">#</th>
                            <th class="align-middle text-center">รหัสผู้ใช้งาน</th>
                            <th class="align-middle text-center">เลขบัตรประชาชน</th>
                            <th class="align-middle text-center">รหัสคำนำหน้าชื่อ</th>
                            <th class="align-middle text-start">ชื่อ</th>
                            <th class="align-middle text-start">สกุล</th>
                            <th class="align-middle text-center">เบอร์โทรศัพท์</th>
                            <th class="align-middle text-center">อีเมล์</th>
                            <th class="align-middle text-center">หน่วยงานที่สังกัด</th>
                            <th class="align-middle text-center">จังหวัดอำเภอตำบล หน่วยงานที่สังกัด</th>
                            <th class="align-middle text-center">รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้</th>
                            <th class="align-middle text-center">รหัสสิทธิการเข้าถึงข้อมูล</th>
                            <th class="align-middle text-center">ดำเนินการ</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $n = 0;
                            foreach ($results as $row) {
                                $n++;
                        ?>
                        <tr id="row<?= $row['staffid'] ?>" data-id="<?= $row['staffid'] ?>">
                           
                        
                        
                        
                        
                        
                     
                        <td class="align-middle text-center"><?= $n ?></td>
                            <td class="align-middle text-center"><?= $row['staffid'] ?></td>
                            <td class="align-middle text-center"><?= $row['pid'] ?></td>
                            <td class="align-middle text-center"><?= $row['titid'] ?></td>
                            <td class="align-middle text-start"><?= $row['staffnme'] ?></td>
                            <td class="align-middle text-start"><?= $row['staffsnme'] ?></td>
                            <td class="align-middle text-center"><?= $row['stafftell'] ?></td>
                            <td class="align-middle text-center"><?= $row['staffemail'] ?></td>
                            <td class="align-middle text-center"><?= $row['stafforg'] ?></td>
                            <td class="align-middle text-center"><?= $row['plcid'] ?></td>
                            <td class="align-middle text-center"><?= $row['staffposid'] ?></td>
                            <td class="align-middle text-center"><?= $row['staffprioid'] ?></td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-warning text-white " data-staffid="<?= $row['staffid'] ?>">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger text-white "  onclick="deletePerson2('<?= $row['staffid'] ?>', '<?= $row['staffnme'] ?>', '<?= $row['staffsnme'] ?>', 'staff', 'staffid')">                                       
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group">
                                        <a href="?page=<?= $_GET['page'] ?>&function=add&staff=<?= $row['staffid'] ?>" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger text-white" onclick="deletePerson2('<?= $actid ?>', '<?= $actnme ?>', '<?= $actdetail ?>', 'activity', 'actid')"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--//app-card-body-->

        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->

<!-- Include DataTables library and initialization script -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable

        $('#staffTable').DataTable({
            language: {
                "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                //"info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                "info": "แสดง _START_ - _END_ จากทั้งหมด _TOTAL_ รายการ",
                "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": 'ค้นหา',
                "paginate": {
                    "previous": "ก่อนหน้านี้",
                    "next": "หน้าต่อไป"
                }
            },
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
        // Add click event for addStaffBtn
        $('#addStaffBtn').click(function() {
            // Redirect to add staff page
            window.location.href = 'add_staff.php';
        });

        // Add click events for edit and delete buttons
        $('.editStaffBtn').click(function() {
            var staffId = $(this).data('staffid');
            // Redirect to edit staff page with staffId parameter
            window.location.href = 'edit_staff.php?staffid=' + staffId;
        });

      
    });
</script>
