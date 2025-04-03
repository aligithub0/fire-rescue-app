<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $case_name=$_POST['case_name'];
  $deaths=$_POST['deaths'];
  $report_date=$_POST['report_date'];
  $location_name=$_POST['location_name'];
  $city=$_POST['city'];
  $complete_detail=$_POST['complete_detail'];

$enter=mysqli_query($conn,"SELECT * FROM reports WHERE case_name='$case_name'");
if(mysqli_num_rows($enter)> 0){
      $msg="Report already Submitted";
      $status="warning";
}elseif(mysqli_num_rows($enter) == 0){
  
        $query=mysqli_query($conn,"INSERT INTO  reports (report_date, station_id, case_name, deaths, location_name, city, complete_detail)VALUES('$report_date','$station_id','$case_name','$deaths','$location_name','$city','$complete_detail') ");
        $msg="Report Submited";
        $status="success";
    }else{
        echo "";
        $msg="Error....";
        $status="danger";
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
                                <h1 class="h4 text-gray-900 mb-4">Create Report</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="case_name" class="form-control form-control-user"
                                             placeholder="Case" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="deaths" class="form-control form-control-user"
                                            id="" placeholder="Number of deaths" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" name="report_date" class="form-control form-control-user"
                                              required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="city" id=""
                                            placeholder="City" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-user" name="location_name" id=""
                                            placeholder="Location Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control " name="complete_detail" id="" cols="30" rows="3" required ></textarea>
                                    </div>
                                </div>
                                
                                
                                <button type="submit" name="submit" class="btn btn-danger btn-user btn-block">
                                    Submit
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