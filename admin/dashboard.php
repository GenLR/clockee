<?php
session_start();
if(empty($_SESSION['name']))
{
	header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4 round">
                        <div class="dash-widget">
							<span class="dash-widget-bg1"><img src="assets/img/employees.png" alt="employee" width="45px"></i></span>
							<?php
							$fetch_query = mysqli_query($connection, "select count(*) as total from tbl_employee where status=1 and role=0"); 
							$emp = mysqli_fetch_row($fetch_query);
							?>
							<div class="dash-widget-info text-right">
								<h3><?php echo $emp[0]; ?></h3>
								<span class="widget-title1">Employees <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4 round">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><img src="assets/img/department.png" alt="department" width="45px"></i></span>
                            <?php
							$fetch_query = mysqli_query($connection, "select count(*) as total from tbl_department where status=1"); 
							$dept = mysqli_fetch_row($fetch_query);
							?>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $dept[0]; ?></h3>
                                <span class="widget-title2">Departments <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4 round">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><img src="assets/img/clocky.png" alt="shift" width="45px"></i></span>
                            <?php
							$fetch_query = mysqli_query($connection, "select count(*) as total from tbl_shift where status=1"); 
							$shift = mysqli_fetch_row($fetch_query);
							?>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $shift[0]; ?></h3>
                                <span class="widget-title3">Shift <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="row">
                       <div class="col-12 col-md-6 col-lg-8 col-xl-8 round">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Requests </h4> <a href="employees.php" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<tbody>
											<?php 
											$fetch_query = mysqli_query($connection, "select * from tbl_leave where status='pending'");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        { ?>
											<tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <?php if($row['status']==1) { ?>
                                                    <td><span class="custom-badge status-green">Approved</span></td>
                                                <?php } else { ?>
                                                    <td><span class="custom-badge status-red">Pending</span></td>
                                                <?php } ?>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					  <div class="col-12 col-md-6 col-lg-4 col-xl-4 round">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Department's Employees</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                	<?php 
                                	$fetch_query = mysqli_query($connection, "select * from tbl_employee where status=1 and role=0 limit 5");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                        ?>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis"><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                                                <span class="contact-date"><?php echo $row['department']; ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="employees.php" class="text-muted">View all Employees</a>
                            </div>
                        </div>
                    </div>
				</div>
				
            </div>
            
        </div>
    
 <?php 
 include('footer.php');
?>