<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $team_name=$_POST['team_name'];
  $team_username=$_POST['team_username'];
  $team_password=$_POST['team_password'];

$enter=mysqli_query($conn,"SELECT * FROM rescue_team WHERE station_id='$station_id' OR team_username='$team_username'");
if(mysqli_num_rows($enter)> 0){
      $msg="Fire Engine already exists.";
      $status="warning";
}elseif(mysqli_num_rows($enter) == 0){
  
        $query=mysqli_query($conn,"INSERT INTO  rescue_team (station_id, team_name, team_username, team_password)VALUES('$station_id','$team_name','$team_username','$team_password') ");
        $msg="Success";
        $status="success";
    }else{
        echo "";
        $msg="Error.";
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
                    <div class="col-lg-12">
                        <div class="p-5 bg-light">
                            <div class="text-center">
                                <h1 class="h4 text-dark-900 mb-4">Add FireEngine</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-user" name="team_name" id="team_name"
                                            placeholder="FireEngine Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="team_username" class="form-control form-control-user"
                                             placeholder="Enter UserName" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="team_password" class="form-control form-control-user"
                                            id="" placeholder="Password" required>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger btn-user btn-block">
                                    Register FireEngine
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