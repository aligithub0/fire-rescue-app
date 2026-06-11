<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php include '../ai/severity_client.php'; ?>


<div class="container">
              <div class="row m-6 justify-content-center">
                <div class="col-lg-12 mb-4">
                  <div class="row">
<?php if (isset($_GET['accept'])){
 $id=$_GET['accept'];
 $query = mysqli_query($conn,"UPDATE complaint SET status='accept' WHERE complaint_id='$id'");
}

if (isset($_GET['reject'])){ 
  $id=$_GET['reject'];
   $query = mysqli_query($conn,"UPDATE complaint SET status='reject' WHERE complaint_id='$id'");
 }
 $query = mysqli_query($conn,"SELECT * FROM complaint WHERE status='new'");
          while ($data = mysqli_fetch_assoc($query)) { 
          $lat=$data['complaint_latitude'];
          $long=$data['complaint_longitude'];    
?>                  
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                      <div class="card text-white shadow bg-light">
                        <div class="card-body">
<?php
  $sev     = $data['severity'] ?? 'unknown';
  $cls     = severity_badge_class($sev);
  $conf    = (float)($data['ai_confidence'] ?? 0);
  $engines = (int)($data['engines_recommended'] ?? 0);
?>
                          <div class="alert alert-<?=$cls?> text-dark mb-3" role="alert">
                            <strong>AI Severity:</strong>
                            <span class="badge badge-<?=$cls?>"><?=strtoupper(htmlspecialchars($sev))?></span>
                            &nbsp;|&nbsp; Recommended engines: <strong><?=$engines?></strong>
                            &nbsp;|&nbsp; Threat: <strong><?=htmlspecialchars($data['threat_level'] ?? '-')?></strong>
                            &nbsp;|&nbsp; Type: <?=htmlspecialchars($data['fire_type'] ?? '-')?>
<?php if ($sev === 'unknown') { ?>
                            <span class="text-muted ml-2">(AI not available)</span>
<?php } elseif ($conf < 0.5) { ?>
                            <span class="text-danger ml-2">&#9888; Low confidence (<?=number_format($conf*100)?>%) &mdash; please review the image</span>
<?php } else { ?>
                            <span class="text-muted ml-2">Confidence: <?=number_format($conf*100)?>%</span>
<?php } ?>
                          </div>
                          <div class="row">
                            <div class="col-lg-5">
                              <img src="../upload/<?=$data['complaint_image']?>" height="300px" alt="">
                            </div>
                            <div class="col-lg-5">
                             <iframe height="300px" src = "https://maps.google.com/maps?q=<?=$lat?>,<?=$long?>&hl=es;z=14&amp;output=embed"></iframe>
                            </div>
                             <div class="col-lg-2 col-sm-12 text-gray-800">
                              <div class="mt-5">
                                <a href="complaint.php?accept=<?=$data['complaint_id']?>" class="btn-lg btn-success">Accept</a>
                              <br>
                              <br>
                              <a href="complaint.php?reject=<?=$data['complaint_id']?>" class="btn-lg btn-danger pr-4">Reject</a>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
<?php } ?>
                </div>
              </div>
          </div>
      </div>



<?php include 'include/footer.php'; ?>