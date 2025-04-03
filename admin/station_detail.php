<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
  
    <div class="container bg-light">

        <div class="card o-hidden border-0 shadow-lg my-5 bg-light">
            <div class="card-body p-0 m-1">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="h4 text-gray-900 ">Station Detail</h2>
                                <hr>
                                <!-- <p>Employee Details Form</p> -->
                            </div>
                            <div class="row mt-5 mx-auto">
                              <div class="col-lg-6 col-md-12 col-sm-12 mx-auto" >
                                <div class="d-flex">
<?php if (isset($_GET['id'])){ $id=$_GET['id'];}
$query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$id'");
$data = mysqli_fetch_assoc($query);
?>
                                  <iframe height="150" width="400" src = "https://maps.google.com/maps?q=<?=$data['station_latitude']?>,<?=$data['station_longitude']?>&hl=es;z=14&amp;output=embed"></iframe>
                                </div>
                              </div>
                               <div class="col-lg-6 text-center" >
                                   <img height="150px" src="../assets/img/station.png" alt="">
                              </div>
                            </div>

                            <table class="col-md-12 mt-5 text-center ml-5 ">
                              <tr>
                                <td>Station  </td>
                                <td class=""><?=$data['station_name']?></td>
                              </tr>
                              <tr> 
                                <td>City  </td> 
                                <td><?=$data['station_city']?></td>
                              </tr>
                              <tr>
                                <td>Username  </td>
                                <td><?=$data['station_username']?></td>
                              </tr>
                              <tr> 
                                <td>tdassword  </td>
                                <td><?=$data['station_password']?></td>
                              </tr>
                          </table>
                            </div>
                        </div>
                    </div>

    <div class="container bg-light">

        <div class="card o-hidden border-0 my-5 bg-light">
            <div class="card-body p-0 m-1">
                <!-- Nested Row within Card Body -->
                <div class="row ">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="h4 text-gray-900">Fire Engine</h2>
                                <hr>
                                <!-- <p>Employee Details Form</p> -->
                            </div>
                            <div class="row mt-5 mx-auto">
                              <div class="col-lg-6 col-md-12 col-sm-12 mx-auto" >
                                <div class="d-flex text-dark">
                                  <div class="mt-3">
                                    <p>ID#</p>
                                    <hr>
                                    <p>Team Name</p>
                                    <hr>
                                    <p>UserName</p>
                                    <hr>
                                    <p>Password</p>
                                    <hr> 
                                  </div>
                                  <div class="ml-5 mt-3 ">
<?php 
$query = mysqli_query($conn,"SELECT * FROM rescue_team WHERE station_id='$id'");
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
                                   <img height="250px" src="../assets/img/fireengine.png" alt="">
                              </div>
                            </div>
                        </div>
                    </div>
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