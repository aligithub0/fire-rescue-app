<?php include 'include/header.php'; ?>
<?php include 'connection/connectdatabase.php'; ?>
<?php if(isset($_GET['success'])){ 
      $station_id=$_GET['success'];
      $query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$station_id'");
      $data = mysqli_fetch_assoc($query);
      $msg="Your Complaint Is Submitted at : ".'<b>'. $data['station_name'].'</b>';
      $status="success";
  }elseif (isset($_GET['error'])) {
     $msg="Something went Wrong";
      $status="danger";
  }
?>
<div class="container mt-5">
    <hr>
    <h1 class="text-center bg-light">Submit Urgent Complaint</h1>
    <hr>
    <?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><?=$msg?></div>
    <?php } ?>
    <form method="POST" class="form-group" action="storeimage.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br />
                <div class="col-md-12">
                    <input type="button" value="Take Picture" class="btn btn-danger mx-auto" onClick="take_snapshot()"
                        onfocus="getLocation()">
                    <input type="button" value="Upload Picture" class="btn btn-primary mx-auto ml-2"
                        onClick="document.getElementById('file_input').click()">
                    <input type="file" id="file_input" name="uploaded_image" accept="image/*" style="display:none;"
                        onchange="handleFileSelect(event)">
                </div>
                <input type="hidden" name="image" class="image-tag">
                <input type="hidden" name="image_source" id="image_source" value="">
                <input type="hidden" class="p-1" name="complaint_latitude" id="lat" required>
                <input type="hidden" class="p-1" name="complaint_longitude" id="long" required>

            </div>
            <div class="col-md-6" style="">
                <div id="results">Your captured/uploaded image will appear here.</div>
            </div>
            <div class="col-md-12 text-center">
                <div class="col-md-12 mt-1">
                    <!-- <input type="text" class="form-control form-control-user col-md-6 p-1" placeholder="Enter Phone Number" name="contact" required>
                
                <input type="text" class="form-control form-control-user col-md-6 p-1" name="building" placeholder="Address e.g(Building/street no.)"  > -->

                </div>
                <input type="submit" name="submit" value="Submit Your Complaint" class="btn btn-danger mt-2">
            </div>
        </div>
    </form>
</div>
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
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.value = position.coords.latitude;
    y.value = position.coords.longitude;
}
</script>
<?php include 'include/footer.php'; ?>