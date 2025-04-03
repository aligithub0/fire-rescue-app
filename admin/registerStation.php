<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (!empty($_POST) AND isset($_POST['submit'])) {

  $station_name=$_POST['station_name'];
  $station_contact=$_POST['station_contact'];
  $station_username=$_POST['station_username'];
  $station_password=$_POST['station_password'];
  $station_city=$_POST['station_city'];

  
 
$select=mysqli_query($conn,"SELECT * FROM station WHERE station_username='$station_username'");
if(mysqli_num_rows($select)> 0){
      $msg="Username already exists in Database";
      $status="warning";
}elseif(mysqli_num_rows($select)== 0){
  

        $query=mysqli_query($conn,"INSERT INTO  station (station_name, station_contact, station_username, station_password, station_city)VALUES('$station_name','$station_contact','$station_username','$station_password','$station_city') ");
        $msg="Success";
        $status="success";
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
                                <h1 class="h4 text-gray-900 mb-4">Add New Station</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="station_name" id="station_name"
                                            placeholder="Station Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="station_contact" class="form-control form-control-user" id=""
                                            placeholder="Contact Number">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <input type="text" name="sta" class="form-control form-control-user"
                                        placeholder="Station Name">
                                </div> -->
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="station_username" class="form-control form-control-user"
                                             placeholder="Enter UserName">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="station_password" class="form-control form-control-user"
                                            id="" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="station_city">
                                      <option selected>Select City</option>
                                      <option value="faisalabad">Faisalabad</option>
                                      <option value="toba_tek_singh">Toba Tek Singh</option>
                                      <option value="gojra">Gojra</option>
                                      <option value="lahore">Lahore</option>
                                      <option value="Jhang">Jhang</option>
                                      <option value="multan">Multan</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger font-weight-bold btn-user btn-block">
                                    Register Station
                                </button>
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