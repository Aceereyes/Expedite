<?php
    include('includes/partner_header.php');
?>

<div class="page-body">
   <div class="container">
      <div class="row g-2 align-items-center mb-3">
         <div class="col">
            <h2 class="page-title">
               Wallet
            </h2>
         </div>
      </div>
      <div class="row">
         <!-- TOTAL FUNDS -->
         <div class="col-md-6">
            <div class="card" style="margin-top: 10px; border-radius: 15px; background-image: url('https://www.wallpapertip.com/wmimgs/27-276737_blue-powerpoint-backgrounds-wallpaper-src-top-power-blue.jpg'); background-size: cover; background-position: center; height: 280px;">
               <div class="card-body">
                  <p class="card-text" style="font-size: 24px; font-weight: bold; color: white; text-align: left;">
                     Partner
                  </p>
                  <p class="card-title" style="font-size: 13px; color: white; text-align: left;">
                     Sophia Cruz
                  </p>
                  <div class="d-flex justify-content-between align-items-center text">
                     <p class="card-title" style="font-size: 13px; color: white; text-align: right;margin-top: 80px;">
                        Total Transactions:
                     </p>
                     <p class="card-text" style="font-size: 24px; font-weight: bold; color: white; text-align: right;margin-top: 80px;">
                        1
                        <!-- <?php echo number_format($totalTransactions, 2); ?></p> -->
                     </p>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                     <p class="card-title" style="font-size: 15px; color: white; text-align: right;">
                        Current Balance:
                     </p>
                     <p class="card-text" style="font-size: 24px; color:white; font-weight: bold; text-align: right;">
                        ₱ 25,000.00
                        <!-- <?php echo number_format($totalFunds, 2); ?></p> -->
                     </p>
                  </div>
                  <?php // PHP logic to fetch and display the current funds of the freelancers
                  // $totalFunds=getTotalFunds(); // Replace with your logic to calculate
                  // echo '$' . number_format($totalFunds, 2); ?>
               </div>
            </div>
         </div>
         <!-- TRANSACTION HISTORY -->
         <div class="col-md-6">
            <div class="card" style="border-radius: 15px; background-color: #E8E8E8; margin-top: 10px; height: 280px;">
               <div class="card-body">
                  <h5 class="card-title">
                     Recent Transaction History
                  </h5>
                  <table class="table table-vcenter">
                     <tbody>
                           <tr>
                              <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url('https://i.ibb.co/wQ7j7Tm/Expedite-logo.png')">
                                 </span>
                              </td>
                              <td class="td-truncate">
                                 <div class="text-truncate">
                                    You have paid ₱13,000.00 for Painter (Arts and Illustration)
                                 </div>
                              </td>
                           </tr>
                     </tbody>
                  </table>
                  <?php // PHP logic to fetch and display the pending funds of the freelancers
                  // $pendingFunds=getTransactionHistory(); // Replace with your logic to calculate
                  // echo '$' . number_format($TransactionHistory,2); ?>
               </div>
               <p class="card-text" style="font-size: 13px; text-align: right; margin: 20px;">
                    <a href="partner_transactionhistory.php" style="color: blue; text-decoration: none;">
                        View All
                    </a>
                </p>
            </div>
         </div>
         <!-- WITHDRAW START -->
         <div class="col-md-6">
            <div class="card" style="border-radius: 15px; margin-top: 20px; background-image: url('assets/images/coins.png'); background-size: cover; height: 290px;">
               <div class="card-body" style="text-align: center;">
                        <img src="https://i.ibb.co/brmjZxr/withdraw-removebg-preview.png" alt="Your Image Alt Text" style="width: 150px; height: 150px; margin-top: 10px;">
                        <h5 class="card-title" style="margin-top: 20px; font-weight: bold;">
                            Withdraw Using:
                        </h5>
                        <p class="card-text" style="font-size: 13px;">
                            <a href="partner_gcashwithdraw.php" class="btn btn-facebook" style="background-color: #007DFE;">
                                <img src="https://logos-download.com/wp-content/uploads/2020/06/GCash_Logo.png" alt="GCash Logo" style="width: 35px; height: 25px;">
                            </a>
                        </p>
               </div>
            </div>
         </div>
         <!-- WITHDRAW ENDS -->
         <!-- DEPOSIT START -->
         <div class="col-md-6">
            <div class="card" style="border-radius: 15px; margin-top: 20px; background-image: url('https://i.ibb.co/qDfyLmJ/Untitled-design-9.png'); background-size: cover; height: 290px;">
               <div class="card-body" style="text-align: center;">
                        <img src="https://i.ibb.co/M5RjY3j/deposit.png" alt="Your Image Alt Text" style="width: 150px; height: 150px; margin-top: 10px;">
                        <h5 class="card-title" style="margin-top: 20px; font-weight: bold;">
                            Deposit Using:
                        </h5>
                        <p class="card-text" style="font-size: 13px;">
                            <a href="partner_gcashdeposit.php" class="btn btn-facebook" style="background-color: #007DFE;">
                                <img src="https://logos-download.com/wp-content/uploads/2020/06/GCash_Logo.png" alt="GCash Logo" style="width: 35px; height: 25px;">
                            </a>
                        </p>
               </div>
            </div>
         </div>
         <!-- DEPOSIT ENDS -->
      </div>
   </div>
</div>

<?php
    include('includes/partner_footer.php');
?>