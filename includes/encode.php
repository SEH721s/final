<?php 

$stats = array();
$key = "year2";
$sql = "SELECT MONTHNAME(FromDate) as x, COUNT(*) as y from tblleaves GROUP BY x";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));


foreach ($result as $res) 
{
   $jsonArr['year2'][] = array('x'=>$res['x'],'y'=>$res['y']);

}



 $fp = fopen('db1.json', 'w');
    fwrite($fp, json_encode($jsonArr));
    fclose($fp);
?>