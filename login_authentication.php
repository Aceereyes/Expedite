
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fe;
    }
    .auth-box {
      max-width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .expedite-logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .expedite-logo img {
      max-width: 200px;
    }
  </style>
  <title>Authentication</title>

</head>
<body>
  <div class="auth-box">
    <div class="expedite-logo">
      <img src="path_to_expedite_logo.png" alt="Expedite Logo">
    </div>
    <form action="login_authentication_answer.php" method="POST">
      <h2 class="text-center mb-4">2-Step Verification</h2>
      <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <select id="country" class="form-select philippines-only">
          <option value="PH">Philippines</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Your Email Address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email address">
      </div>
      <div class="text-secondary mb-4">
        Security is critical in Tabler. To help keep your account safe, we'll email you a verification code when you sign in on a new device.
      </div>

      <!-- SEND CODE -->
      <form action="generate_otp.php" method="POST">
        <!-- form fields -->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Send Code</button>
        </div>
      </form>
      <!-- SEND CODE -->

    </form>
  </div>
</body>
</html>