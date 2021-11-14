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
<?php 

$sql = "SELECT gender as gender, COUNT(*) as amount from tblemployees GROUP BY gender";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));


foreach ($result as $res) 
{
   $jsonArr['gender'][] = array('gender'=>$res['gender'],'amount'=>$res['amount']);

}



 $fp = fopen('db1.json', 'w');
    fwrite($fp, json_encode($jsonArr));
    fclose($fp);
?>