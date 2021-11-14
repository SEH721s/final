<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php include('includes/right_sidebar.php')?>


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

	<?php include('includes/navbar.php')?>


	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4 user-icon">
						<img src="../vendors/images/login.png" alt="">
					</div>
					<div class="col-md-8">

						<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $row['FirstName']. " " .$row['LastName']; ?>,</div>
						</h4>
						<p class="font-18 max-width-600">To the HOD Dashboard</p>
					</div>
				</div>
			</div>
	

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between pb-10">
							<div class="h5 mb-0">Expiring Contracts</div>
							<div class="table-actions">
								<a title="VIEW" href="contracts.php"><i class="icon-copy ion-disc" data-color="#1d2758"></i></a>	
							</div>
						</div>
						<div class="user-list">
							<ul>
								<?php
								  $query = mysqli_query($conn,"select * from tblemployees where DATEDIFF(`ContractEndDate`,CURRENT_DATE)<=90 and role = 'Staff' and Department = '$session_depart' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
								  while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color=" #1d2758"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>

										</div>
									</div>
									<div class="font-12 weight-500" data-color="#d1433b"><?php echo $row['ContractEndDate']; ?></div>

								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
				
				
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Upcoming Birthdays</div>
							<div class="table-actions">
								<a title="VIEW" href="events.php"><i class="icon-copy ion-disc" data-color="#1d2758"></i></a>	
							</div>
						</div>

						<div class="user-list">
							<ul>
								<?php
								  $query = mysqli_query($conn,"select * from tblemployees where month(current_date)=month(Dob) and day(current_date)<=day(Dob) and role = 'Staff' and Department = '$session_depart' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#1d2758"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
										</div>
									</div>
									<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $row['Dob']; ?></div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Work Anniversary</div>
							<div class="table-actions">
								<a title="VIEW" href="events.php"><i class="icon-copy ion-disc" data-color="#1d2758"></i></a>	
							</div>
						</div>

						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from tblemployees where year(current_date)-year(RegDate)=5 or year(current_date)-year(RegDate)=10 or year(current_date)-year(RegDate)=15 and role = 'Staff' and Department = '$session_depart' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
								 $registered = $row['RegDate'];
								 $year = date('Y', strtotime($registered));
								 $cur_year = date('Y');
								 $interval = $cur_year-$year;

								 
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color=" #1d2758"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
											<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $interval; ?> Years</div>


										</div>
									</div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
					
				</div>
				
				
			</div>

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">Current Staff on Leave</h2>
					</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">Staff</th>
								<th>Start Date </th>
								<th>Return Date </th>
								<th>Type of Leave</th>
								<th class="datatable-nosort">ACTION</th> 
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblleaves.LeaveType,tblemployees.emp_id,tblleaves.FromDate,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblemployees.role = 'Staff' and Department = '$session_depart' order by lid desc limit 5";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{         
								 ?>  

								<td class="table-plus">
									<div class="name-avatar d-flex align-items-center">
										<div class="txt mr-2 flex-shrink-0">
											<b><?php echo htmlentities($cnt);?></b>
										</div>
										<div class="txt">
											<div class="weight-600"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></div>
										</div>
									</div>
								</td>
								<td><?php echo htmlentities($result->FromDate);?></td>
	                            <td><?php echo htmlentities($result->PostingDate);?></td>
								<td><?php echo htmlentities($result->LeaveType);?></td>

								<td>
									<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item" href="leave_details.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-eye"></i> View</a>
											<a class="dropdown-item" href="admin_dashboard.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-delete-3"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php $cnt++;} }?>
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