<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Reported Items</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 40px;
    }
    table img {
      max-width: 100px;
      height: auto;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">All Reported Items</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle bg-white">
      <thead class="table-dark text-center">
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

          echo "<tr>
                  <td>{$row['item_id']}</td>
                  <td>{$row['user_id']}</td>
                  <td>{$row['item_type']}</td>
                  <td>{$row['status']}</td>
                  <td>{$row['description']}</td>
                  <td>{$row['report_date']}</td>
                  <td>{$row['location_found']}</td>
                  <td class='text-center'>$photo</td>
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

