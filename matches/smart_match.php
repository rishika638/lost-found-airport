
<?php
session_start();
session_destroy();  // <- Add this

include '../db.php';

// Simple admin password (change it!)
$admin_password = "admin123";

// Handle login attempt
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["admin_password"])) {
    if ($_POST["admin_password"] === $admin_password) {
        $_SESSION["is_admin"] = true;
    } else {
        $error = "❌ Incorrect admin password.";
    }
}

// If not logged in as admin, show login form
if (!isset($_SESSION["is_admin"])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- <style>
          .form-label{
            color: red;
            background: black
          }
        </style> -->

      
    </head>
    <body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">🔐 Admin Login Required</h3>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="post">
            <div class="mb-3">
                <label for="admin_password" class="form-label">Enter Admin Password</label>
                <input type="password" name="admin_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    </body>
    </html>
    <?php
    exit(); // Stop here if not logged in
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Smart Match Lost and Found</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Smart Match Lost and Found Items</h2>

  <form action="match_action.php" method="post">

    <div class="mb-3">
      <label class="form-label">Select Lost Item:</label>
      <select name="lost_item_id" class="form-select" required>
        <option value="">-- Select Lost Item --</option>
        <?php
        $lost = $conn->query("SELECT item_id, description FROM reported_items WHERE status='Lost'");
        while ($row = $lost->fetch_assoc()) {
          echo "<option value='{$row['item_id']}'>[ID: {$row['item_id']}] - " . substr($row['description'], 0, 50) . "</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Select Found Item:</label>
      <select name="found_item_id" class="form-select" required>
        <option value="">-- Select Found Item --</option>
        <?php
        $found = $conn->query("SELECT item_id, description FROM reported_items WHERE status='Found'");
        while ($row = $found->fetch_assoc()) {
          echo "<option value='{$row['item_id']}'>[ID: {$row['item_id']}] - " . substr($row['description'], 0, 50) . "</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Match Status:</label>
      <select name="match_status" class="form-select" required>
        <option value="Pending">Pending</option>
        <option value="Confirmed">Confirmed</option>
        <option value="Rejected">Rejected</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Create Match</button>
  </form>
</div>
</body>
</html>