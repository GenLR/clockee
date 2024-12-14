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
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fetch_leave = mysqli_query($connection, "SELECT * FROM tbl_leave");
                    $fetch_name = mysqli_query($connection, "SELECT * FROM tbl_employee");

                    while($row = mysqli_fetch_array($fetch_leave)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <?php if($row['status']=="approved") { ?>
                            <td><span class="custom-badge bg-success">Approved</span></td>
                        <?php } else if($row['status']=="pending"){ ?>
                            <td><span class="custom-badge bg-warning">Pending</span></td>
                        <?php } else{ ?>
                            <td><span class="custom-badge bg-danger">Denied</span></td>
                        <?php } ?>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="approved.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Approve</a>
                                    <a class="dropdown-item" href="denied.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Deny</a>
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

