<?php $page_title = 'User Management'; include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php
/**
 * User Management
 * ----------------
 * One place for the admin to manage login accounts:
 *   - Station accounts   (station table:     username / password)
 *   - Rescue Team accounts (rescue_team table: username / password)
 *
 * Supports Create, Edit (name / username / password) and Delete for both.
 */

$msg = '';
$status = '';

/** Trim + escape a POST/GET value for safe SQL use. */
function clean($conn, $value)
{
    return mysqli_real_escape_string($conn, trim($value ?? ''));
}

/** True if a username is already taken in either accounts table (optionally excluding one row). */
function username_taken($conn, $username, $exceptType = '', $exceptId = 0)
{
    $u = clean($conn, $username);

    $stationExcl = ($exceptType === 'station') ? " AND station_id <> " . (int) $exceptId : "";
    $teamExcl    = ($exceptType === 'team')    ? " AND team_id <> "    . (int) $exceptId : "";

    $s = mysqli_query($conn, "SELECT 1 FROM station     WHERE station_username = '$u'$stationExcl");
    $t = mysqli_query($conn, "SELECT 1 FROM rescue_team WHERE team_username    = '$u'$teamExcl");

    return (mysqli_num_rows($s) > 0) || (mysqli_num_rows($t) > 0);
}

/* ------------------------------------------------------------------ CREATE */
if (isset($_POST['create_user'])) {
    $type     = $_POST['user_type'] ?? '';
    $name     = clean($conn, $_POST['name'] ?? '');
    $username = clean($conn, $_POST['username'] ?? '');
    $password = clean($conn, $_POST['password'] ?? '');

    if ($name === '' || $username === '' || $password === '') {
        $msg = 'Please fill in name, username and password.';
        $status = 'warning';
    } elseif (username_taken($conn, $_POST['username'])) {
        $msg = 'That username is already in use. Choose another one.';
        $status = 'warning';
    } elseif ($type === 'station') {
        $contact = clean($conn, $_POST['contact'] ?? '');
        $city    = clean($conn, $_POST['city'] ?? '');
        $ok = mysqli_query($conn, "INSERT INTO station
                (station_name, station_contact, station_username, station_password, station_city)
                VALUES ('$name', '$contact', '$username', '$password', '$city')");
        $msg = $ok ? 'Station account created.' : 'Error creating station account.';
        $status = $ok ? 'success' : 'danger';
    } elseif ($type === 'team') {
        $station_id = (int) ($_POST['station_id'] ?? 0);
        if ($station_id <= 0) {
            $msg = 'Please choose the station this rescue team belongs to.';
            $status = 'warning';
        } else {
            $ok = mysqli_query($conn, "INSERT INTO rescue_team
                    (station_id, team_name, team_username, team_password)
                    VALUES ('$station_id', '$name', '$username', '$password')");
            $msg = $ok ? 'Rescue team account created.' : 'Error creating rescue team account.';
            $status = $ok ? 'success' : 'danger';
        }
    }
}

/* ------------------------------------------------------------------ UPDATE */
if (isset($_POST['update_user'])) {
    $type     = $_POST['user_type'] ?? '';
    $id       = (int) ($_POST['id'] ?? 0);
    $name     = clean($conn, $_POST['name'] ?? '');
    $username = clean($conn, $_POST['username'] ?? '');
    $password = clean($conn, $_POST['password'] ?? '');

    if ($id <= 0 || $name === '' || $username === '') {
        $msg = 'Name and username are required.';
        $status = 'warning';
    } elseif (username_taken($conn, $_POST['username'], $type, $id)) {
        $msg = 'That username is already in use by another account.';
        $status = 'warning';
    } elseif ($type === 'station') {
        $contact = clean($conn, $_POST['contact'] ?? '');
        $city    = clean($conn, $_POST['city'] ?? '');
        // Leave the password unchanged when the field is left blank.
        $pwSet = ($password !== '') ? ", station_password = '$password'" : '';
        $ok = mysqli_query($conn, "UPDATE station SET
                station_name = '$name',
                station_username = '$username',
                station_contact = '$contact',
                station_city = '$city'$pwSet
                WHERE station_id = $id");
        $msg = $ok ? 'Station account updated.' : 'Error updating station account.';
        $status = $ok ? 'success' : 'danger';
    } elseif ($type === 'team') {
        $station_id = (int) ($_POST['station_id'] ?? 0);
        $pwSet = ($password !== '') ? ", team_password = '$password'" : '';
        $ok = mysqli_query($conn, "UPDATE rescue_team SET
                team_name = '$name',
                team_username = '$username',
                station_id = '$station_id'$pwSet
                WHERE team_id = $id");
        $msg = $ok ? 'Rescue team account updated.' : 'Error updating rescue team account.';
        $status = $ok ? 'success' : 'danger';
    }
}

/* ------------------------------------------------------------------ DELETE */
if (isset($_GET['delete']) && isset($_GET['type'])) {
    $id = (int) $_GET['delete'];
    if ($_GET['type'] === 'station') {
        mysqli_query($conn, "DELETE FROM station WHERE station_id = $id");
        $msg = 'Station account deleted.';
    } elseif ($_GET['type'] === 'team') {
        mysqli_query($conn, "DELETE FROM rescue_team WHERE team_id = $id");
        $msg = 'Rescue team account deleted.';
    }
    $status = 'success';
}

// Stations list (also used to populate the "belongs to" dropdown for teams).
$stations = [];
$sres = mysqli_query($conn, "SELECT * FROM station ORDER BY station_name");
while ($row = mysqli_fetch_assoc($sres)) {
    $stations[$row['station_id']] = $row;
}

// Rescue teams list.
$teams = [];
$tres = mysqli_query($conn, "SELECT * FROM rescue_team ORDER BY team_name");
while ($row = mysqli_fetch_assoc($tres)) {
    $teams[] = $row;
}

$cities = ['faisalabad', 'toba_tek_singh', 'gojra', 'lahore', 'Jhang', 'multan'];
?>

<div class="container-fluid">

    <?php if ($msg): ?>
    <div class="alert alert-<?= $status ?> alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?= htmlspecialchars($msg) ?>
    </div>
    <?php endif; ?>

    <!-- ============================ STATIONS ============================ -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-building mr-2"></i>Station Accounts</h6>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addStationModal">
                <i class="fas fa-plus mr-1"></i> Add Station
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Station Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Contact</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!$stations): ?>
                        <tr><td colspan="7" class="text-center text-muted">No station accounts yet.</td></tr>
                    <?php else: foreach ($stations as $s): ?>
                        <tr>
                            <td><?= (int) $s['station_id'] ?></td>
                            <td><?= htmlspecialchars($s['station_name']) ?></td>
                            <td><?= htmlspecialchars($s['station_username']) ?></td>
                            <td><code><?= htmlspecialchars($s['station_password']) ?></code></td>
                            <td><?= htmlspecialchars($s['station_contact']) ?></td>
                            <td><?= htmlspecialchars($s['station_city']) ?></td>
                            <td class="text-nowrap">
                                <button class="btn btn-sm text-success edit-station-btn"
                                    data-id="<?= (int) $s['station_id'] ?>"
                                    data-name="<?= htmlspecialchars($s['station_name'], ENT_QUOTES) ?>"
                                    data-username="<?= htmlspecialchars($s['station_username'], ENT_QUOTES) ?>"
                                    data-contact="<?= htmlspecialchars($s['station_contact'], ENT_QUOTES) ?>"
                                    data-city="<?= htmlspecialchars($s['station_city'], ENT_QUOTES) ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>|
                                <a href="manage_users.php?delete=<?= (int) $s['station_id'] ?>&type=station"
                                   class="btn btn-sm text-danger"
                                   onclick="return confirm('Delete this station account? This cannot be undone.');">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================== RESCUE TEAMS ========================== -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-truck-moving mr-2"></i>Rescue Team Accounts</h6>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addTeamModal">
                <i class="fas fa-plus mr-1"></i> Add Rescue Team
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Team Name</th>
                            <th>Station</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!$teams): ?>
                        <tr><td colspan="6" class="text-center text-muted">No rescue team accounts yet.</td></tr>
                    <?php else: foreach ($teams as $t):
                        $st = $stations[$t['station_id']] ?? null; ?>
                        <tr>
                            <td><?= (int) $t['team_id'] ?></td>
                            <td><?= htmlspecialchars($t['team_name']) ?></td>
                            <td><?= $st ? htmlspecialchars($st['station_name']) : '<span class="text-muted">—</span>' ?></td>
                            <td><?= htmlspecialchars($t['team_username']) ?></td>
                            <td><code><?= htmlspecialchars($t['team_password']) ?></code></td>
                            <td class="text-nowrap">
                                <button class="btn btn-sm text-success edit-team-btn"
                                    data-id="<?= (int) $t['team_id'] ?>"
                                    data-name="<?= htmlspecialchars($t['team_name'], ENT_QUOTES) ?>"
                                    data-username="<?= htmlspecialchars($t['team_username'], ENT_QUOTES) ?>"
                                    data-station="<?= (int) $t['station_id'] ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>|
                                <a href="manage_users.php?delete=<?= (int) $t['team_id'] ?>&type=team"
                                   class="btn btn-sm text-danger"
                                   onclick="return confirm('Delete this rescue team account? This cannot be undone.');">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ======================= MODAL: Add Station ======================= -->
<div class="modal fade" id="addStationModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Station Account</h5>
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_type" value="station">
        <div class="form-group">
          <label>Station Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" name="contact" class="form-control">
        </div>
        <div class="form-group">
          <label>City</label>
          <select name="city" class="form-control">
            <?php foreach ($cities as $c): ?>
            <option value="<?= $c ?>"><?= ucfirst(str_replace('_', ' ', $c)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="create_user" class="btn btn-danger">Create Station</button>
      </div>
    </form>
  </div>
</div>

<!-- ======================= MODAL: Edit Station ====================== -->
<div class="modal fade" id="editStationModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Station Account</h5>
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_type" value="station">
        <input type="hidden" name="id" id="es_id">
        <div class="form-group">
          <label>Station Name</label>
          <input type="text" name="name" id="es_name" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" name="contact" id="es_contact" class="form-control">
        </div>
        <div class="form-group">
          <label>City</label>
          <select name="city" id="es_city" class="form-control">
            <?php foreach ($cities as $c): ?>
            <option value="<?= $c ?>"><?= ucfirst(str_replace('_', ' ', $c)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" id="es_username" class="form-control" required>
        </div>
        <div class="form-group">
          <label>New Password <small class="text-muted">(leave blank to keep current)</small></label>
          <input type="text" name="password" class="form-control" placeholder="••••••">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_user" class="btn btn-danger">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ====================== MODAL: Add Rescue Team ==================== -->
<div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Rescue Team Account</h5>
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_type" value="team">
        <div class="form-group">
          <label>Team Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Belongs to Station</label>
          <select name="station_id" class="form-control" required>
            <option value="">Select station…</option>
            <?php foreach ($stations as $s): ?>
            <option value="<?= (int) $s['station_id'] ?>"><?= htmlspecialchars($s['station_name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="create_user" class="btn btn-danger">Create Rescue Team</button>
      </div>
    </form>
  </div>
</div>

<!-- ===================== MODAL: Edit Rescue Team =================== -->
<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Rescue Team Account</h5>
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_type" value="team">
        <input type="hidden" name="id" id="et_id">
        <div class="form-group">
          <label>Team Name</label>
          <input type="text" name="name" id="et_name" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Belongs to Station</label>
          <select name="station_id" id="et_station" class="form-control" required>
            <?php foreach ($stations as $s): ?>
            <option value="<?= (int) $s['station_id'] ?>"><?= htmlspecialchars($s['station_name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" id="et_username" class="form-control" required>
        </div>
        <div class="form-group">
          <label>New Password <small class="text-muted">(leave blank to keep current)</small></label>
          <input type="text" name="password" class="form-control" placeholder="••••••">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_user" class="btn btn-danger">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script>
// Pre-fill the Edit Station modal from the clicked row's data-* attributes.
document.querySelectorAll('.edit-station-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    document.getElementById('es_id').value       = btn.dataset.id;
    document.getElementById('es_name').value      = btn.dataset.name;
    document.getElementById('es_username').value  = btn.dataset.username;
    document.getElementById('es_contact').value   = btn.dataset.contact;
    document.getElementById('es_city').value      = btn.dataset.city;
    $('#editStationModal').modal('show');
  });
});

// Pre-fill the Edit Rescue Team modal.
document.querySelectorAll('.edit-team-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    document.getElementById('et_id').value        = btn.dataset.id;
    document.getElementById('et_name').value      = btn.dataset.name;
    document.getElementById('et_username').value  = btn.dataset.username;
    document.getElementById('et_station').value   = btn.dataset.station;
    $('#editTeamModal').modal('show');
  });
});
</script>

<?php include 'include/footer.php'; ?>
