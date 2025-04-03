<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 

if (isset($_GET['id'])){ $id=$_GET['id'];}else{echo "<script>window.location='station.php'</script>";}


if (!empty($_POST) AND isset($_POST['submit'])) {

  $station_name=$_POST['station_name'];
  $station_contact=$_POST['station_contact'];
  $station_username=$_POST['station_username'];
  $station_password=$_POST['station_password'];
  $station_city=$_POST['station_city'];
 
        $query=mysqli_query($conn,"UPDATE station SET station_name='$station_name',station_contact='$station_contact',station_username='$station_username',station_password='$station_password',station_city='$station_city' WHERE station_id='$id'");
        if ($query) {
        echo "<script>window.location='station_detail.php?id=$id'</script>";
    }else{
        echo "";
        $msg="Error....";
        $status="danger";
        }
    
}


 ?>

<div class="col-lg-8 mx-auto">
  
    <div class="container">
<?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?></div>
<?php } ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 bg-gradient-light">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Edit Station Data</h1>
                            </div>
<?php  $query= mysqli_query($conn,"SELECT * FROM station WHERE station_id='$id' ");
    $row=mysqli_fetch_assoc($query); ?>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="station_name" id="station_name"
                                            placeholder="Station Name"  value="<?=$row['station_name']?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="station_contact" class="form-control form-control-user" id=""
                                            placeholder="Contact Number" value="<?=$row['station_contact']?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="station_username" class="form-control form-control-user"
                                             placeholder="Enter UserName" value="<?=$row['station_username']?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="station_password" class="form-control form-control-user"
                                            id="" placeholder="Password" value="<?=$row['station_password']?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="station_city">
                                      <option value="<?=$row['station_city']?>" selected><?=$row['station_city']?></option>
                                      <option value="faisalabad">Faisalabad</option>
                                      <option value="toba_tek_singh">Toba Tek Singh</option>
                                      <option value="gojra">Gojra</option>
                                      <option value="lahore">Lahore</option>
                                      <option value="Jhang">Jhang</option>
                                      <option value="multan">Multan</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger font-weight-bold btn-user btn-block">
                                    Update</button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


          

 
<?php include 'include/footer.php'; ?>