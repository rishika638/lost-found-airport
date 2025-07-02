<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Reported Items</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f3f8fa, #e8f4fc);
      font-family: 'Poppins', sans-serif;
    }

    .container {
      margin-top: 50px;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
    }

    h2 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 30px;
      color: #212529;
    }

    table {
      border-radius: 10px;
      overflow: hidden;
    }

    thead th {
      background-color: #212529;
      color: #fff;
      text-align: center;
    }

    td, th {
      vertical-align: middle;
      text-align: center;
    }

    tbody tr:hover {
      background-color: #f1fdf6;
      transition: 0.3s ease-in-out;
    }

    table img {
      max-width: 80px;
      height: auto;
      border-radius: 10px;
      border: 2px solid #dee2e6;
    }

    .badge-status {
      padding: 6px 12px;
      border-radius: 30px;
      font-size: 0.85rem;
      font-weight: 600;
      color: #fff;
    }

    .badge-lost {
      background-color: #dc3545;
    }

    .badge-found {
      background-color: #28a745;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>All Reported Items</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle bg-white">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Type</th>
          <th>Status</th>
          <th>Description</th>
          <th>Date</th>
          <th>Location Found</th>
          <th>Photo</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'db.php';

        $sql = "SELECT * FROM reported_items";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
          $photo = $row['item_photo']
            ? "<img src='uploads/{$row['item_photo']}' alt='Item Photo'>"
            : "<span class='text-muted'>No photo</span>";

          $statusBadge = $row['status'] === 'Lost'
            ? "<span class='badge-status badge-lost'>Lost</span>"
            : "<span class='badge-status badge-found'>Found</span>";

          echo "<tr>
                  <td>{$row['item_id']}</td>
                  <td>{$row['user_id']}</td>
                  <td>{$row['item_type']}</td>
                  <td>$statusBadge</td>
                  <td>{$row['description']}</td>
                  <td>{$row['report_date']}</td>
                  <td>{$row['location_found']}</td>
                  <td>$photo</td>
                </tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>

