<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php';
  $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rescue_team WHERE team_id='$team_id'"));
?>

<div class="container-fluid px-4 py-4">
  <h3 class="fr-page-title">Welcome, <?= htmlspecialchars($data['team_name']) ?></h3>

  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="card h-100">
        <div class="card-body p-4">
          <h5 class="font-weight-bold mb-4"><i class="fas fa-id-badge text-danger mr-2"></i>Team Profile</h5>
          <div class="fr-profile-row">
            <span><i class="fas fa-hashtag"></i> Team ID</span>
            <strong><?= htmlspecialchars($data['team_id']) ?></strong>
          </div>
          <div class="fr-profile-row">
            <span><i class="fas fa-users"></i> Team Name</span>
            <strong><?= htmlspecialchars($data['team_name']) ?></strong>
          </div>
          <div class="fr-profile-row">
            <span><i class="fas fa-user"></i> Username</span>
            <strong><?= htmlspecialchars($data['team_username']) ?></strong>
          </div>
          <div class="fr-profile-row">
            <span><i class="fas fa-lock"></i> Password</span>
            <strong><?= htmlspecialchars($data['team_password']) ?></strong>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5 mb-4">
      <div class="card h-100">
        <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
          <img src="../assets/img/team.png" alt="Rescue Team" style="max-width:230px; height:auto; margin:0 auto 22px;">
          <a href="assigned_work.php" class="btn btn-danger btn-lg">
            <i class="fas fa-map-marked-alt mr-2"></i> View Assigned Work
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>
