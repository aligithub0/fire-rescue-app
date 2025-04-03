<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>


<table class="table table-hover col-sm-12 col-md-8 mx-auto text-dark border-dark">
 <?php 
            if (isset($_GET['id'])){ $id=$_GET['id'];}
            $view= mysqli_query($conn,"SELECT * FROM reports WHERE report_id='$id'");
            $row=mysqli_fetch_assoc($view);
                 $station_id=$row['station_id'];
?>          
            

	<tr>
		<th>Case Name:</th>
		<td><?=$row['case_name']?></td>  
		<th style="border-left:1px solid black ;">City:</th>
		<td><?=$row['city']?></td>  

	</tr>
	<tr>
		<th>Address:</th>
		<td><?=$row['location_name']?></td>
		<th style="border-left:1px solid black ;">Date:</th>
		<td><?=$row['report_date']?></td>
	</tr>
	<tr>
		<th colspan="2">Station:</th>
		<?php $query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$station_id'");
      $data = mysqli_fetch_assoc($query); ?>
		<td colspan="2"><?=$data['station_name']?></td>
	</tr>
	<tr>
		<th colspan="4">Detail:</th>
	</tr>
	<tr>
		<td colspan="4"><?=$row['complete_detail']?></td>
	</tr>
</table>

<?php include 'include/footer.php'; ?>