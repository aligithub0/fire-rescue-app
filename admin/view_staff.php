<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
  <div class="container">
              <div class="row m-6 justify-content-center">
                <div class="col-lg-10 mb-4">
                  <div class="row">
<?php if (isset($_GET['id'])){ $id=$_GET['id'];}
if (isset($id)) { $query = mysqli_query($conn,"DELETE FROM staff WHERE staff_id='$id'"); } 
 
          $query = mysqli_query($conn,"SELECT * FROM staff   ");
          while ($data = mysqli_fetch_assoc($query)) {     
        ?>    
               <div class="col-lg-4 mb-4 bg-light">
                      <div class="card text-white shadow text-center bg-gradient-light">
                        <div class="card-body">                       
                          <img height="200px" width="200px" src="../assets/img/fireman.png" alt="">
                          <div class="mt-5 text-gray-800">
                           <h5><?=$data['staff_name']?></h5>
                           <table cellpadding="5px" class="mx-auto">
                             <tr>
                               <td>CNIC : </td>
                               <td><?=$data['staff_cnic']?></td>
                             </tr>
                           </table>
                           <hr>
                            <div class="">
                                <a href="view_staff.php?id=<?=$data['staff_id']?>" class="btn text-danger btn-sm ">
                                  Delete
                                </a> |
                                 <a href="staff_detail.php?id=<?=$data['staff_id']?>" class="btn text-primary btn-sm">
                                  View
                                </a> |
                                <a href="edit_staff.php?id=<?=$data['staff_id']?>" class="btn text-success btn-sm">
                                  Edit
                                </a>
                             </div>
            
                          </div>
                        </div>
                      </div>
                    </div>
                     
        <?php } ?>        

              </div>
          </div>
      </div>
  </div>

<?php include 'include/footer.php'; ?>
