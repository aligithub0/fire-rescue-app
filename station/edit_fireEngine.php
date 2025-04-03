<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $team_name=$_POST['team_name'];
  $team_username=$_POST['team_username'];
  $team_password=$_POST['team_password'];

$enter=mysqli_query($conn,"SELECT * FROM rescue_team WHERE team_username='$team_username'");
if(mysqli_num_rows($enter)> 0){
      $msg="Fire Engine already exists.";
      $status="warning";
}elseif(mysqli_num_rows($enter) == 0){
  
        $query=mysqli_query($conn,"UPDATE rescue_team SET team_name='$team_name',team_username='$team_username',team_password='$team_password' WHERE station_id='$station_id'");
        if ($query) {
        echo "<script>window.location='view_fireEngine.php'</script>";
    }else{
        $msg="Error";
        $status= 'danger';
        }
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
                                <h1 class="h4 text-dark-900 mb-4">Edit FireEngine</h1>
                            </div>
<?php  $query= mysqli_query($conn,"SELECT * FROM rescue_team WHERE station_id='$station_id'");
    $row=mysqli_fetch_assoc($query); ?>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-user" name="team_name" id="team_name"
                                            placeholder="FireEngine Name" value="<?=$row['team_name']?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="team_username" class="form-control form-control-user"
                                             placeholder="Enter UserName" value="<?=$row['team_username']?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="team_password" class="form-control form-control-user"
                                            id="" placeholder="Password" value="<?=$row['team_password']?>" required>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger btn-user btn-block">
                                    Update 
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