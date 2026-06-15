<?php include 'include/header.php';
include '../connection/connectdatabase.php';
if (!empty($_POST) AND isset($_POST['submit'])) {
  $station_latitude = $_POST['latitude'];
  $station_longitude = $_POST['longitude'];
  if (mysqli_query($conn, "UPDATE station SET station_latitude='$station_latitude',station_longitude='$station_longitude' WHERE station_id='$station_id'")) {
    $msg = "Station activated successfully";
    $status = "success";
  } else {
    $msg = "Error updating station location";
    $status = "danger";
  }
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM station WHERE station_id=$station_id"));
$lat = $data['station_latitude'];
$long = $data['station_longitude'];
$num = function ($conn, $sql) { $r = mysqli_query($conn, $sql); return $r ? mysqli_num_rows($r) : 0; };
$reports = $num($conn, "SELECT 1 FROM reports WHERE station_id='$station_id'");
$staff   = $num($conn, "SELECT 1 FROM staff WHERE station_id='$station_id'");

$cards = [
  ['Reports',         $reports, 'red',   'fa-file-alt'],
  ['Staff Members',   $staff,   'blue',  'fa-users'],
  ['Cases This Year', $reports, 'amber', 'fa-calendar-check'],
];
?>

<div class="container-fluid px-4 py-4">
  <h3 class="fr-page-title">Station Dashboard</h3>

  <?php if (isset($msg)) { ?>
  <div class="alert alert-<?=$status?> alert-dismissible" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?>
  </div>
  <?php } ?>

  <?php if (empty($lat) && empty($long)) { ?>
  <div class="card mb-4">
    <div class="card-body p-4">
      <h5 class="font-weight-bold mb-1"><i class="fas fa-map-marker-alt text-danger mr-2"></i>Activate Your Station</h5>
      <p class="text-muted mb-3">Set your station's location so nearby complaints are routed to you automatically.</p>
      <form action="#" method="POST" class="form-inline">
        <input type="text" class="form-control mr-2 mb-2" name="latitude" id="lat" placeholder="Latitude" required>
        <input type="text" class="form-control mr-2 mb-2" name="longitude" id="long" placeholder="Longitude" required>
        <button type="submit" class="btn btn-danger mb-2" onmouseover="getLocation()" name="submit">
          <i class="fas fa-location-arrow mr-2"></i> Activate Station
        </button>
      </form>
    </div>
  </div>
  <?php } ?>

  <div class="row">
    <?php foreach ($cards as $c) { list($label, $count, $color, $icon) = $c; ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="fr-stat-card fr-sc-<?=$color?>">
        <div class="fr-sc-icon"><i class="fas <?=$icon?>"></i></div>
        <div class="fr-sc-meta">
          <span class="fr-sc-num"><?=$count?></span>
          <span class="fr-sc-label"><?=$label?></span>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>

  <?php if (!empty($lat) && !empty($long)) { ?>
  <div class="card">
    <div class="card-body p-2">
      <iframe height="320" width="100%" style="border:0; border-radius:12px;"
        src="https://maps.google.com/maps?q=<?=$lat?>,<?=$long?>&hl=es;z=14&amp;output=embed"></iframe>
    </div>
  </div>
  <?php } ?>
</div>

<script>
var x = document.getElementById('lat');
var y = document.getElementById('long');

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  x.value = position.coords.latitude;
  y.value = position.coords.longitude;
}
</script>

<?php include 'include/footer.php'; ?>
