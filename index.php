<?php include 'include/header.php'; ?>
<?php include 'connection/connectdatabase.php';
  // Live counts for the stats band (best-effort; default to 0 on failure).
  $count = function ($conn, $table) {
      $r = mysqli_query($conn, "SELECT COUNT(*) AS n FROM $table");
      $row = $r ? mysqli_fetch_assoc($r) : null;
      return $row ? (int) $row['n'] : 0;
  };
  $stations   = $count($conn, 'station');
  $complaints = $count($conn, 'complaint');
  $reports    = $count($conn, 'reports');
?>

<!-- ===================== HERO ===================== -->
<section class="fr-hero">
  <div class="fr-container">
    <div class="fr-hero-grid">
      <div class="fr-hero-text">
        <span class="fr-pill"><span class="fr-dot"></span> Rescue Control Center — Online</span>
        <h1>Fire Emergencies,<br /><span class="fr-grad-text">Answered in Seconds.</span></h1>
        <p class="fr-lead">
          Report a fire with a single real-time photo. We pinpoint your GPS location, alert the
          nearest station, and use AI to estimate severity — so the right crew rolls out, fast.
        </p>
        <div class="fr-hero-cta">
          <a href="complaint.php" class="fr-btn fr-btn-fire fr-btn-lg">
            <i class="fa-solid fa-fire-flame-curved"></i> Report Emergency
          </a>
          <a href="posts.php" class="fr-btn fr-btn-outline fr-btn-lg">
            <i class="fa-regular fa-newspaper"></i> Read Safety Posts
          </a>
        </div>
      </div>

      <div class="fr-hero-art">
        <div class="fr-glow"></div>
        <img src="assets/img/fireengine.png" alt="Fire engine" />
        <div class="fr-hero-badge fr-badge-tl">
          <i class="fa-solid fa-location-crosshairs"></i>
          <div>GPS Located<small>Auto-routed to station</small></div>
        </div>
        <div class="fr-hero-badge fr-badge-br">
          <i class="fa-solid fa-robot"></i>
          <div>AI Severity<small>Low · Medium · High</small></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== STATS ===================== -->
<section class="fr-stats">
  <div class="fr-container">
    <div class="fr-stats-grid">
      <div class="fr-stat">
        <div class="fr-stat-num" data-count="<?= $stations ?>">0</div>
        <div class="fr-stat-label">Fire Stations</div>
      </div>
      <div class="fr-stat">
        <div class="fr-stat-num" data-count="<?= $complaints ?>">0</div>
        <div class="fr-stat-label">Complaints Handled</div>
      </div>
      <div class="fr-stat">
        <div class="fr-stat-num" data-count="<?= $reports ?>">0</div>
        <div class="fr-stat-label">Reports Filed</div>
      </div>
      <div class="fr-stat">
        <div class="fr-stat-num">24/7</div>
        <div class="fr-stat-label">Always Active</div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== HOW IT WORKS ===================== -->
<section class="fr-section fr-steps">
  <div class="fr-container">
    <div class="fr-section-head fr-reveal">
      <span class="fr-eyebrow">How it works</span>
      <h2>Help is three quick steps away</h2>
      <p>No forms, no phone trees. Just point, shoot, and send — the system handles the rest.</p>
    </div>
    <div class="fr-steps-grid">
      <div class="fr-step fr-reveal">
        <span class="fr-step-no">01</span>
        <div class="fr-step-ico"><i class="fa-solid fa-camera"></i></div>
        <h3>Capture the Fire</h3>
        <p>Snap a live photo or upload one straight from your phone — that's all you need to start.</p>
      </div>
      <div class="fr-step fr-reveal">
        <span class="fr-step-no">02</span>
        <div class="fr-step-ico"><i class="fa-solid fa-map-location-dot"></i></div>
        <h3>Auto-Locate &amp; Route</h3>
        <p>Your GPS coordinates instantly route the alert to the nearest fire station in range.</p>
      </div>
      <div class="fr-step fr-reveal">
        <span class="fr-step-no">03</span>
        <div class="fr-step-ico"><i class="fa-solid fa-gauge-high"></i></div>
        <h3>AI Severity &amp; Dispatch</h3>
        <p>AI estimates the severity and recommends how many engines to send — before crews arrive.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===================== FIRE CAUSES ===================== -->
<section class="fr-section">
  <div class="fr-container">
    <div class="fr-section-head fr-reveal">
      <span class="fr-eyebrow">Stay safe</span>
      <h2>Most common causes of house fires</h2>
      <p>Knowing the risks is the first step to preventing them. Hover a card to learn more.</p>
    </div>
    <div class="fr-causes-grid">
      <div class="fr-cause fr-reveal">
        <img src="assets/img/smoking.jpg" alt="Smoking" />
        <div class="fr-cause-body">
          <span class="fr-cause-tag">Risk 01</span>
          <h3>Smoking</h3>
          <p>People sometimes fall asleep while smoking, setting a bed, chair or couch alight — often fatally.</p>
        </div>
      </div>
      <div class="fr-cause fr-reveal">
        <img src="assets/img/appliance.jpg" alt="Appliances" />
        <div class="fr-cause-body">
          <span class="fr-cause-tag">Risk 02</span>
          <h3>Appliances</h3>
          <p>Any device that generates or builds heat — stoves, dryers, heaters, fans — is a potential fire hazard.</p>
        </div>
      </div>
      <div class="fr-cause fr-reveal">
        <img src="assets/img/candles.jpg" alt="Candles" />
        <div class="fr-cause-body">
          <span class="fr-cause-tag">Risk 03</span>
          <h3>Candles</h3>
          <p>A burning candle should never be left unattended — many are forgotten and burn out of control.</p>
        </div>
      </div>
      <div class="fr-cause fr-reveal">
        <img src="assets/img/electirc.jpg" alt="Electrical" />
        <div class="fr-cause-body">
          <span class="fr-cause-tag">Risk 04</span>
          <h3>Electrical</h3>
          <p>Poorly connected circuits, loose wires and improper grounding are dangers often hidden from homeowners.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== CTA ===================== -->
<section class="fr-section fr-cta" style="padding-top: 0;">
  <div class="fr-container">
    <div class="fr-cta-inner fr-reveal">
      <div>
        <h2>Every second counts in a fire.</h2>
        <p>Don't wait. Report an emergency now and the nearest station is alerted instantly.</p>
      </div>
      <a href="complaint.php" class="fr-btn fr-btn-light fr-btn-lg">
        <i class="fa-solid fa-fire"></i> Report an Emergency
      </a>
    </div>
  </div>
</section>

<?php include 'include/footer.php'; ?>
