<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Matched Items</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f4fafd, #e9f5ff);
      font-family: 'Poppins', sans-serif;
    }

    .container {
      margin-top: 50px;
      padding: 30px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0,0,0,0.08);
    }

    h2 {
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
    }

    .match-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #f1f5f9;
      padding: 20px;
      margin-bottom: 20px;
      border-left: 6px solid #198754;
      border-radius: 12px;
      transition: 0.3s ease;
    }

    .match-row:hover {
      background-color: #e8f5e9;
    }

    .item-box {
      flex: 1;
      padding: 0 20px;
      text-align: center;
    }

    .item-box h6 {
      font-weight: 700;
      color: #333;
      margin-bottom: 6px;
    }

    .item-box p {
      margin: 0;
      color: #555;
    }

    .vs-divider {
      font-size: 24px;
      font-weight: bold;
      color: #6c757d;
    }

    .date-badge {
      font-size: 0.8rem;
      background-color: #0d6efd;
      color: #fff;
      padding: 4px 10px;
      border-radius: 30px;
      margin-top: 5px;
      display: inline-block;
    }

    .match-id {
      font-size: 0.85rem;
      font-weight: 600;
      color: #666;
      margin-bottom: 10px;
    }

    .no-match {
      text-align: center;
      padding: 20px;
      font-weight: 500;
      color: #888;
      background-color: #f8f9fa;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Matched Items</h2>

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
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='match-row'>
                  <div class='item-box'>
                    <div class='match-id'>Match ID: {$row['match_id']}</div>
                    <h6>Lost Item</h6>
                    <p>{$row['lost_description']}</p>
                    <span class='date-badge'>Lost on: {$row['date_lost']}</span>
                  </div>
                  <div class='vs-divider'>🔁</div>
                  <div class='item-box'>
                    <h6>Found Item</h6>
                    <p>{$row['found_description']}</p>
                    <span class='date-badge bg-success'>Found on: {$row['date_found']}</span>
                  </div>
                </div>";
      }
  } else {
      echo "<div class='no-match'>No matched items found.</div>";
  }

  mysqli_close($conn);
  ?>
</div>

</body>
</html>
