<h4 class="card-header text-right"><i class="fas fa-user-cog"></i> ผู้ดูแลระบบ</h4>
<a href="admin_user_form.php" class="btn btn-primary mt-1 text-white">
    <i class="fas fa-plus"></i>
    เพิ่มข้อมูล
</a>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body">
                <!-- ?php print_r($_POST); ?> -->
                <div id="showSql"></div>
                <form name="frmUserSearch" id="frmUserSearch" method="post" action="" enctype=""
                    onSubmit="" target="">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" class="form-control" id="ofcnme" name="ofcnme"
                                    placeholder="ชื่อ-นามสกุล" required>
                                <select class="form-control" name="agency" id="agency" required>
                                    <?php
                                    $sql = "select schid,schnme from constschool order by schid,schnme";
                                    $result = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?=$row["schid"];?>"
                                        <?php if ($rows["agency"]==$row["schid"]) echo "selected";?>>
                                        <?=$row["schnme"];?></option>
                                    <?php } ?>
                                </select>
                                <button class="btn btn-success text-white" type="button"
                                    onClick="showUser('1','20');">ค้นหา</button>
                                <button class="btn btn-secondary text-white" type="reset"
                                    onClick="showUser('1','20');">เคลียร์</button>
                            </div>
                        </div>

                    </div>

                    <hr class="mb-2">

                    <div id="showUser">
                        <?php
                            //$linkd = "where a.plcidgen like '".$province2."%'";

                            $sql = "select count(ofcid) as num from ofcusers";
                            $results = mysqli_query($conn,$sql);
                            if($rows = mysqli_fetch_array($results)) $numRows = (int)$rows["num"];

                            if(!$perPage) {$perPage =20; } else {$perPage=$perPage;} //จำนวนแถวที่ต้องการแสดงแต่ละหน้า
                            if(!$page) { $page=1;} else {$page=$page;}

                            $prevPage = $page-1;
                            $nextPage = $page+1;

                            $pageStart = ($perPage*$page)-$perPage;

                            //echo "Num_Rows=".$Num_Rows;
                        //หาจำนวนหน้าทั้งหมดที่จะต้องแสดง
                            if($numRows<=$perPage) { $numPages =1; } //กรณีจำนวนแถวที่ได้จากฐานข้อมูล น้อยกว่า จำนวนหน้าที่เซ็ตไว้ แสดงว่ามีแค่ 1 หน้า
                            else if(($numRows % $perPage)==0) { $numPages =($numRows/$perPage);} //กรณีจำนวนแถวที่ได้จากฐานข้อมูล หาร จำนวนหน้าที่เซ็ตไว้ ลงตัว
                            else { $numPages =($numRows/$perPage) +1; }

                            $numPages = (int)$numPages;

                            if(($page>$numPages) || ($page<0)) { echo "<center><b>เลขหน้าที่เลือก ( ".$page." ) มากกว่าจำนวนหน้าที่มีอยู่จริง ( ".$numPages." ) --> ไม่มีข้อมูล<b></center> ";}

                            $sql = "select ofcid,username,ofcnme,schnme,email,updated_at,permission "; //pid,
                            $sql.= " from ofcusers a left join constschool e on a.agency=e.schid";
                            $sql.= " order by ofcnme";
                            $sql.= " limit $pageStart , $perPage";
                    //ส่วนแสดงผล
                            $results = mysqli_query($conn,$sql);

                            $p = 1;

                            echo "<table class='table table-bordered'>";
                            echo "<tr>";
                            echo    "<strong>ผลการค้นหาบุคคล</strong>";
                            echo "</tr>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "    <th scope='col'>#</th>";
                            echo "    <th scope='col'>ชื่อผู้ใช้งาน</th>";
                            echo "    <th scope='col'>ชื่อ-นามสกุล</th>";
                            echo "    <th scope='col'>หน่วยงาน/ศูนย์ฯ</th>";
                            //echo "    <th scope='col'>อีเมล</th>";
                            echo "    <th scope='col'>ใช้งานล่าสุด</th>";
                            echo "    <th scope='col'>สิทธิ์เข้าใช้งาน</th>";
                            echo "    <th scope='col'>จัดการ</th>";
                            echo "  </tr>";
                            echo "</thead>";

                            $n = 0;
                        // เริ่มวนรอบแสดงข้อมูล
                            while ($rows = mysqli_fetch_array($results))
                            {
                                $fno				= ++$n;
                                $ofcid 		= $rows["ofcid"];
                                $username 		= $rows["username"];
                                $ofcnme			= $rows["ofcnme"];
                                $schnme			= $rows["schnme"];
                                //$email 		    = $rows["email"];
                                $updated_at 	= $rows["updated_at"];
                                $permission 		= $rows["permission"];

                                if($permission == '1'){
                                    $permission = "Super Admin";
                                }else if($permission == '2'){
                                    $permission = "Admin";
                                }else{
                                    $permission = "User";
                                }

                                echo "<tbody>";
                                echo "  <tr";
                                        if(($p % 2)==0){
                                echo				"'";
                                            }
                                echo "  >";
                                echo "    <th scope='row'>".$fno."</th>";
                                echo "    <th scope='row'>".$username."</th>";
                                echo "    <td>".$ofcnme."</td>";
                                echo "    <td>".$schnme."</td>";
                                //echo "    <td>".$email."</td>";
                                echo "    <td>".$updated_at."</td>";
                                echo "    <td>".$permission."</td>";
                                // echo "    <td><a href='person_form.php?perid=".$ofcid."' target='_blank'><i class='far fa-edit'></i></a></td>";
                                echo "<td><div class='btn-group' role='group'>
                                        <a href='admin_user_form.php?id=".$ofcid."' type='button' class='btn btn-warning text-white'>
                                            <i class='far fa-edit'></i> แก้ไข
                                        </a>
                                        <a href='admin_user_form.php?id=".$ofcid."' type='button' class='btn btn-sm btn-danger text-white text-white'>
                                        <i class='far fa-trash-alt'></i> ลบ
                                        </a>
                                    </div></td>";
                                echo "  </tr>";
                                $p++;
                            } //close while
                            echo "</tbody>";
                            echo "</table>";
                            //echo "<hr class='mb-0'>";
                            echo	"<div align='center'>";
                            echo    "<input type='hidden' name ='prevPageButton'  value = ".$prevPage.">";
                            echo    "<input type='hidden' name ='nextPageButton'  value = ".$nextPage.">";
                            echo    "<input type='hidden' name ='lastPagesButton'  value = ".$numPages.">";
                            echo    "มีทั้งหมด ".$numRows." คน  จำนวนรายการต่อหน้า";
                            echo    "<input name = 'perPageText' type='text' value='$perPage' size = '2'><input type='button' value='แสดง' onClick='showUser(\"1\",window.document.frmSearchPerson.perPageText.value);'>";;
                            echo    "&nbsp;&nbsp;";
                            echo    "หน้าที่ : <select name = 'pageNoSelect'>";
                                        for($i=1;$i<=$numPages;$i++){ //สร้าง list เพื่อให้ผู้ใช้งานเลือกชมหน้าข้อมูล
                            echo	 		"<option  ";
                                                if($page==$i) {
                            echo					 "selected";
                                                }
                            echo			" value=".$i." >". $i;
                                        }

                            echo	"</select>  ของทั้งหมด  ".$numPages." หน้า";
                            echo	"&nbsp;<input type='button' value='แสดง' onClick='showUser(window.document.frmSearchPerson.pageNoSelect.value,window.document.frmSearchPerson.perPageText.value);'>";
                            //echo 	"<br>";
                            echo  "<input type='button' value='<<หน้าแรก' onClick='showUser(\"1\",window.document.frmSearchPerson.perPageText.value);'>";
                            echo	"<input type='button' value='<ก่อนหน้า' onClick='showUser(window.document.frmSearchPerson.prevPageButton.value,window.document.frmSearchPerson.perPageText.value);'>";
                            echo	"<input type='button' value='ถัดไป>' onClick='showUser(window.document.frmSearchPerson.nextPageButton.value,window.document.frmSearchPerson.perPageText.value);'>";
                            echo	"<input type='button' value='หน้าสุดท้าย>>' onClick='showUser(window.document.frmSearchPerson.lastPagesButton.value,window.document.frmSearchPerson.perPageText.value);'>";
                            echo    "</div>";

                            
                        ?>
                    </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->