<?php include 'connection/connectdatabase.php'; ?>
<?php include 'ai/severity_client.php'; ?>

<?php
if (!empty($_POST) AND isset($_POST['submit'])) {
  
    $complaint_latitude = $_POST['complaint_latitude'];
    $complaint_longitude = $_POST['complaint_longitude'];
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $building = isset($_POST['building']) ? $_POST['building'] : '';
    
    if (empty($complaint_latitude) || empty($complaint_longitude)) {
        echo "<script>window.location='complaint.php?error=location'</script>";
        exit;
    }
    if (empty($_POST['image'])) {
        echo "<script>window.location='complaint.php?error=image'</script>";
        exit;
    }

    // Find nearest station
    $query = mysqli_query($conn,"SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $complaint_latitude - station_latitude) *  pi()/180 / 2), 2) +COS( $complaint_latitude * pi()/180) * COS(station_latitude * pi()/180) * POWER(SIN(( $complaint_longitude - station_longitude) * pi()/180 / 2), 2) ))) as distance from station having distance <= 1000 order by distance");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        echo "<script>window.location='complaint.php?error=station'</script>";
        exit;
    }

    $station_id = $data['station_id'];

    // Handle image
    $img = $_POST['image'];
    $folderPath = "upload/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    // Insert complaint
    $insert = "INSERT INTO complaint (station_id, complaint_latitude, complaint_longitude, complaint_image, contact, building) VALUES ('$station_id','$complaint_latitude','$complaint_longitude','$fileName','$contact','$building')";

    if (mysqli_query($conn, $insert)) {
        $complaint_id = mysqli_insert_id($conn);

        // --- AI Severity Prediction (best-effort) ---
        // The complaint is already saved; if the AI service is down the row
        // simply keeps severity = 'unknown'.
        $ai = ai_predict_severity($fileName);
        if ($ai) {
            $severity = mysqli_real_escape_string($conn, $ai['severity']);
            $threat   = mysqli_real_escape_string($conn, $ai['threat_level']);
            $ftype    = mysqli_real_escape_string($conn, $ai['fire_type']);
            $conf     = (float) $ai['confidence'];
            $engines  = recommend_engines($ai['severity']);

            $update = "UPDATE complaint SET severity='$severity', engines_recommended=$engines, threat_level='$threat', fire_type='$ftype', ai_confidence=$conf, ai_timestamp=NOW() WHERE complaint_id=$complaint_id";
            mysqli_query($conn, $update);
        }

        echo "<script>window.location='complaint.php?success=$station_id'</script>";
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }

} else {
    echo "<script>window.location='complaint.php?error=post'</script>";
}
?>