<?php 
    session_start();
    $ofcid   = $_SESSION['ofcid'];
    $ofcname = $_SESSION['ofcnme'];
    $pio = $_SESSION['pio'];

    require './service/connect.php';
    require './service/commonFns.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require './includes/head.php'; ?>
</head>
<!--//app-header-->

<?php if(isset($_SESSION['staffid']) && !empty($_SESSION['staffid'])) : ?>
  <!-- /** แทบเมนูสำหรับ Admin  */ -->
  <?php if(!empty($_SESSION['staffprioid']) && $_SESSION['staffprioid'] == '1') : ?>
    <!-- /** ข้อมูลสำหรับผู้ดูแลระบบ */ -->
    <body class="app">
        <?php require './includes/header_admin.php'; ?>
        <!--//app-wrapper-->
        <div class="app-wrapper">
            <!--//app-content-->
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <?php 
                        if(!isset($_GET['page']) && empty($_GET['page'])){
                            require 'dashboard/index.php';
                        }else if(isset($_GET['page']) && $_GET['page'] == 'persons'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require 'persons/person_form_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'persons/person_form_edit.php';
                                //require 'enrolls/enroll_form_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                                require 'persons/person_form_delete.php';
                            }else{
                                require 'persons/index.php';
                            }
                            // require 'persons/index.php';
                        }else if(isset($_GET['page']) && $_GET['page'] == 'managers'){
                                if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                    require 'managers/user_form_add.php';
                                }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                    require 'managers/user_form_edit.php';
                                }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                                    require 'managers/user_form_delete.php';
                                }else{
                                    require 'managers/index.php';
                                }
                            
                        }else if(isset($_GET['page']) && $_GET['page'] == 'admin_profile'){
                            require 'admin_profile/index.php';
                        }else if(isset($_GET['page']) && $_GET['page'] == 'logout'){
                            require 'logout/index.php';
                        }
                    ?>

                </div>
                <!--//container-fluid-->
            </div>
            <!--//app-footer-->
            <?php require 'includes/footer.php'; ?>
        </div>
        <!-- Javascript -->
        <?php require 'includes/script.php'; ?>
    </body>
    <?php else: ?> <!-- /** ถ้าไม่ใช่ แทบเมนูสำหรับ Admin ให้ไปแท็บเมนู ผู้ใช้ทั่วไป  */ -->
        <!-- /** ข้อมูลสำหรับผู้ใข้ */ -->
      <body class="app">
        <?php require './includes/header.php'; ?>
        <!--//app-wrapper-->
        <div class="app-wrapper">
            <!--//app-content-->
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <?php 
                        if(!isset($_GET['page']) && empty($_GET['page'])){
                            require 'dashboard/index.php';
                        }else if(isset($_GET['page']) && $_GET['page'] == 'person_add'){                            
                                require 'person_add/person_form_add.php';
                            // require 'persons/index.php';
                        }else if(isset($_GET['page']) && $_GET['page'] == 'persons'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require 'persons/person_form_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'persons/person_form_edit.php';
                                //require 'enrolls/enroll_form_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                                require 'persons/person_form_delete.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'elderly'){
                                require 'persons/view_elderly.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'disabled'){
                                require 'persons/view_disabled.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'orphan'){
                                require 'persons/view_orphan.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'widow'){
                                require 'persons/view_widow.php';
                            }else{
                                require 'persons/index.php';
                            }
                            // require 'persons/index.php';
                        }else if(isset($_GET['page']) && $_GET['page'] == 'visit'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require 'visit/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'visit/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                            }else{
                                require 'visit/index.php';
                            }
                            
                        }else if(isset($_GET['page']) && $_GET['page'] == 'childs'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require 'childs/child_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'childs/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                            }else{
                                require 'childs/index.php';
                            }
                            
                        }else if(isset($_GET['page']) && $_GET['page'] == '2.person2'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require '2.person2/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require '2.person2/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                            }else{
                                require '2.person2/index.php';
                            }
                            
                        }else if(isset($_GET['page']) && $_GET['page'] == 'child'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require 'child/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'child/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                            }else{
                                require 'child/index.php';
                            }
                            
                        }else if(isset($_GET['page']) && $_GET['page'] == 'educations'){
                            if(isset($_GET['page']) && $_GET['function'] == 'add'){
                                require 'educations/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'educations/qtn_visit_add.php';
                            }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                            }else{
                                require 'educations/index.php';
                            }
                            
                        }
                    else if(isset($_GET['page']) && $_GET['page'] == '4.works'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '4.works/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '4.works/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '4.works/index.php';
                        }
                        
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '6.1institute'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '6.1institute/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '6.1institute/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '6.1institute/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '6.2inststay'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '6.2inststay/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '6.2inststay/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '6.2inststay/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '5.helpeducation'){
                     
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '5.helpeducation/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '5.helpeducation/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '5.helpeducation/index.php';
                           
                        }

                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '3.historyeducation'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '3.historyeducation/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '3.historyeducation/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '3.historyeducation/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '7history_help_job'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '7history_help_job/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '7history_help_job/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '7history_help_job/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '8.htraining'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '8.htraining/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '8.htraining/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '8.htraining/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '9.hfolowup'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '9.hfolowup/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '9.hfolowup/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '9.hfolowup/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '10.activity'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '10.activity/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '10.activity/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '10.activity/index.php';
                        }
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == '11.staff'){
                        if(isset($_GET['page']) && $_GET['function'] == 'add'){
                            require '11.staff/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'update'){
                            require '11.staff/qtn_visit_add.php';
                        }else if(isset($_GET['page']) && $_GET['function'] == 'delete'){
                        }else{
                            require '11.staff/index.php';
                        }
                    }
                    
                        else if(isset($_GET['page']) && $_GET['page'] == 'profile'){
                            if(isset($_GET['page']) && $_GET['function'] == 'update'){
                                require 'profile/hygienist_form.php';
                            }else{
                                require 'profile/index.php';
                            }                            
                        }else if(isset($_GET['page']) && $_GET['page'] == 'logout'){
                            require 'logout/index.php';
                        }
                    ?>

                </div>
                <!--//container-fluid-->
            </div>
            <!--//app-footer-->
            <?php require 'includes/footer.php'; ?>
        </div>
        <!-- Javascript -->
        <?php require 'includes/script.php'; ?>
    </body>
    <?php endif; ?>
<?php else: ?>
  <?php require './login.php'; ?>
<?php endif; ?>
</html>

