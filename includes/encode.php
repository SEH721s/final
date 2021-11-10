<?php 

$sql = "select emp_id,FirstName,Lastname,Gender from tblemployees";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    
    
    //encode gender employee data
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    
    //write to json file
    $fp = fopen('src/data/genderdata.json', 'w');
    fwrite($fp, json_encode($emparray));
    fclose($fp);
?>
<?php 

