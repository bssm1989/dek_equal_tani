<?php 
@session_start();
$ofcschool = $_SESSION['user_agency'];

// รายงานข้อมูลเด็กและห้องเรียน
// $sql = " SELECT COUNT(e.stu_id) AS stu_id,COUNT(DISTINCT(e.room_id)) AS room, ";
// $sql.= " COUNT(CASE WHEN stu_sex IN ('1') THEN 1 END) AS 'male', ";
// $sql.= " COUNT(CASE WHEN stu_sex IN ('2') THEN 1 END) AS 'famale' ";
// $sql.= " FROM `enrollments` e LEFT JOIN student s ON e.stu_id = s.stu_id ";
// $sql.= " where enroll_schid='$ofcschool'";
// $result = mysqli_query($conn,$sql);
// if($rows = mysqli_fetch_array($result)){
//     $stu_id = $rows["stu_id"];
//     $room = $rows["room"];
//     $male = $rows["male"];
//     $famale = $rows["famale"];
// }

// echo $sql;


// รายงานข้อมูลแน้วโน้นรายปี เด็กลงทะเบียน
// $sql = "SELECT `enroll_year`,COUNT(*) as num FROM `enrollments` ";
// $sql.= " where enroll_schid=$ofcschool";
// $sql.= " GROUP BY `enroll_year` ";
// // echo $sql;
// $query = mysqli_query($conn,$sql);
// $label = array();
// $data = array();
// foreach($query as $key => $value){
// 	$label[] = $value['enroll_year'];
//     $data[] = $value['num'];
// }
//print_r(json_encode($label,true));

// รายงานแสดงข้อมูลเด็กลงทะเบียน แยกตามเพศ
// $sql = " SELECT `enroll_year`,COUNT(CASE WHEN stu_sex IN ('1') THEN 1 END) AS 'male', COUNT(CASE WHEN stu_sex IN ('2') THEN 1 END) AS 'famale' ";
// $sql.= " FROM `enrollments` e LEFT JOIN student s ON e.stu_id = s.stu_id ";
// $sql.= " where enroll_schid=$ofcschool";
// $sql.= " GROUP BY `enroll_year` ";
//  //echo $sql;
// $query = mysqli_query($conn,$sql);
// $label_sex = array();
// $data_sex1 = array();
// $data_sex2 = array();
// foreach($query as $key => $value){
// 	$label_sex[] = $value['enroll_year'];
//     $data_sex1[] = $value['male'];
//     $data_sex2[] = $value['famale'];
// }
//print_r(json_encode($label,true));

?>

<div class="app-card alert alert-dismissible shadow-sm mb-3 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">ยินดีตอนรับเข้าสู่ระบบ</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-12">

                    <div>ฐานข้อมูลเด็กที่มีความเหลื่อมล้ำทางการศึกษา</div>
                </div>
                <!--//col-->
                <!-- <div class="col-12 col-lg-3"> -->
                <!-- <a class="btn app-btn-primary"
                        href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/"><svg
                            width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down me-2"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                            <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                            <path fill-rule="evenodd"
                                d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z" />
                        </svg>Free Download</a> -->
                <!-- </div> -->
                <!--//col-->
            </div>
            <!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!--//app-card-body-->

    </div>
    <!--//inner-->
</div>
<!--//app-card-->

<div class="row g-4 mb-3">
    <div class="col-6 col-lg-6">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">บุคคลทั้งหมด</h4>
                <div class="stats-figure"><?php echo $stu_id; ?></div>
                <div class="stats-meta text-success">
                    <!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                    </svg>--> คน
                </div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->

    <div class="col-6 col-lg-6">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">เด็กเหลื่อมล้ำทางการศึกษา</h4>
                <div class="stats-figure"><?php echo $male; ?></div>
                <div class="stats-meta text-success">
                    <!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                    </svg> --> คน
                </div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    
    <!--//col-->
</div>
<!--//row-->


<div class="row g-4 mb-3">
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">แสดงกราฟแนวโน้มรายปี</h4>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href=".?page=enrolls">แสดงข้อมูล</a>
                        </div>
                        <!--//card-header-actions-->
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <!-- <div class="mb-3 d-flex">
                    <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                        <option value="1" selected>This week</option>
                        <option value="2">Today</option>
                        <option value="3">This Month</option>
                        <option value="3">This Year</option>
                    </select>
                </div> -->
                <div class="chart-container">
                    <canvas id="canvas-linechart"></canvas>
                </div>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">แสดงกราฟรายปี จำแนกตามเพศ</h4>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <div class="card-header-action">
                            <!-- <a href="charts.html">แสดงข้อมูล</a> -->
                        </div>
                        <!--//card-header-actions-->
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <!-- <div class="mb-3 d-flex">
                    <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                        <option value="1" selected>This week</option>
                        <option value="2">Today</option>
                        <option value="3">This Month</option>
                        <option value="3">This Year</option>
                    </select>
                </div> -->
                <div class="chart-container">
                    <canvas id="canvas-barchart"></canvas>
                </div>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->

</div>
<!--//row-->


<script>
'use strict';

/* Chart.js docs: https://www.chartjs.org/ */

window.chartColors = {
    green: '#75c181',
    gray: '#a9b5c9',
    text: '#252930',
    border: '#e7e9ed'
};

/* Random number generator for demo purpose */
var randomDataPoint = function() {
    return Math.round(Math.random() * 10000)
};


//Chart.js Line Chart Example 

var lineChartConfig = {
    type: 'line',

    data: {
        labels: <?php echo json_encode($label) ?>,

        datasets: [{
            label: 'กลุ่มเปราะบาง (คน)',
            fill: false,
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            data: <?php echo json_encode($data) ?>,

        }]
    },
    options: {
        responsive: true,
        aspectRatio: 1.5,

        legend: {
            display: true,
            position: 'bottom',
            align: 'end',
        },

        title: {
            display: false,
            text: 'Chart.js Line Chart Example',

        },
        tooltips: {
            mode: 'index',
            intersect: false,
            titleMarginBottom: 10,
            bodySpacing: 10,
            xPadding: 16,
            yPadding: 16,
            borderColor: window.chartColors.border,
            borderWidth: 1,
            backgroundColor: '#fff',
            bodyFontColor: window.chartColors.text,
            titleFontColor: window.chartColors.text,

            callbacks: {
                //Ref: https://stackoverflow.com/questions/38800226/chart-js-add-commas-to-tooltip-and-y-axis
                label: function(tooltipItem, data) {
                    if (parseInt(tooltipItem.value) >= 1000) {
                        return "กลุ่มเปราะบาง " + tooltipItem.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                            ",") + ' คน';
                    } else {
                        return 'กลุ่มเปราะบาง ' + tooltipItem.value + ' คน';
                    }
                }
            },

        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: false,

                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: false,
                },
                ticks: {
                    beginAtZero: true,
                    userCallback: function(value, index, values) {
                        return value
                            .toLocaleString(); //Ref: https://stackoverflow.com/questions/38800226/chart-js-add-commas-to-tooltip-and-y-axis
                    }
                },
            }]
        }
    }
};



// Chart.js Bar Chart Example 

var barChartConfig = {
    type: 'bar',

    data: {
        labels: <?php echo json_encode($label_sex) ?>,
        datasets: [{
                label: 'ชาย',
                borderDash: [3, 5],
                backgroundColor: "rgba(117,193,129,0.8)",
                hoverBackgroundColor: "rgba(117,193,129,1)",
                // backgroundColor: window.chartColors.green,
                // borderColor: window.chartColors.green,
                // borderWidth: 1,
                // maxBarThickness: 50,

                data: <?php echo json_encode($data_sex1) ?>
            },
            {
                label: 'หญิง',
                borderDash: [3, 5],
                backgroundColor: "rgba(91,153,234,0.8)",
                hoverBackgroundColor: "rgba(91,153,234,1)",
                // backgroundColor: window.chartColors.blue,
                // borderColor: window.chartColors.blue,
                // borderWidth: 1,
                // maxBarThickness: 50,


                data: <?php echo json_encode($data_sex2) ?>
            }
        ]
    },
    options: {
        responsive: true,
        aspectRatio: 1.5,
        legend: {
            position: 'bottom',
            align: 'end',
        },
        title: {
            display: false,
            text: 'Chart.js Bar Chart Example'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            titleMarginBottom: 10,
            bodySpacing: 10,
            xPadding: 16,
            yPadding: 16,
            borderColor: window.chartColors.border,
            borderWidth: 1,
            backgroundColor: '#fff',
            bodyFontColor: window.chartColors.text,
            titleFontColor: window.chartColors.text,

        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },

            }],
            yAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.borders,
                },


            }]
        }

    }
}







// Generate charts on load
window.addEventListener('load', function() {

    var lineChart = document.getElementById('canvas-linechart').getContext('2d');
    window.myLine = new Chart(lineChart, lineChartConfig);

    var barChart = document.getElementById('canvas-barchart').getContext('2d');
    window.myBar = new Chart(barChart, barChartConfig);


});
</script>