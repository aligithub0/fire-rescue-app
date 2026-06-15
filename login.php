<?php
session_start();
if (isset($_SESSION['admin_id'])) {
  header("location:admin/index.php");
} elseif (isset($_SESSION['station_id'])) {
  header("location:station/index.php");
} elseif (isset($_SESSION['team_id'])) {
  header("location:fireEngine/index.php");
}

if (isset($_GET['status'])) {
  $status = $_GET['status'];
  $msg = "Username or password not correct";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login — Fire Rescue Response System</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/truck.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="assets/dist/modern.css?v=6" />
  </head>

  <body class="fr-page fr-login-page">
    <div class="fr-login">
      <!-- Brand panel -->
      <div class="fr-login-brand">
        <div class="fr-login-logo">
          <img src="assets/img/station.png" alt="Fire Rescue" />
          <span>Fire Rescue</span>
        </div>
        <h2>Rescue Control Center</h2>
        <p>Sign in to manage stations, complaints, reports and dispatch — all from one dashboard.</p>
        <ul class="fr-login-roles">
          <li><i class="fa-solid fa-user-shield"></i> Administrators</li>
          <li><i class="fa-solid fa-building-shield"></i> Fire Stations</li>
          <li><i class="fa-solid fa-truck-fast"></i> Rescue Teams</li>
        </ul>
      </div>

      <!-- Form panel -->
      <div class="fr-login-form">
        <h1>Welcome back</h1>
        <p class="fr-sub">Please sign in to your account to continue.</p>

        <?php if (isset($msg)) { ?>
        <div class="fr-login-alert">
          <i class="fa-solid fa-circle-exclamation"></i> <?= $msg ?>
        </div>
        <?php } ?>

        <form method="POST" action="login_code.php">
          <div class="fr-field">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="user_name" class="fr-input" placeholder="Enter User Name..." required />
          </div>
          <div class="fr-field">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" class="fr-input" placeholder="Password" required />
          </div>
          <button type="submit" name="login" class="fr-btn fr-btn-fire fr-btn-lg">
            <i class="fa-solid fa-right-to-bracket"></i> Login
          </button>
        </form>

        <div class="fr-login-back">
          <a href="index.php"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
        </div>
      </div>
    </div>
  </body>
</html>
