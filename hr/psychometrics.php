<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM tblemployees where emp_id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Staff deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'staff.php'; </script>";
		
	}
}

?>

<body>
<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/home.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
	<?php include('includes/right_sidebar.php')?>


	<?php include('includes/navbar.php')?>

 
	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">Employee Psychometric Results</h2>
					</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus">FULL NAME</th>
								<th>STAFF NO.</th>
								<th>Verbal Reasoning</th>
								<th>Numeric Reasoning</th>
								<th>Logical Reasoning</th>
								<th>Error Checking</th>
                                <th>Overall Score</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								 <?php
		                         $staff_query = mysqli_query($conn,"select * from tblemployees LEFT JOIN tbldepartments ON tblemployees.Department = tbldepartments.DepartmentShortName where tblemployees.role = 'Staff' and tblemployees.Department = '$session_depart' ORDER BY tblemployees.emp_id") or die(mysqli_error());
                                 
		                         while ($row = mysqli_fetch_array($staff_query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<td class="table-plus">
									<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 shadow" width="40" height="40" alt="">
										</div>
										<div class="txt">
											<div class="weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
										</div>
									</div>
								</td>
								<td><?php echo $row['emp_id']; ?></td>
								<td><?php $verb = rand(50,100);echo $verb;?></td>
                                <td><?php $num = rand(50,100);echo $num;?></td>
                                <td><?php $log = rand(50,100);echo $log;?></td>
								<td><?php $err = rand(50,100);echo $err;?></td>
                                <td data-color="#41b883"><?php $overall = (($verb + $num + $log + $err)/4);echo $overall;?></td>

							

	                           
								
							</tr>
							<?php } ?>  
						</tbody>
					</table>
			   </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>