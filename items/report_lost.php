

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Lost Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #fcefee, #f8f9fa);
      overflow-x: hidden;
      position: relative;
    }

    /* SVG Cloud Background Pattern */
   body::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: url(...) repeat;
  animation: floatClouds 30s linear infinite;
  pointer-events: none; /* 👉 fixes the issue */
  z-index: -1;           /* 👈 send it behind form */
}


    @keyframes floatClouds {
      0% { background-position: 0 0; }
      100% { background-position: 1000px 0; }
    }

    .form-wrapper {
      max-width: 600px;
      margin: 80px auto;
      padding: 35px 30px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 2;
    }

    .form-wrapper h3 {
      text-align: center;
      margin-bottom: 30px;
      color: #dc3545;
      font-weight: 600;
      position: relative;
    }

    .form-wrapper h3::after {
      content: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23dc3545" viewBox="0 0 24 24" width="24" height="24"><path d="M2 10l20-8-4 20-6-8-10-4z"/></svg>');
      position: absolute;
      right: -30px;
      top: 0;
      opacity: 0.5;
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
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .btn-danger {
      padding: 12px;
      font-weight: bold;
      border-radius: 12px;
      font-size: 1.05rem;
    }

    /* Airplane SVG Top Right */
    .form-wrapper::before {
      content: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23dc3545" viewBox="0 0 24 24" width="40" height="40"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>');
      position: absolute;
      top: -20px;
      right: -20px;
      opacity: 0.2;
      transform: rotate(15deg);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-wrapper">
    <h3>Report Lost Item</h3>
    <form action="report_item.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="status" value="Lost">

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
        <label for="report_date">Date Item Was Lost:</label>
        <input type="date" name="report_date" id="report_date" class="form-control" required>
      </div>

      <div class="mb-4">
        <label for="item_photo">Upload Item Photo:</label>
        <input type="file" name="item_photo" id="item_photo" class="form-control" accept="image/*">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-danger">Report Lost Item</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>


