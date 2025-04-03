<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (isset($_GET['dlt_id'])) {
    $dlt_id=$_GET['dlt_id'];
    $query=mysqli_query($conn,"DELETE FROM reports WHERE report_id='$dlt_id'"); 
   $msg="Record Deleted..";
   $status= 'danger';
}
 ?>
<div class="container-fluid">
<?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?></div>
<?php } ?>
                <div class="card shadow mb-4">
                     <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Manage Reports</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Case</th>
                                            <th>City</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Station</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Case</th>
                                            <th>City</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Station</th>
                                            <th>Action</th>                          
                                        </tr>
                                    </tfoot>
                                    <tbody>
 <?php 
            $view= mysqli_query($conn,"SELECT * FROM reports");
            while($row=mysqli_fetch_assoc($view)) {
                 $station_id=$row['station_id'];
?>          
               <tr>
                   <td><?=$row['case_name']?></td>  
                   <td><?=$row['city']?></td>  
                   <td><?=$row['location_name']?></td>  
                   <td><?=$row['report_date']?></td>
<?php $query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$station_id'");
      $data = mysqli_fetch_assoc($query); ?>
                   <td><?=$data['station_name']?></td>
                   <td><small><a href="report_detail.php?report_id=<?=$row['report_id']?>">View</a> |
                    <a href="edit_report.php?edit_id=<?=$row['report_id']?>" class="text-success">Edit</a> |
                    <a href="manage_reports.php?dlt_id=<?=$row['report_id']?>" class="text-danger">Delete</a></small>
                   </td>

               </tr>   
             
<?php } ?>
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                 </div>
</div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="../assets/js/sb-admin-2.min.js"></script>

 
        <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="../assets/js/demo/datatables-demo.js"></script>
  </body>
</html>
