<?php 
@session_start();
$optid = $_SESSION['optid'];

// Make sure to update the database connection settings if needed

// Replace the empty SQL query with a query to fetch data from the "person" table
$sql = "SELECT * FROM person";

// Execute the SQL query and fetch the results into the $results array
// You will need to replace the $conn variable with your database connection variable
$results = mysqli_query($conn, $sql);

// Function to calculate age based on birthdate (you can keep this function as it is)
function getAge($birthdate) {
    // Function logic to calculate age based on the given birthdate
    // ...
    // Return the calculated age
    // return $age;
}

// Function to format date in Thai style (you can keep this function as it is)
function getDateTimeDMY($datetime) {
    // Function logic to format date in Thai style (Day Month Year)
    // ...
    // Return the formatted date
    // return $formatted_date;
}
?>

<!-- Rest of your HTML and PHP code as before -->

<!-- Modify the table headings and column names to Thai language -->
<thead class="table-light">
    <tr>
        <th class="align-middle text-center" scope='col'>#</th>
        <th class="align-middle text-start" scope='col'>ชื่อ</th>
        <th class="align-middle text-start" scope='col'>สกุล</th>
        <th class="align-middle text-center" scope='col'>อายุ</th>
        <th class="align-middle text-start" scope='col'>ที่อยู่ปัจจุบัน</th>
        <th class="align-middle text-start" scope='col'>ซอย</th>
        <th class="align-middle text-start" scope='col'>หมู่ที่</th>
        <th class="align-middle text-start" scope='col'>จังหวัด</th>
        <th class="align-middle text-start" scope='col'>อำเภอ</th>
        <th class="align-middle text-start" scope='col'>ตำบล</th>
        <th class="align-middle text-center" scope='col'>รหัสไปรษณีย์</th>
        <th class="align-middle text-start" scope='col'>เบอร์โทรศัพท์</th>
        <th class="align-middle text-start" scope='col'>รหัสครัวเรือน</th>
    </tr>
</thead>
<tbody>
    <?php
    $n = 0;
    foreach ($results as $rows):
        $perid = $rows["perid"];
        $name = $rows["name"];
        $sname = $rows["sname"];
        $age = getAge($rows["brtdte"]);
        $adr = $rows["adr"];
        $soi = $rows["soi"];
        $vllid = $rows["vllid"];
        $plcid = $rows["plcid"];
        $postcode = $rows["postcode"];
        $pertel = $rows["pertel"];
        $hholdid = $rows["hholdid"];
    ?>
    <tr>
        <td class="align-middle text-center"><?=++$n?></td>
        <td class="align-middle text-start"><?php echo $name; ?></td>
        <td class="align-middle text-start"><?php echo $sname; ?></td>
        <td class="align-middle text-center"><?php echo $age; ?></td>
        <td class="align-middle text-start"><?php echo $adr; ?></td>
        <td class="align-middle text-start"><?php echo $soi; ?></td>
        <td class="align-middle text-start"><?php echo $vllid; ?></td>
        <td class="align-middle text-start"><?php echo $plcid; ?></td>
        <td class="align-middle text-start"><?php echo $amphur_name; ?></td>
        <td class="align-middle text-start"><?php echo $district_name; ?></td>
        <td class="align-middle text-center"><?php echo $postcode; ?></td>
        <td class="align-middle text-start"><?php echo $pertel; ?></td>
        <td class="align-middle text-start"><?php echo $hholdid; ?></td>
    </tr>
    <?php endforeach;?>
</tbody>
<!-- Rest of your HTML and PHP code as before -->
