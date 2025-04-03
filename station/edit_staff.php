<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php
if (isset($_GET['id'])){ $id=$_GET['id'];}else{echo "<script>window.location='staff.php'</script>";}




if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $staff_name=$_POST['staff_name'];
  $father_name=$_POST['father_name'];
  $staff_cnic=$_POST['staff_cnic'];
  $staff_address=$_POST['staff_address'];


        $query=mysqli_query($conn,"UPDATE staff SET staff_name='$staff_name',father_name='$father_name',staff_cnic='$staff_cnic',staff_address='$staff_address' WHERE staff_id='$id'");
       if ($query) {
        echo "<script>window.location='staff_detail.php?id=$id'</script>";
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
<?php  $query= mysqli_query($conn,"SELECT * FROM staff WHERE station_id='$station_id' AND staff_id='$id'");
    $row=mysqli_fetch_assoc($query); ?>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="staff_name" class="form-control form-control-user"
                                             placeholder="Staff Name" value="<?=$row['staff_name']?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="father_name" class="form-control form-control-user"
                                            id="" placeholder="Father Name" value="<?=$row['father_name']?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-user" name="staff_cnic" id="staff_name"
                                            placeholder="Enter CNIC Number"value="<?=$row['staff_cnic']?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control form-control-user" name="staff_address" id="" cols="30" rows="3" required ><?=$row['staff_address']?></textarea>
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


          

 
<?php include 'include/footer.php'; ?>