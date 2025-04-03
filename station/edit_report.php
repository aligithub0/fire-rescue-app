<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 

if (isset($_GET['edit_id'])) {
    $edit_id=$_GET['edit_id'];
}else{
        echo "<script>window.location='reports_list.php'</script>";
}

if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $case_name=$_POST['case_name'];
  $report_id=$_POST['report_id'];
  $deaths=$_POST['deaths'];
  $report_date=$_POST['report_date'];
  $location_name=$_POST['location_name'];
  $city=$_POST['city'];
  $complete_detail=$_POST['complete_detail'];
  
        $query=mysqli_query($conn,"UPDATE reports SET report_id='$report_id',station_id='$station_id',case_name='$case_name',deaths='$deaths',city='$city',location_name='$location_name',report_date='$report_date',complete_detail='$complete_detail' WHERE report_id=$report_id");
        if ($query) {
        echo "<script>window.location='reports_list.php'</script>";
    }else{
        $msg="Error";
        $status= 'danger';
        }
    }
 ?>

<div class="col-lg-8 mx-auto">
  
    <div class="container">
<?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?></div>
<?php } ?>
        <div class="card o-hidden border-1 shadow-lg my-5 bg-light">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Edit Report</h1>
                            </div>
<?php  $query= mysqli_query($conn,"SELECT * FROM reports WHERE station_id='$station_id' AND report_id='$edit_id'");
    $row=mysqli_fetch_assoc($query); ?>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="case_name" class="form-control form-control-user"
                                             placeholder="Case" value="<?=$row['case_name']?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="deaths" class="form-control form-control-user"
                                            id="" placeholder="Number of deaths" value="<?=$row['deaths']?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="report_date" class="form-control form-control-user" value="<?=$row['report_date']?>"
                                              required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="city" id=""
                                            placeholder="City" value="<?=$row['city']?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-user" name="location_name" id=""
                                            placeholder="Location Name" value="<?=$row['location_name']?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                        <input type="hidden" class="form-control form-control-user" name="report_id" id=""
                                            placeholder="" value="<?=$row['report_id']?>" required>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control " name="complete_detail" id="" cols="30" rows="3" required ><?=$row['complete_detail']?></textarea>
                                    </div>
                                </div>
                                
                                
                                <button type="submit" name="submit" class="btn btn-danger btn-user btn-block">
                                    UPDATE
                                </button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

 
 
<?php include 'include/footer.php'; ?>