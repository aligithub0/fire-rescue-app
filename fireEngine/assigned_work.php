<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>


<?php
  $select = mysqli_query($conn,"SELECT * FROM rescue_team WHERE team_id='$team_id'");
       $result = mysqli_fetch_assoc($select);
       $station_id=$result['station_id'];

  $query = mysqli_query($conn,"SELECT * FROM complaint WHERE status='accept' AND station_id='$station_id' ORDER BY complaint_id DESC LIMIT 1");
if(mysqli_num_rows($query)> 0){
       $data = mysqli_fetch_assoc($query);
          $lat=$data['complaint_latitude'];
          $long=$data['complaint_longitude'];
?>   


<iframe width="100%" height="80%" src = "https://maps.google.com/maps?q=<?=$lat?>,<?=$long?>&hl=es;z=14&amp;output=embed"></iframe>
      
<?php  }else{

	$msg="No Work Assigned yet!";
      $status="warning";?>

<?php if(isset($msg)){ ?>
    <div class="alert text-center alert-<?=$status?>" role="alert"><?=$msg?></div>
    <div class="col-12" role="alert">
    	<div class="col-md-8 mx-auto">
    	<img src="include/fireStation.png" class="mx-auto" width="100%" alt="Image">
    	</div>	
    </div>
<?php } ?>

<?php } ?> 



<?php include 'include/footer.php'; ?>