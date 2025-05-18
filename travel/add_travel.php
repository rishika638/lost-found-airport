<?php
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Travel Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Add Travel Information</h2>

  <form action="add_travel_action.php" method="post">

    <?php if ($user_id): ?>
      <!-- Hidden input if redirected -->
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
      <p><strong>User ID:</strong> <?php echo $user_id; ?></p>
    <?php else: ?>
      <!-- Fallback: manual entry -->
      <div class="mb-3">
        <label class="form-label">User ID:</label>
        <input type="number" name="user_id" class="form-control" required>
      </div>
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Flight No:</label>
      <input type="text" name="flight_no" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Airport Code:</label>
      <input type="text" name="airport_code" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Date & Time:</label>
      <input type="datetime-local" name="dept_arrival_datetime" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Seat No:</label>
      <input type="text" name="seat_no" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Booking Ref:</label>
      <input type="text" name="booking_ref" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Booking Status:</label>
      <input type="text" name="booking_status" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit Travel Info</button>
  </form>
</div>
</body>
</html>