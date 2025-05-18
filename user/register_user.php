<!-- <form action="register_action.php" method="post">
  <label>Name:</label><input type="text" name="name"><br>
  <label>Email:</label><input type="email" name="email"><br>
  <label>Phone:</label><input type="text" name="phone"><br>
  <label>User Type:</label>
<select name="user_type">
  <option value="Passenger">Passenger</option>
  <option value="Staff">Staff</option>
</select><br>

<div id="staff-code" style="display:none;">
  <label>Staff Verification Code:</label>
  <input type="text" name="staff_code"><br>
</div>

<input type="submit" value="Register">

<script>
  document.querySelector("select[name='user_type']").addEventListener("change", function () {
    const isStaff = this.value === "Staff";
    document.getElementById("staff-code").style.display = isStaff ? "block" : "none";
  });
</script> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #e9ecef;
    }
    .form-container {
      max-width: 500px;
      margin: 60px auto;
      padding: 40px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-container">
    <h2 class="text-center mb-4">User Registration</h2>
    <form action="register_action.php" method="post">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" pattern="\d{10}" maxlength="10" title="Enter a 10-digit phone number" required>

      </div>

      <div class="mb-3">
        <label class="form-label">User Type</label>
        <select name="user_type" id="user_type" class="form-select" required>
          <option value="Passenger">Passenger</option>
          <option value="Staff">Staff</option>
        </select>
      </div>

      <div class="mb-3" id="staff-code" style="display: none;">
        <label class="form-label">Staff Verification Code</label>
        <input type="text" name="staff_code" class="form-control">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
  </div>
</div>

<script>
  document.getElementById("user_type").addEventListener("change", function () {
    document.getElementById("staff-code").style.display = this.value === "Staff" ? "block" : "none";
  });
</script>

</body>
</html>



