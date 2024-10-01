<?php include('includes/freelancer_header.php'); ?>
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
                     Freelancer
                  </p>
                  <p class="card-title" style="font-size: 13px; color: white; text-align: left;">
                     Aaron Christian Delos Reyes
                  </p>
                  <div class="d-flex justify-content-between align-items-center text">
                     <p class="card-title" style="font-size: 13px; color: white; text-align: right;margin-top: 80px;">
                        Total Transactions:
                     </p>
                     <p class="card-text" style="font-size: 24px; font-weight: bold; color: white; text-align: right;margin-top: 80px;">
                        3
                        <!-- <?php echo number_format($totalTransactions, 2); ?></p> -->
                     </p>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                     <p class="card-title" style="font-size: 15px; color: white; text-align: right;">
                        Current Balance:
                     </p>
                     <p class="card-text" style="font-size: 24px; color:white; font-weight: bold; text-align: right;">
                        ₱ 600.00
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
            <div class="card" style="border-radius: 15px; background-color: #E8E8E8; margin-top: 10px;">
               <div class="card-body">
                  <h5 class="card-title">
                     Recent Transaction History
                  </h5>
                  <table class="table table-vcenter">
                     <tbody>
                           <tr>
                              <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url('https://www.gotochi.com/wp-content/uploads/Mcdonalds-logo-icon-png-free-500x417.png')">
                                 </span>
                              </td>
                              <td class="td-truncate">
                                 <div class="text-truncate">
                                    You have received ₱100.00 from Mcdonalds
                                 </div>
                              </td>
                              <td class="text-nowrap text-secondary">
                                 Today
                              </td>
                           </tr>
                           <tr>
                              <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url('https://i.forbesimg.com/media/lists/companies/jollibee-foods_416x416.jpg')">
                                 </span>
                              </td>
                              <td class="td-truncate">
                                 <div class="text-truncate">
                                    You have received ₱200.00 from Jollibee
                                 </div>
                              </td>
                              <td class="text-nowrap text-secondary">
                                 28 Jan 2024
                              </td>
                           </tr>
                           <tr>
                              <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url('https://clipground.com/images/kf-logo-clipart-8.png')">
                                 </span>
                              </td>
                              <td class="td-truncate">
                                 <div class="text-truncate">
                                    You have received ₱300.00 from KFC
                                 </div>
                              </td>
                              <td class="text-nowrap text-secondary">
                                 27 Jan 2023
                              </td>
                           </tr>
                     </tbody>
                  </table>
                  <p class="card-text" style="font-size: 13px; text-align: right;">
                     <a href="freelancer_transactionhistory.php" style="color: blue; text-decoration: none;">
                        View All
                     </a>
                  </p>
                  <?php // PHP logic to fetch and display the pending funds of the freelancers
                  // $pendingFunds=getTransactionHistory(); // Replace with your logic to calculate
                  // echo '$' . number_format($TransactionHistory,2); ?>
               </div>
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
                            <a href="freelancer_gcashwithdraw.php" class="btn btn-facebook" style="background-color: #007DFE;">
                                <img src="https://logos-download.com/wp-content/uploads/2020/06/GCash_Logo.png" alt="GCash Logo" style="width: 35px; height: 25px;">
                            </a>
                        </p>
               </div>
            </div>
         </div>
         <!-- WITHDRAW ENDS -->
         <!-- GCASH -->
         <div class="col-md-6">
            <div class="card" style="border-radius: 15px; margin-top: 20px; background-image: url('https://i.ibb.co/hMBK3BJ/gcash-visa-1.jpg'); background-size: cover; background-position: center; height: 290px;">
            </div>
         </div>
         <!-- GCASH END -->
      </div>
   </div>
</div>
<?php include('includes/freelancer_footer.php'); ?>