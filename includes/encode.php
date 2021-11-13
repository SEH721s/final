<?php 

$stats = array();

$sql = "SELECT gender, count(*) as number FROM `tblemployees` group by gender";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

while($row =mysqli_fetch_assoc($result)){

    $stats[] = $row;

}
 $fp = fopen('genderdata.json', 'w');
    fwrite($fp, json_encode($stats));
    fclose($fp);
?>