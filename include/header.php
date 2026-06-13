<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/truck.png" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/truck.png" />
    <title>Fire Rescue Response System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!-- Functional libraries (kept for complaint/posts pages) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/dist/style.css" />

    <!-- Modern theme (must load last so it wins) -->
    <link rel="stylesheet" href="assets/dist/modern.css?v=4" />
  </head>

  <body class="fr-page">
    <header class="fr-header" id="frHeader">
      <div class="fr-container">
        <nav class="fr-nav">
          <a href="index.php" class="fr-brand">
            <img src="assets/img/station.png" alt="Fire Rescue" />
            <span>Fire Rescue<small>Response System</small></span>
          </a>

          <div class="fr-nav-links">
            <a href="index.php">Home</a>
            <a href="complaint.php">Urgent Complaint</a>
            <a href="posts.php">Posts</a>
          </div>

          <div class="fr-nav-actions">
            <a href="complaint.php" class="fr-btn fr-btn-fire">
              <i class="fa-solid fa-fire"></i> Report Emergency
            </a>
            <a href="login.php" class="fr-btn fr-btn-outline">Login</a>
          </div>

          <button class="fr-burger" id="frBurger" aria-label="Menu">
            <span></span><span></span><span></span>
          </button>
        </nav>
      </div>

      <div class="fr-mobile-menu fr-container" id="frMobileMenu">
        <a href="index.php">Home</a>
        <a href="complaint.php">Urgent Complaint</a>
        <a href="posts.php">Posts</a>
        <a href="login.php">Login</a>
        <a href="complaint.php" class="fr-btn fr-btn-fire">
          <i class="fa-solid fa-fire"></i> Report Emergency
        </a>
      </div>
    </header>
