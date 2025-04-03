<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
  
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 bg-danger">
            <div class="card-body p-0 m-1">
                <!-- Nested Row within Card Body -->
                <div class="row bg-gradient-light">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="h4 text-gray-900">Fire Engine</h2>
                                <hr>
                                <!-- <p>Employee Details Form</p> -->
                            </div>
                            <div class="row mt-5 mx-auto">
                              <div class="col-lg-6 col-md-12 col-sm-12 mx-auto" >
                                <div class="d-flex text-dark mt-5">
                                  <div class="font-weight-bold">
                                    <p>ID#</p>
                                    <hr>
                                    <p>Team Name</p>
                                    <hr>
                                    <p>UserName</p>
                                    <hr>
                                    <p>Password</p>
                                    <hr> 
                                  </div>
                                  <div class="ml-5">
<?php 
$query = mysqli_query($conn,"SELECT * FROM rescue_team WHERE station_id='$station_id'");
$data = mysqli_fetch_assoc($query);
?>
                                    <p><?=$data['team_id']?></p>
                                    <hr>
                                    <p><?=$data['team_name']?></p>
                                    <hr>
                                    <p><?=$data['team_username']?></p>
                                    <hr>
                                    <p><?=$data['team_password']?></p>
                                    <hr>
                                  </div>
                                </div>
                              </div>

                               <div class="col-lg-6 text-center" >
                                   <img height="300px" src="../assets/img/team.png" alt="">
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