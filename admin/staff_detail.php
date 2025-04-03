<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
  
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-light">
            <div class="card-body p-0 m-1 bg-gradient-light">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="h4 text-gray-900 ">Employee Detail</h2><hr>
                                <!-- <p>Employee Details Form</p> -->
                            </div>
                            <div class="row mt-5 mx-auto">
                              <div class="col-lg-6 col-md-12 col-sm-12 mx-auto" >
                                <div class="d-flex mt-5 text-dark font-weight-bold">
                                  <div class="">
                                    <p>Name</p><hr>
                                    <p>Father_Name</p><hr>
                                    <p>CNIC</p><hr>
                                    <p>Address</p><hr>
                                    
                                  </div>
                                  <div class="ml-5">
<?php if (isset($_GET['id'])){ $id=$_GET['id'];}
$query = mysqli_query($conn,"SELECT * FROM staff WHERE staff_id='$id'");
$data = mysqli_fetch_assoc($query);
?>
                                    <p><?=$data['staff_name']?></p><hr>
                                    <p><?=$data['father_name']?></p><hr>
                                    <p><?=$data['staff_cnic']?></p><hr>
                                    <p><?=$data['staff_address']?></p><hr>

                                  </div>
                                </div>
                              </div>
                               <div class="col-lg-6 text-center" >
                                   <img height="300px" width="300px" src="../assets/img/fireman.png" alt="">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'include/footer.php'; ?>