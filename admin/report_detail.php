<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>


<table class="table table-hover col-sm-12 col-md-8  mx-auto ">
 <?php 
            if (isset($_GET['report_id'])){ $id=$_GET['report_id'];}
            $view= mysqli_query($conn,"SELECT * FROM reports WHERE report_id='$id'");
            $row=mysqli_fetch_assoc($view);
                 $station_id=$row['station_id'];
?>          
            

	<tr>
		<th>Case Name</th>
		<td><?=$row['case_name']?></td>  
		<th>City</th>
		<td><?=$row['city']?></td>  

	</tr>
	<tr>
		<th>Address</th>
		<td><?=$row['location_name']?></td>
		<th>Date</th>
		<td><?=$row['report_date']?></td>
	</tr>
	<tr>
		<th>Station</th>
		<?php $query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$station_id'");
      $data = mysqli_fetch_assoc($query); ?>
		<td><?=$data['station_name']?></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<th colspan="4">Detail</th>
	</tr>
	<tr>
		<td colspan="4"><?=$row['complete_detail']?></td>
	</tr>
</table>

<?php include 'include/footer.php'; ?>