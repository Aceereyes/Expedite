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
  </style>
  <title>Enter Authentication Code</title>
</head>
<body>
  <div class="auth-box">
    <form id="authForm">
      <h2 class="text-center mb-4">Authenticate Your Account</h2>
      <p class="my-4 text-center">Please confirm your account by entering the authorization code sent to <strong>[user's email address]</strong>.</p>
      <div class="my-5">
        <div class="row g-4">
          <div class="col">
            <input type="text" class="form-control form-control-lg text-center py-3" maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="" id="code1">
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-lg text-center py-3" maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="" id="code2">
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-lg text-center py-3" maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="" id="code3">
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-lg text-center py-3" maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="" id="code4">
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-lg text-center py-3" maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="" id="code5">
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-lg text-center py-3" maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="" id="code6">
          </div>
        </div>
      </div>
      <div class="my-4">
            <label for="submitCodeBtn" class="visually-hidden">Submit code button</label>
      <button type="submit" class="btn btn-primary btn-lg w-100" id="submitCodeBtn">Submit Code</button>
    </form>
  </div>
</body>
</html>