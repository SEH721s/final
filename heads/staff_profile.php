<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php include('includes/right_sidebar.php')?>

<?php
if(isset($_POST['new_update']))
{
	$empid=intval($_GET['emp_id']);
	$fname=$_POST['fname'];
	$lname=$_POST['lastname'];   
	$email=$_POST['email'];  
	$dob=$_POST['dob']; 
	$department=$_POST['department']; 
	$address=$_POST['address']; 
	$gender=$_POST['gender'];  
	$phonenumber=$_POST['phonenumber'];

    $result = mysqli_query($conn,"update tblemployees set FirstName='$fname', LastName='$lname', EmailId='$email', Gender='$gender', Dob='$dob', Department='$department', Address='$address', Phonenumber='$phonenumber' where emp_id='$session_id'         
		")or die(mysqli_error());
    if ($result) {
     	echo "<script>alert('Your records Successfully Updated');</script>";
     	echo "<script type='text/javascript'> document.location = 'head_profile.php'; </script>";
	} else{
	  die(mysqli_error());
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
	<?php include('includes/navbar.php')?>

 
	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin_dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">

							<?php 
                            	$empid=intval($_GET['emp_id']);

                            $query= mysqli_query($conn,"select * from tblemployees LEFT JOIN tbldepartments ON tblemployees.Department = tbldepartments.DepartmentShortName where emp_id = '$empid'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
							?>

							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="" class="avatar-photo">
								<form method="post" enctype="multipart/form-data">
									<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="weight-500 col-md-12 pd-5">
													<div class="form-group">
														<div class="custom-file">
															<input name="image" id="file" type="file" class="custom-file-input" accept="image/*" onchange="validateImage('file')">
															<label class="custom-file-label" for="file" id="selector">Choose file</label>		
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="submit" name="update_image" value="Update" class="btn btn-primary">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<h5 class="text-center h5 mb-0"><?php echo $row['FirstName']. " " .$row['LastName']; ?></h5>
							<p class="text-center text-muted font-14"><?php echo $row['DepartmentName']; ?></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?php echo $row['EmailId']; ?>
									</li>
									<li>
										<span>Phone Number:</span>
										<?php echo $row['Phonenumber']; ?>
									</li>
									<li>
										<span>My Role:</span>
										<? $roles = $row['role']; ?>
										<?php if($roles = 'HOD'): ?>
										 <?php echo "Head of Department"; ?>
										<?php endif ?>
									</li>
									<li>
										<span>Address:</span>
										<?php echo $row['Address']; ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Leave Records</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#performance" role="tab">Performance Records</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
											<div class="col-lg-12 col-md-6 mb-20">
													
												<div id="leave-chart"></div>
					
												</div>
												<div class="row">
													<div class="col-lg-12">

													
								<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="datatable-nosort">LEAVE TYPE</th>
								<th>APPLIED DATE</th>
								<th>FROM DATE</th>
								<th>END DATE</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php 
								$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.location,tblemployees.emp_id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.FromDate,tblleaves.ToDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblemployees.emp_id = '$empid' and tblemployees.Department = '$session_depart' order by lid desc limit 10";
									$query = mysqli_query($conn, $sql) or die(mysqli_error());
									while ($row = mysqli_fetch_array($query)) {

								 ?>  

								
								<td><?php echo $row['LeaveType']; ?></td>
	                            <td><?php echo $row['PostingDate']; ?></td>
								<td><?php echo $row['FromDate']; ?></td>
								<td><?php echo $row['ToDate']; ?></td>
								<td><a class="dropdown-item" href="leave_details.php?leaveid=<?php echo $row['lid']; ?>"><i class="dw dw-eye"></i> View</a>
									</td>
								
							
							</tr>
							<?php }?>
						</tbody>
					</table>
												</div>
											</div>
										</div>
									</div>
										<!-- Timeline Tab End -->
										<!-- Setting Tab start -->
										<div class="tab-pane fade show active" id="performance" role="tabpanel">
											<div class="pd-20">
											<div class="col-lg-12 col-md-6 mb-20">
													
												<div id="performance-chart"></div>
					
												</div>
												<div class="row">
													<div class="col-lg-12">

													
								<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="datatable-nosort">TITLE</th>
								<th>DESCRIPTION</th>
								<th>SCORE</th>
								<th>DATE</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php 
								$sql = "SELECT tblperformance.pid as xid,tblemployees.emp_id,tblperformance.title,tblperformance.description,tblperformance.score,tblperformance.date from tblperformance join tblemployees on tblperformance.employee_id=tblemployees.emp_id where tblemployees.emp_id = '$empid' and tblemployees.Department = '$session_depart' order by xid desc limit 10";
									$query = mysqli_query($conn, $sql) or die(mysqli_error());
									while ($row = mysqli_fetch_array($query)) {

								 ?>  

								
								<td><?php echo $row['title']; ?></td>
	                            <td><?php echo $row['description']; ?></td>
								<td><?php echo $row['score']; ?></td>
								<td><?php echo $row['date']; ?></td>
								
							
							</tr>
							<?php }?>
						</tbody>
					</table>
												</div>
											</div>
										</div>
									</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
	<?php include('includes/scripts.php')?>

	<script type="text/javascript">
		var loader = function(e) {
			let file = e.target.files;

			let show = "<span>Selected file : </span>" + file[0].name;
			let output = document.getElementById("selector");
			output.innerHTML = show;
			output.classList.add("active");
		};

		let fileInput = document.getElementById("file");
		fileInput.addEventListener("change", loader);
	</script>
	<script type="text/javascript">
		 function validateImage(id) {
		    var formData = new FormData();
		    var file = document.getElementById(id).files[0];
		    formData.append("Filedata", file);
		    var t = file.type.split('/').pop().toLowerCase();
		    if (t != "jpeg" && t != "jpg" && t != "png") {
		        alert('Please select a valid image file');
		        document.getElementById(id).value = '';
		        return false;
		    }
		    if (file.size > 1050000) {
		        alert('Max Upload size is 1MB only');
		        document.getElementById(id).value = '';
		        return false;
		    }

		    return true;
		}
	</script>
</body>
</html>