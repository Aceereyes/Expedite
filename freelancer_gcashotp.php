<?php include('includes/freelancer_header.php'); ?>

<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url("freelancer_gcashwithdraw.php"); ?>" class="btn"><i class="ti ti-arrow-left"></i> Back</a>
                    </span>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
  <div style="max-width: 500px; width: 100%; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
    <div style="background-color: #007bff; color: #fff; padding: 10px; border-top-left-radius: 5px; border-top-right-radius: 5px;">
      <h2 style="text-align: center; margin: 0;">Authentication</h2>
    </div>
    <div style="padding: 20px;">

       <!-- CARD WHITE -->
       
      <div class="card" style="margin-top: 20px;">
        <div class="card-body">
            <div style="text-align: center; position: relative; margin-top: -50px; z-index: 1; ">
                <img src="https://i.ibb.co/wQ7j7Tm/Expedite-logo.png" alt="Logo" style="width: 100px; height: 100px; object-fit: cover; box-shadow: 0 0 0 1px #E6E7E9; border-radius: 50%; background-color:#ffffff">
            </div>


          <div class="auth-box">
            <form id="authForm">
            <h2 class="text-center mb-4">Authenticate Your Account</h2>
            <p class="my-4 text-center">Please confirm your account by entering the authorization code sent to <strong>aaronchristian.adr@gmail.com</strong>.</p>
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

        </div>
      </div>
      <!-- CARD WHITE END -->

      <div class="form-group" style="text-align: center; padding-top: 20px;">
        <p>By proceeding, you agree to share your personal information and accept the <span style="color: blue;">Terms and Conditions</span>.</p>
      </div>

      <div class="form-group" style="text-align: center; padding-top: 20px">
            <a href="<?= base_url("freelancer_funds.php"); ?>">
                <button class="btn btn-primary" id="withdrawBtn" style="width: 400px; border-radius: 20px;">Proceed</button>
            </a>
      </div>
    </div>
    </div>
  </div>
</div>

    </div>
</div>


<?php include('includes/freelancer_footer.php'); ?>