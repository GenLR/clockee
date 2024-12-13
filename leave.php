<?php
session_start();
error_reporting(0);
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_SESSION['id'];
$fetch_query = mysqli_query($connection, "select shift from tbl_employee where id='$id'");
$shift = mysqli_fetch_array($fetch_query);

$fetch_emp = mysqli_query($connection, "select * from tbl_employee where id='$id'");
$emp = mysqli_fetch_array($fetch_emp);
$empid = $emp['employee_id'];
$dept = $emp['department'];

$curr_date = date('Y-m-d');
date_default_timezone_set('Asia/Kolkata'); 
$time = date('Y-m-d H:i:s');

$leave_status = '';

if(isset($_REQUEST['apply-leave']))
{
    $leave_type = $_REQUEST['leave_type'];
    $reason = $_REQUEST['reason'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $status = "Pending";
    $leave_msg = $_REQUEST['leave_msg'];

    $insert_query = mysqli_query($connection, "insert into tbl_leave set employee_id='$empid', department='$dept', leave_type='$leave_type', reason='$reason', start_date='$start_date', end_date='$end_date', status='$status', leave_msg='$leave_msg', date_applied='$curr_date'");
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 ">
                <h4 class="page-title">Leave Request Form</h4>
            </div>
        </div>
        <div class="row">
        <?php
           $fetch_leave = mysqli_query($connection,"select employee_id from tbl_leave where date_applied='$curr_date' and employee_id='$empid'");
           $row = mysqli_num_rows($fetch_leave);
           if($row==0){
        ?>
            <div class="col-lg-8 offset-lg-2">
               <form method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="leave_type" required>
                                    <option value="">Select</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Casual Leave">Casual Leave</option>
                                    <option value="Paid Leave">Paid Leave</option>
                                    <option value="Unpaid Leave">Unpaid Leave</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Start Date <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="start_date" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>End Date <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="end_date" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Reason for Leave</label>
                                <textarea class="form-control" name="reason"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Additional Message</label>
                                <textarea class="form-control" name="leave_msg"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="apply-leave">Apply Leave</button>
                    </div>
                </form>
            </div>
        <?php } else {
            $fetch_leave_status = mysqli_query($connection, "select status from tbl_leave where employee_id='$empid' and date_applied='$curr_date'");
            $result = mysqli_fetch_array($fetch_leave_status);
            $status = $result['status'];

            if($status == "Approved"){
                echo "<center><h3>Your Leave has been Approved</h3></center>";
            } elseif($status == "Rejected"){
                echo "<center><h3>Your Leave Request has been Rejected</h3></center>";
            } else {
                echo "<center><h3>Your Leave Request is Pending</h3></center>";
            }
        } ?>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>
