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
$fetch_emp = mysqli_query($connection, "select * from tbl_employee where id='$id'");
$emp = mysqli_fetch_array($fetch_emp);

    if(isset($_REQUEST['turn-it'])){
      $date = $_REQUEST['date'];
      $msg = $_REQUEST['msg'];
      $emp_id = $emp['employee_id']; 
      $type = $_REQUEST['type'];
      $status = 'pending';

      try {
        $fetch_lv = mysqli_query($connection, "select * from tbl_leave where id='$id' 
                                  AND date=STR_TO_DATE('$date', '%d/%m/%Y')");
              if(mysqli_num_rows($fetch_lv) == 0){
                $insert_query = mysqli_query($connection, "INSERT INTO tbl_leave (employee_id, type, date, message, status) 
                                          VALUES ('$emp_id', '$type', STR_TO_DATE('$date', '%d/%m/%Y'), '$msg', '$status')");
                if(isset($insert_query)){
                  $resp = "Filing of leave submitted successfully";
                }
              } else {
                $resp = "Already filled a Leave Request";
              }
      }catch(Exception $e) {
        die("Error: " . $e->getMessage());
      }

    }

?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">File a Leave Request</h4> 
                    </div>              
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                      <form method="post">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Select Date of Absence<span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="date" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">    
                                <label>Type of Leave <span class="text-danger">*</span></label>
                                <select class="select" name="type" required>
                                  <option value="">Select</option>
                                  <option value="Casual Leave">Casual Leave</option>
                                  <option value="Indefinite Leave">Indefinite Leave</option>
                                  <option value="Personal Leave">Personal Leave</option>
                                  <option value="Sick Leave">Sick Leave</option>
                                  <option value="Unpaid Leave">Unpaid Leave</option>
                                  <option value="Vacation Leave">Vacation Leave</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Message </label>
                                    <textarea class="form-control" name="msg"></textarea>     
                                </div>
                            </div>   
                          </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="turn-it"> Submit</button>
                                <p><?php echo $resp?></p>
                            </div>
                        </form>
                    </div>                             
              </div>
            </div>
		</div>
    
<?php
    include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to check out now?');
}
</script>