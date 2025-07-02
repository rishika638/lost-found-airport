

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Found Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #eafbf0, #f8f9fa);
      overflow-x: hidden;
      position: relative;
      z-index: 0;
    }

    /* Radar SVG Pattern BG */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" fill="%2382d89b" opacity="0.08"><circle cx="50" cy="50" r="25"/><circle cx="20" cy="20" r="10"/><circle cx="80" cy="30" r="12"/><circle cx="60" cy="80" r="8"/></svg>') repeat;
      animation: floatRadar 25s linear infinite;
      pointer-events: none;
      z-index: -1;
    }

    @keyframes floatRadar {
      0% { background-position: 0 0; }
      100% { background-position: 600px 0; }
    }

    .form-wrapper {
      max-width: 600px;
      width: 90%;
      margin: 60px auto;
      padding: 35px 30px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 1;
    }

    .form-wrapper h3 {
      text-align: center;
      margin-bottom: 30px;
      color: #198754;
      font-weight: 600;
      position: relative;
    }

    .form-wrapper h3::after {
      content: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23198754" viewBox="0 0 24 24" width="24" height="24"><path d="M2 10l20 8-4-20-6 8-10 4z"/></svg>');
      position: absolute;
      right: -30px;
      top: 0;
      opacity: 0.4;
    }

    label {
      font-weight: 500;
      margin-top: 10px;
    }

    .form-control,
    .form-select {
      border-radius: 12px;
      background-color: #fff;
      border: 1px solid #ccc;
      transition: all 0.2s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #198754;
      box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
    }

    .btn-success {
      padding: 12px;
      font-weight: bold;
      border-radius: 12px;
      font-size: 1.05rem;
    }

    .form-wrapper::before {
      content: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23198754" viewBox="0 0 24 24" width="40" height="40"><path d="M2.01 3L23 12 2.01 21 2 14l15-2L2 10z"/></svg>');
      position: absolute;
      top: -20px;
      right: -20px;
      opacity: 0.25;
      transform: rotate(-15deg);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-wrapper">
    <h3>Report Found Item</h3>

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


