<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
  
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 m-1">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="h4 text-gray-900 ">Employee Detail</h2>
                                <!-- <p>Employee Details Form</p> -->
                            </div>
                            <div class="row mt-5 mx-auto">
                              <div class="col-lg-6 col-md-12 col-sm-12 mx-auto" >
                                <div class="d-flex">
                                  <div class="">
                                    <p>Name</p>
                                    <p>Father_Name</p>
                                    <p>CNIC</p>
                                    <p>Address</p>
                                    
                                  </div>
                                  <div class="ml-5">
<?php if (isset($_GET['id'])){ $id=$_GET['id'];}
$query = mysqli_query($conn,"SELECT * FROM staff WHERE staff_id='$id'");
$data = mysqli_fetch_assoc($query);
?>
                                    <p><?=$data['staff_name']?></p>
                                    <p><?=$data['father_name']?></p>
                                    <p><?=$data['staff_cnic']?></p>
                                    <p><?=$data['staff_address']?></p>

                                  </div>
                                </div>
                              </div>
                               <div class="col-lg-6 text-center" >
                                   <img height="150px" width="150px" src="../assets/img/undraw_profile.svg" alt="">
                              </div>
                            </div>

                            <!-- <div class="d-flex mt-5">
                              <div class= "h6 text-gray-900 mt-2">
                                <p>City  :</p> <br>
                                <p>State  :</p><br>
                                <p>Email  :</p><br>
                                <p>Address  :</p>
                              </div>
                              <div class="ml-5" style="margin-top: 5px;">
                                <p class="mt-2">Toba Take Singh</p>
                                <hr style='margin-top: -1rem;'>
                                <br>
                                <p>Punjab</p>
                                <hr style='margin-top: -1rem;'>
                                <br>
                                <p>abdulwahab315tts@gmail.com</p>
                                <hr style='margin-top: -1rem;'>
                                <br>
                                <p>Street No 535- Usman Town Gojra</p>
                                <hr style='margin-top: -1rem;'>
                              </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'include/footer.php'; ?>