<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php';
  $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rescue_team WHERE team_id='$team_id'"));
  $station_id = $data['station_id'];
  $station = mysqli_fetch_assoc(mysqli_query($conn, "SELECT station_name FROM station WHERE station_id='$station_id'"));
  $station_name = $station ? $station['station_name'] : '—';
  $num = function ($conn, $sql) { $r = mysqli_query($conn, $sql); return $r ? mysqli_num_rows($r) : 0; };
  $active    = $num($conn, "SELECT 1 FROM complaint WHERE station_id='$station_id' AND status='accept'");
  $total_st  = $num($conn, "SELECT 1 FROM complaint WHERE station_id='$station_id'");
?>

<div class="container-fluid px-4 py-4">

  <!-- Welcome banner -->
  <div class="fr-welcome">
    <div>
      <span class="fr-welcome-badge"><span class="fr-dot"></span> On Duty</span>
      <h2>Welcome, <?= htmlspecialchars($data['team_name']) ?></h2>
      <p>Rescue Team Dashboard &middot; <?= htmlspecialchars($station_name) ?></p>
    </div>
    <div class="fr-welcome-icon"><i class="fas fa-truck-moving"></i></div>
  </div>

  <!-- Stat cards -->
  <div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="fr-stat-card fr-sc-red">
        <div class="fr-sc-icon"><i class="fas fa-fire"></i></div>
        <div class="fr-sc-meta">
          <span class="fr-sc-num"><?= $active ?></span>
          <span class="fr-sc-label">Active Assignments</span>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="fr-stat-card fr-sc-blue fr-sc-text">
        <div class="fr-sc-icon"><i class="fas fa-building"></i></div>
        <div class="fr-sc-meta">
          <span class="fr-sc-num"><?= htmlspecialchars($station_name) ?></span>
          <span class="fr-sc-label">Assigned Station</span>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="fr-stat-card fr-sc-green">
        <div class="fr-sc-icon"><i class="fas fa-clipboard-list"></i></div>
        <div class="fr-sc-meta">
          <span class="fr-sc-num"><?= $total_st ?></span>
          <span class="fr-sc-label">Total Complaints (Station)</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Profile + action -->
  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="card h-100">
        <div class="card-body p-4">
          <h5 class="fr-card-title"><i class="fas fa-id-badge"></i> Team Profile</h5>
          <div class="fr-profile-row">
            <span><i class="fas fa-hashtag"></i> Team ID</span>
            <strong><?= htmlspecialchars($data['team_id']) ?></strong>
          </div>
          <div class="fr-profile-row">
            <span><i class="fas fa-users"></i> Team Name</span>
            <strong><?= htmlspecialchars($data['team_name']) ?></strong>
          </div>
          <div class="fr-profile-row">
            <span><i class="fas fa-building"></i> Station</span>
            <strong><?= htmlspecialchars($station_name) ?></strong>
          </div>
          <div class="fr-profile-row">
            <span><i class="fas fa-circle-check"></i> Status</span>
            <strong style="color:#16b364;">Active</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5 mb-4">
      <div class="card h-100">
        <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
          <img src="../assets/img/team.png" alt="Rescue Team" style="max-width:230px; height:auto; margin:0 auto 20px;">
          <?php if ($active > 0) { ?>
            <p class="mb-3 font-weight-bold" style="color:var(--fr-red)">
              <i class="fas fa-bell mr-1"></i> You have <?= $active ?> active assignment<?= $active > 1 ? 's' : '' ?>!
            </p>
          <?php } else { ?>
            <p class="text-muted mb-3"><i class="fas fa-check-circle mr-1"></i> No active assignments right now.</p>
          <?php } ?>
          <a href="assigned_work.php" class="btn btn-danger btn-lg">
            <i class="fas fa-map-marked-alt mr-2"></i> View Assigned Work
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>
