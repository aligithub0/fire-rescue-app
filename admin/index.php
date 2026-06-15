<?php $page_title = 'Dashboard Overview'; include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php';
  $num = function ($conn, $sql) { $r = mysqli_query($conn, $sql); return $r ? mysqli_num_rows($r) : 0; };
  $stations   = $num($conn, "SELECT 1 FROM station");
  $staff      = $num($conn, "SELECT 1 FROM staff");
  $reports    = $num($conn, "SELECT 1 FROM reports");
  $complaints = $num($conn, "SELECT 1 FROM complaint");
  $accept     = $num($conn, "SELECT 1 FROM complaint WHERE status='accept'");
  $reject     = $num($conn, "SELECT 1 FROM complaint WHERE status='reject'");
  $high       = $num($conn, "SELECT 1 FROM complaint WHERE severity='High'");
  $medium     = $num($conn, "SELECT 1 FROM complaint WHERE severity='Medium'");
  $low        = $num($conn, "SELECT 1 FROM complaint WHERE severity='Low'");

  $cards = [
    ['Total Stations',      $stations,   'red',    'fa-building'],
    ['Total Staff',         $staff,      'blue',   'fa-users'],
    ['Total Reports',       $reports,    'purple', 'fa-file-alt'],
    ['Total Complaints',    $complaints, 'amber',  'fa-bell'],
    ['Accepted Complaints', $accept,     'green',  'fa-check-circle'],
    ['Rejected Complaints', $reject,     'slate',  'fa-times-circle'],
  ];
  $sev = [
    ['High Severity',   $high,   'red',   'fa-fire'],
    ['Medium Severity', $medium, 'amber', 'fa-fire-alt'],
    ['Low Severity',    $low,    'green', 'fa-fire'],
  ];
?>

<div class="container-fluid px-4 py-3">

  <div class="row">
    <?php foreach ($cards as $c) { list($label, $count, $color, $icon) = $c; ?>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="fr-stat-card fr-sc-<?=$color?>">
        <div class="fr-sc-icon"><i class="fas <?=$icon?>"></i></div>
        <div class="fr-sc-meta">
          <span class="fr-sc-num"><?=$count?></span>
          <span class="fr-sc-label"><?=$label?></span>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>

  <h3 class="fr-page-title mt-2">
    <i class="fas fa-robot mr-2" style="color:var(--fr-red)"></i> AI Severity Breakdown
  </h3>
  <div class="row">
    <?php foreach ($sev as $c) { list($label, $count, $color, $icon) = $c; ?>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="fr-stat-card fr-sc-<?=$color?>">
        <div class="fr-sc-icon"><i class="fas <?=$icon?>"></i></div>
        <div class="fr-sc-meta">
          <span class="fr-sc-num"><?=$count?></span>
          <span class="fr-sc-label"><?=$label?></span>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<!-- End of Main Content -->
<?php include 'include/footer.php'; ?>
