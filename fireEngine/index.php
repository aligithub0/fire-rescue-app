<?php include 'include/header.php'; ?>
<!-- opacity: 0.1; -->
<?php include '../connection/connectdatabase.php'; ?>
<div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
  
    <div class="container">

        <div class="card o-hidden border-0  my-5 bg-light">
            <div class="card-body p-0 m-1">
                <!-- Nested Row within Card Body -->
                <div class="row bg-light">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="p-5">
                            <div class="text-center">
                                <!-- <p>Employee Details Form</p> -->
                            </div>
                            <div class="row mt-5 mx-auto">
                              <div class="col-lg-6 col-md-12 col-sm-12 mx-auto" >
                                <div class="d-flex text-dark mt-5">
                                  <div class=" font-weight-bold">
                                    <p>ID#</p>
                                    <hr>
                                    <p>Team Name</p>
                                    <hr>
                                    <p>UserName</p>
                                    <hr>
                                    <p>Password</p>
                                    <hr> 
                                  </div>
                                  <div class="ml-5  text-dark ">
<?php 
$query = mysqli_query($conn,"SELECT * FROM rescue_team WHERE team_id='$team_id'");
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
                               <div class="col-lg-6 col-sm-12 text-center" >
                                   <img height="250px" with="450px" class="col-sm-12" src="../assets/img/team.png" alt="">
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