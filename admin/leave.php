<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Leaves</h4>
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_GET['ids'])) {
                        $id = $_GET['ids'];
                        $delete_query = mysqli_query($connection, "DELETE FROM tbl_leave WHERE id='$id'");
                    }
                    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_leave");
                    while($row = mysqli_fetch_array($fetch_query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['leave_type']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        <?php if($row['status']==1) { ?>
                            <td><span class="custom-badge status-green">Approved</span></td>
                        <?php } else { ?>
                            <td><span class="custom-badge status-red">Pending</span></td>
                        <?php } ?>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="edit-leave.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="leave.php?ids=<?php echo $row['id']; ?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script language="JavaScript" type="text/javascript">
function confirmDelete() {
    return confirm('Are you sure you want to delete this leave record?');
}
</script>
