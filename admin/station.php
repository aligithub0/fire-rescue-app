<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>


<div class="container">
              <div class="row m-6 justify-content-center">
                <div class="col-lg-10 mb-4">
                  <div class="row">
<?php if (isset($_GET['id'])){ $id=$_GET['id'];}
if(isset($id)){ $query = mysqli_query($conn,"DELETE FROM station WHERE station_id='$id'");} 
 $query = mysqli_query($conn,"SELECT * FROM station");
          while ($data = mysqli_fetch_assoc($query)) {     
?>                  
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                      <div class="card text-white shadow ">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <img src="../assets/img/station.png" height="auto" class="col-12" alt="">
                            </div>
                             <div class="col-lg-6 col-sm-12 text-gray-800">
                              <h6><b><?=$data['station_name'];?></b></h6>
                              <table>
                                <tr>
                                  <td>City:</td>
                                  <td><?=$data['station_city'];?></td>
                                </tr>
                                <tr>
                                  <td><sub><?=$data['station_timestamp'];?></sub></td>
                                  <td></td>
                                </tr>
                              </table>
                              <div class="">
                                <a href="station_detail.php?id=<?=$data['station_id'];?>" class="btn text-primary btn-sm">
                                  View
                                </a> |
                                <a href="edit_station.php?id=<?=$data['station_id'];?>" class="btn text-success btn-sm">
                                  Edit
                                  </a> |
                                 <a href="station.php?id=<?=$data['station_id'];?>" class="btn text-danger btn-sm">
                                  Delete
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
<?php } ?>
                </div>
              </div>
          </div>
      </div>



<?php include 'include/footer.php'; ?>