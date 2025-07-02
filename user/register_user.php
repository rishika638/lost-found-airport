

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Airport Background + Soft Overlay */
    body {
      background:
        linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 30, 60, 0.6)),
        url("./terminal-blur.avif") no-repeat center center fixed;
      background-size: cover;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      max-width: 500px;
      width: 90%;
      padding: 40px 30px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(25px);
      -webkit-backdrop-filter: blur(25px);
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #ffffff;
    }

    label {
      font-weight: 500;
      color: #f1f1f1;
    }

    .form-control,
    .form-select {
      background-color: rgba(255, 255, 255, 0.8);
      border: none;
      color: #000;
      border-radius: 12px;
      font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.3);
      background-color: #fff;
    }

    .btn-primary {
      background: linear-gradient(90deg, #007bff, #3399ff);
      border: none;
      padding: 12px;
      font-weight: bold;
      border-radius: 10px;
      transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #0056b3, #1a75ff);
    }

    #staff-code {
      display: none;
    }

    /* Optional: Add tiny airplane watermark/icon */
    .form-container::after {
      content: url("tiny-plane.svg");
      position: absolute;
      top: 15px;
      right: 20px;
      opacity: 0.2;
      width: 30px;
    }
  </style>
</head>
<body>

  <div class="form-container position-relative">
    <h2>User Registration</h2>
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

      <div class="mb-3" id="staff-code">
        <label class="form-label">Staff Verification Code</label>
        <input type="text" name="staff_code" class="form-control">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
  </div>

  <script>
    document.getElementById("user_type").addEventListener("change", function () {
      document.getElementById("staff-code").style.display = this.value === "Staff" ? "block" : "none";
    });
  </script>

</body>
</html>



