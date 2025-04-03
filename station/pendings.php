<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>


<div class="container">
              <div class="row m-6 justify-content-center">
                <div class="col-lg-12 mb-4">
                  <div class="row">
<?php if (isset($_GET['complete'])){ $id=$_GET['complete'];}
if(isset($id)){ $query = mysqli_query($conn,"UPDATE complaint SET status='complete' WHERE complaint_id='$id'");}
 $query = mysqli_query($conn,"SELECT * FROM complaint WHERE status='accept'");
          while ($data = mysqli_fetch_assoc($query)) { 
          $lat=$data['complaint_latitude'];
          $long=$data['complaint_longitude'];    
?>                  
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4 bg-light">
                      <div class="card text-white shadow ">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-5">
                              <img src="../upload/<?=$data['complaint_image']?>" height="300px" alt="">
                            </div>
                            <div class="col-lg-5">
                             <iframe height="300px" src = "https://maps.google.com/maps?q=<?=$lat?>,<?=$long?>&hl=es;z=14&amp;output=embed"></iframe>
                            </div>
                             <div class="col-lg-2 mt-5 col-sm-12 text-gray-800">
                              <div class="mt-5">
                                <a href="pendings.php?complete=<?=$data['complaint_id']?>" class="btn-lg btn-danger">Complete</a>
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