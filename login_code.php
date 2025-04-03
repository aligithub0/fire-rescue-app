 <?php session_start();
 include "connection/connectdatabase.php";?>
<?php

 
if (isset($_POST['login'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        echo $user_name;
        echo $password; 
 
    $admin = mysqli_query($conn, "SELECT * FROM admin WHERE admin_username = '$user_name'");
    $admin_data = mysqli_fetch_assoc($admin);
    $admin_password=$admin_data['admin_password'];
 
  
    $station = mysqli_query($conn, "SELECT * FROM station WHERE station_username= '$user_name'");
    $station_data = mysqli_fetch_assoc($station);
    $station_password=$station_data['station_password'];
  

    $team = mysqli_query($conn, "SELECT * FROM rescue_team WHERE team_username= '$user_name'");
    $team_data = mysqli_fetch_assoc($team);
    $team_password=$team_data['team_password'];

    if ($admin_password == $password) {
       $_SESSION['admin_id'] = $admin_data['admin_id'];
        header("location:admin/index.php");
    }
    elseif ($station_password == $password ) {
        $_SESSION['station_id'] = $station_data['station_id'];
        header("location:station/index.php");
    }
    elseif ($team_password == $password) {
        $_SESSION['team_id'] = $team_data['team_id'];
        header("location:fireEngine/index.php");
    }
    else{
        header("location:login.php?status=danger");
    }
}

        


 ?>
