<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $staff_name=$_POST['staff_name'];
  $father_name=$_POST['father_name'];
  $staff_cnic=$_POST['staff_cnic'];
  $staff_address=$_POST['staff_address'];

$enter=mysqli_query($conn,"SELECT * FROM staff WHERE staff_cnic='$staff_cnic'");
if(mysqli_num_rows($enter)> 0){
      $msg="CNIC already exists";
      $status="warning";
}elseif(mysqli_num_rows($enter) == 0){
  
        $query=mysqli_query($conn,"INSERT INTO  staff (station_id, staff_name, father_name, staff_cnic, staff_address)VALUES('$station_id','$staff_name','$father_name','$staff_cnic','$staff_address') ");
        $msg="Staff Registered";
        $status="success";
    }else{
        echo "";
        $msg="Error....";
        $status="danger";
        }
    

}

 ?>

<div class="col-lg-8 mx-auto ">
  
    <div class="container">
<?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?></div>
<?php } ?>
        <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-light">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Add New Staff Member</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="staff_name" class="form-control form-control-user"
                                             placeholder="Staff Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="father_name" class="form-control form-control-user"
                                            id="" placeholder="Father Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-user" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" name="staff_cnic" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control form-control-user" name="staff_address" id="" cols="30" rows="3" required ></textarea>
                                    </div>
                                </div>
                                
                                
                                <button type="submit" name="submit" class="btn btn-danger font-weight-bold btn-user btn-block">
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


          

   <script>
    $(":input").inputmask();
   </script>
<?php include 'include/footer.php'; ?>