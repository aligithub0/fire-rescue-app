<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php if (isset($_GET['id'])){ $id=$_GET['id'];}
if (isset($id)) { $query = mysqli_query($conn,"DELETE FROM staff WHERE staff_id='$id'"); }  ?>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                     <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">All Staff Members</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Father_Name</th>
                                            <th>CNIC</th>
                                            <th>Address</th>
                                            <th>Station</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Father_Name</th>
                                            <th>CNIC</th>
                                            <th>Address</th> 
                                            <th>Station</th>
                                            <th>Action</th>                          
                                        </tr>
                                    </tfoot>
                                    <tbody>
 <?php 

            if (isset($_GET['staff_id'])){ 
             $id=$_GET['staff_id'];
             $query = mysqli_query($conn,"DELETE FROM staff WHERE staff_id='$id'"); 
         } 

            $view= mysqli_query($conn,"SELECT * FROM staff ");
            while($row=mysqli_fetch_assoc($view)) {
            $station_id=$row['station_id'];
?>           
               <tr>
                   <td><?=$row['staff_id']?></td>  
                   <td><?=$row['staff_name']?></td>  
                   <td><?=$row['father_name']?></td>  
                   <td><?=$row['staff_cnic']?></td>
                   <td><?=$row['staff_address']?></td>
<?php $query = mysqli_query($conn,"SELECT * FROM station WHERE station_id='$station_id'");
      $data = mysqli_fetch_assoc($query); ?>
                   <td><?=$data['station_name']?></td>
                   <td>
                    <a href="manage_staff.php?id=<?=$row['staff_id']?>" class="btn text-danger btn-sm ">Delete</a>|
                    <a href="staff_detail.php?id=<?=$row['staff_id']?>" class="btn text-primary btn-sm">View</a>|
                    <a href="edit_staff.php?id=<?=$row['staff_id']?>" class="btn text-success btn-sm">Edit</a>
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
