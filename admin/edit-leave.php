<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_leave WHERE id='$id'");
$row = mysqli_fetch_array($fetch_query);

if(isset($_REQUEST['save-leave'])) {
    $leave_type = $_REQUEST['leave_type'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $status = $_REQUEST['status'];

    $update_query = mysqli_query($connection, "UPDATE tbl_leave SET leave_type='$leave_type', start_date='$start_date', end_date='$end_date', status='$status' WHERE id='$id'");
    if($update_query > 0) {
        $msg = "Leave updated successfully";
        $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_leave WHERE id='$id'");
        $row = mysqli_fetch_array($fetch_query);   
    } else {
        $msg = "Error!";
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Edit Leave</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="leave.php" class="btn btn-primary btn-rounded float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Leave Type</label>
                                <input type="text" class="form-control" name="leave_type" value="<?php echo $row['leave_type']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Leave Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="1" <?php if($row['status'] == 1) echo 'checked'; ?>>
                            <label class="form-check-label">Approved</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="0" <?php if($row['status'] == 0) echo 'checked'; ?>>
                            <label class="form-check-label">Pending</label>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button name="save-leave" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript">
    <?php
    if(isset($msg)) {
        echo 'swal("' . $msg . '");';
    }
    ?>
</script>
