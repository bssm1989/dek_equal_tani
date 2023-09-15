<!-- Javascript -->
<script src="./assets/assets/plugins/popper.min.js"></script>
<script src="./assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Charts JS -->
<script src="./assets/assets/plugins/chart.js/chart.min.js"></script>
<!-- <script src="../../assets/assets/js/index-charts.js"></script> -->

<!-- Page Specific JS -->
<script src="./assets/assets/js/app.js"></script>

<!-- datatables JS -->
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script>
                            function deletePerson2(id, name, lastName, table, fillId) {
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
                                        deletePersonData(id, table, fillId);
                                    }
                                });
                            }

                            function deletePersonData(id, table, fillId) {
                                // Send an AJAX request to delete the person's data
                                $.ajax({
                                    type: "POST",
                                    url: "3.historyeducation/delete_person.php", // Replace with your delete script URL
                                    data: {
                                        id: id,
                                        table: table,
                                        fillId: fillId

                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.success) {
                                            var childRow = $(`tr[data-id="${id}"]`).next('.child');
                                            if (childRow.length) {
                                                childRow.remove();
                                            }

                                            // Remove the deleted row from the DataTable
                                            $(`tr[data-id="${id}"]`).remove();

                                            // Remove the HTML row
                                            $(`tr[data-id="${id}"]`).remove();
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