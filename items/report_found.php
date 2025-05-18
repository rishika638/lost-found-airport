<!-- <form action="report_item.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="status" value="Found">

  <label>User:</label>
  <select name="user_id" required>
    <?php
    include '../db.php';
    $result = $conn->query("SELECT user_id, name FROM users");
    while ($row = $result->fetch_assoc()) {
      echo "<option value='{$row['user_id']}'>{$row['user_id']} - {$row['name']}</option>";
    }
    ?>
  </select><br>

  <label>Item Type:</label>
  <input type="text" name="item_type" required><br>

  <label>Description:</label>
  <textarea name="description" required></textarea><br>

  <label>Location Found:</label>
  <input type="text" name="location_found" required><br>

  <label>Date Item Was Found:</label>
  <input type="date" name="report_date" required><br>

  <label>Upload Item Photo:</label>
  <input type="file" name="item_photo" accept="image/*"><br>

  <input type="submit" value="Report Found Item">
</form>
 -->


 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Found Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-wrapper {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    label {
      font-weight: 500;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-wrapper">
    <h3 class="mb-4 text-center">Report Found Item</h3>

    <form action="report_item.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="status" value="Found">

      <div class="mb-3">
        <label for="user_id">User:</label>
        <select name="user_id" id="user_id" class="form-select" required>
          <?php
          include '../db.php';
          $result = $conn->query("SELECT user_id, name FROM users");
          while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['user_id']}'>{$row['user_id']} - {$row['name']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="item_type">Item Type:</label>
        <input type="text" name="item_type" id="item_type" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label for="location_found">Location Found:</label>
        <input type="text" name="location_found" id="location_found" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="report_date">Date Item Was Found:</label>
        <input type="date" name="report_date" id="report_date" class="form-control" required>
      </div>

      <div class="mb-4">
        <label for="item_photo">Upload Item Photo:</label>
        <input type="file" name="item_photo" id="item_photo" class="form-control" accept="image/*">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success">Report Found Item</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
