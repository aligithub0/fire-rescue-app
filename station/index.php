<?php include 'include/header.php'; 
include '../connection/connectdatabase.php';
if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $station_latitude=$_POST['latitude'];
  $station_longitude=$_POST['longitude'];
        if (mysqli_query($conn,"UPDATE station SET station_latitude='$station_latitude',station_longitude='$station_longitude' WHERE station_id='$station_id'")) {
        $msg="Success";
        $status="success";
        }else{
        $msg="Error";
        $status="danger";
        }
}

 ?>
<div class="container-fluid">
<?php 
$query = mysqli_query($conn,"SELECT * FROM station WHERE station_id=$station_id");
$data = mysqli_fetch_assoc($query);
$lat=$data['station_latitude'];
$long=$data['station_longitude'];
if (empty($lat) && empty($long)) {?>
            <div class="col-md-12">
              <form action="#" class="" align="center" method="POST">
                <input type="text" class="p-1" name="latitude" id="lat" required>
                <input type="text" class="p-1" name="longitude" id="long" required>
                <input type="submit" class="btn-lg btn-success shadow-lg" onmouseover="getLocation()" name="submit" value="Activate Station">
              </form>
            </div>
<?php } if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><?=$msg?>
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?>
    </div>
<?php } ?>
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
                  <div class="col-lg-4 mb-4">
                      <div class="card bg-danger text-white shadow text-center">
                        <div class="card-body">
<?php $select=mysqli_query($conn,"SELECT * FROM reports WHERE station_id='$station_id'");
$reports=mysqli_num_rows($select); ?>
                          <h4 class="mb-3"><?=$reports?></h4>
                          <h5>Reports</h5>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-4 mb-4">
                      <div class="card bg-danger text-white shadow text-center">
                        <div class="card-body">
<?php $select_staff=mysqli_query($conn,"SELECT * FROM staff WHERE station_id='$station_id'");
$staff=mysqli_num_rows($select_staff); ?>
                          <h4 class="mb-3"><?=$staff?></h4>
                          <h5>Staff</h5>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-4 mb-4">
                      <div class="card bg-danger text-white shadow text-center">
                        <div class="card-body">
 <?php $select=mysqli_query($conn,"SELECT * FROM reports WHERE station_id='$station_id'");
$reports=mysqli_num_rows($select); ?>
                          <h4 class="mb-3"><?=$reports?></h4>
                          <h5>Cases in this Year</h5>
                        </div>
                      </div>
                  </div>


            </div>
<?php 
$query = mysqli_query($conn,"SELECT * FROM station WHERE station_id=$station_id");
$data = mysqli_fetch_assoc($query);
$lat=$data['station_latitude'];
$long=$data['station_longitude'];
if (!empty($lat) && !empty($long)) {?>
          <iframe height="300" width="100%" src = "https://maps.google.com/maps?q=<?=$lat?>,<?=$long?>&hl=es;z=14&amp;output=embed"></iframe>

<?php } ?>
</div>

<script>
var x = document.getElementById('lat');
var y = document.getElementById('long');

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  // x.innerHTML = "Latitude: " + position.coords.latitude + 
  // "<br>Longitude: " + position.coords.longitude;

x.value = position.coords.latitude ;
y.value = position.coords.longitude;
}



</script>

<?php include 'include/footer.php'; ?>
