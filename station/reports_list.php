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
                            <h6 class="m-0 font-weight-bold text-danger">Reports</h6>
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
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Case</th>
                                            <th>City</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Action</th>                          
                                        </tr>
                                    </tfoot>
                                    <tbody>
 <?php 
            $view= mysqli_query($conn,"SELECT * FROM reports WHERE station_id='$station_id'");
            while($row=mysqli_fetch_assoc($view)) {
?>           
               <tr>
                   <td><?=$row['case_name']?></td>  
                   <td><?=$row['city']?></td>  
                   <td><?=$row['location_name']?></td>  
                   <td><?=$row['report_date']?></td>
                   <td>
                    <a href="report_detail.php?id=<?=$row['report_id']?>">View</a> |
                    <a href="edit_report.php?edit_id=<?=$row['report_id']?>" class="text-success">Edit</a> |
                    <a href="reports_list.php?dlt_id=<?=$row['report_id']?>" class="text-danger">Delete</a>
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

  
<?php include 'include/footer.php'; ?>
