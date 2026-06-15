<?php include 'include/header.php'; ?>
<?php include 'connection/connectdatabase.php'; ?>
<?php if(isset($_GET['success'])){ 
      $station_id=$_GET['success'];
      $query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$station_id'");
      $data = mysqli_fetch_assoc($query);
      $msg="Your Complaint Is Submitted at : ".'<b>'. $data['station_name'].'</b>';
      $status="success";
  }elseif (isset($_GET['error'])) {
      $errors = [
          'location' => 'Location not detected. Please ALLOW location access in your browser, then try again.',
          'image'    => 'No image received. Please take a picture or upload one before submitting.',
          'station'  => 'No fire station found near your location.',
          'post'     => 'Submission failed (no data received). The image may be too large — try a smaller photo.',
      ];
      $msg = $errors[$_GET['error']] ?? 'Something went Wrong';
      $status="danger";
  }
?>
<section class="fr-report">
  <div class="fr-container">
    <div class="fr-report-head">
      <span class="fr-eyebrow">Emergency Report</span>
      <h1>Submit an Urgent Complaint</h1>
      <p>Take or upload a live photo of the fire. We'll capture your GPS location and alert the nearest station instantly.</p>
    </div>

    <?php if(isset($msg)){ ?>
    <div class="fr-alert alert alert-<?=$status?> alert-dismissible" role="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?>
    </div>
    <?php } ?>

    <form method="POST" action="storeimage.php" enctype="multipart/form-data">
      <div class="fr-form-card">
        <div class="fr-form-grid">
          <div class="fr-cam-box">
            <div id="my_camera"></div>
            <div class="fr-cam-actions">
              <button type="button" class="fr-btn fr-btn-fire" onclick="take_snapshot()" onfocus="getLocation()">
                <i class="fa-solid fa-camera"></i> Take Picture
              </button>
              <button type="button" class="fr-btn fr-btn-outline" onclick="document.getElementById('file_input').click()">
                <i class="fa-solid fa-upload"></i> Upload Picture
              </button>
              <input type="file" id="file_input" name="uploaded_image" accept="image/*" style="display:none;" onchange="handleFileSelect(event)">
            </div>
            <input type="hidden" name="image" class="image-tag">
            <input type="hidden" name="image_source" id="image_source" value="">
            <input type="hidden" name="complaint_latitude" id="lat" required>
            <input type="hidden" name="complaint_longitude" id="long" required>
          </div>

          <div id="results" class="fr-preview-box">
            <div>
              <i class="fa-regular fa-image" style="font-size:34px; display:block; margin-bottom:10px;"></i>
              Your captured / uploaded image will appear here.
            </div>
          </div>
        </div>

        <div class="fr-report-submit">
          <button type="submit" name="submit" value="Submit Your Complaint" class="fr-btn fr-btn-fire fr-btn-lg">
            <i class="fa-solid fa-paper-plane"></i> Submit Complaint
          </button>
        </div>

        <div class="fr-report-note">
          <span><i class="fa-solid fa-location-crosshairs"></i> GPS auto-detected</span>
          <span><i class="fa-solid fa-robot"></i> AI severity analysis</span>
          <span><i class="fa-solid fa-bolt"></i> Nearest station alerted</span>
        </div>
      </div>
    </form>
  </div>
</section>
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
Webcam.set({
    width: 490,
    height: 390,
    image_format: 'jpeg',
    jpeg_quality: 100
});

Webcam.attach('#my_camera');

function take_snapshot() {
    getLocation();
    Webcam.snap(function(data_uri) {
        $(".image-tag").val(data_uri);
        $("#image_source").val("camera");
        document.getElementById('results').innerHTML = '<img src="' + data_uri + '" style="max-width:100%;"/>';
    });
}

function handleFileSelect(event) {
    getLocation();
    const file = event.target.files[0];
    if (file && file.type.match('image.*')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const data_uri = e.target.result;
            $(".image-tag").val(data_uri);
            $("#image_source").val("upload");
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '" style="max-width:100%;"/>';
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script>
var x = document.getElementById('lat');
var y = document.getElementById('long');

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showPositionError, {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    x.value = position.coords.latitude;
    y.value = position.coords.longitude;
}

function showPositionError(error) {
    var reason = {
        1: "Location permission denied. Please allow location access and reload the page.",
        2: "Location is unavailable right now.",
        3: "Getting your location timed out. Please try again."
    }[error.code] || "Could not get your location.";
    alert(reason);
}

// Request location as soon as the page loads so it is ready before submitting.
window.addEventListener('load', getLocation);

// Final guard: block submission if we still have no coordinates.
document.querySelector('form').addEventListener('submit', function (e) {
    if (!x.value || !y.value) {
        e.preventDefault();
        alert("Your location has not been detected yet. Please allow location access and wait a moment before submitting.");
        getLocation();
    }
});
</script>
<?php include 'include/footer.php'; ?>