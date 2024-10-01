<?php
    include('includes/admin_header.php');
?>

<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Users
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
      <!-- CARD FOR VIDEO -->
      <div class="row">
         <div class="col-md-6">
            <div class="card" style="border-radius: 15px; background-color: #E8ECEE ; margin-top: 10px; padding-bottom: 80px;">
                <div class="card-body" style="text-align: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/8955/8955051.png" class="card-img-top" alt="Image description" style="max-width: 40%; height: auto; padding-top: 80px;">
                    <h5 class="card-title" style="padding-top: 20px; padding-bottom: 20px;">
                        Freelancers
                    </h5>
                    <a href="admin_users_freelancers.php" class="btn btn-info btn-pill w-45">
                          Proceed
                    </a>
                </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card" style="border-radius: 15px; background-color: #ffffff; margin-top: 10px; padding-bottom: 80px;">
                <div class="card-body" style="text-align: center;">
                    <img src="https://cdn2.iconfinder.com/data/icons/business-round-icons/500/handshake-1024.png" class="card-img-top" alt="Image description" style="max-width: 40%; height: auto; padding-top: 80px;">
                    <h5 class="card-title" style="padding-top: 20px; padding-bottom: 20px;">
                        Partners
                    </h5>
                    <a href="admin_users_partners.php" class="btn btn-info btn-pill w-45">
                          Proceed
                    </a>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php
    include('includes/admin_footer.php');
?>