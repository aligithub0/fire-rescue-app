<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>

<div class="container-fluid col-md-12 col-sm-10">

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4 ">
            <div class="card shadow h-100 py-2 bg-gradient-danger">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1">
                                Total Station
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php $select=mysqli_query($conn,"SELECT * FROM station");
$station=mysqli_num_rows($select); ?>
                                <?=$station?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4 ">
            <div class="card shadow h-100 py-2 bg-gradient-danger">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1">
                                Total Staff
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php $select=mysqli_query($conn,"SELECT * FROM staff");
$staff=mysqli_num_rows($select); ?>
                                <?=$staff?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4 ">
            <div class="card shadow h-100 py-2 bg-gradient-danger">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1">
                                Total Reports
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php $select=mysqli_query($conn,"SELECT * FROM reports");
$reports=mysqli_num_rows($select); ?>
                                <?=$reports?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="container-fluid col-md-12 col-sm-10">

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4 ">
            <div class="card shadow h-100 py-2 bg-gradient-danger">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1">
                                Total Complaints
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php $select=mysqli_query($conn,"SELECT * FROM complaint");
$complaint=mysqli_num_rows($select); ?>
                                <?=$complaint?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4 ">
            <div class="card shadow h-100 py-2 bg-gradient-danger">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1">
                                Accepted Complaints
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php $select=mysqli_query($conn,"SELECT * FROM complaint WHERE status='accept'");
$accept=mysqli_num_rows($select); ?>
                                <?=$accept?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4 ">
            <div class="card shadow h-100 py-2 bg-gradient-danger">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1">
                                Rejected Complaints
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">
                                <?php $select=mysqli_query($conn,"SELECT * FROM complaint WHERE status='reject'");
$reject=mysqli_num_rows($select); ?>
                                <?=$reject?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- AI Severity Breakdown -->
<div class="container-fluid col-md-12 col-sm-10">
    <h5 class="text-gray-800 mb-3">AI Severity Breakdown</h5>
    <div class="row">
<?php
  $high   = mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM complaint WHERE severity='High'"));
  $medium = mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM complaint WHERE severity='Medium'"));
  $low    = mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM complaint WHERE severity='Low'"));
  $sev_cards = [
    ['High Severity',   $high,   'danger'],
    ['Medium Severity', $medium, 'warning'],
    ['Low Severity',    $low,    'success'],
  ];
  foreach ($sev_cards as $card) { list($label, $count, $color) = $card; ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 bg-gradient-<?=$color?>">
                <div class="card-body">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-white text-uppercase mb-1"><?=$label?></div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?=$count?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
    </div>
</div>

        <!-- End of Main Content -->

        <?php include'include/footer.php'; ?>