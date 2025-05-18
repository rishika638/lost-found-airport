<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Matched Items</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">Matched Items</h2>

  <?php
  $conn = mysqli_connect("localhost", "root", "", "lost_found");

  if (!$conn) {
      die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
  }

  $sql = "SELECT 
              m.match_id,
              lost.description AS lost_description,
              lost.report_date AS date_lost,
              found.description AS found_description,
              found.report_date AS date_found
          FROM matches m
          JOIN reported_items lost ON m.lost_item_id = lost.item_id AND lost.status = 'Lost'
          JOIN reported_items found ON m.found_item_id = found.item_id AND found.status = 'Found'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      echo "<div class='table-responsive'>
              <table class='table table-bordered table-hover bg-white'>
                <thead class='table-dark text-center'>
                  <tr>
                    <th>Match ID</th>
                    <th>Lost Item Description</th>
                    <th>Date Lost</th>
                    <th>Found Item Description</th>
                    <th>Date Found</th>
                  </tr>
                </thead>
                <tbody>";

      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['match_id']}</td>
                  <td>{$row['lost_description']}</td>
                  <td>{$row['date_lost']}</td>
                  <td>{$row['found_description']}</td>
                  <td>{$row['date_found']}</td>
                </tr>";
      }

      echo "</tbody>
            </table>
          </div>";
  } else {
      echo "<div class='alert alert-info text-center'>No matched items found.</div>";
  }

  mysqli_close($conn);
  ?>
</div>

</body>
</html>
