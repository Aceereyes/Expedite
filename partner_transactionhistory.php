<?php include( 'includes/partner_header.php'); ?>
   <div class="page-body">
      <div class="container">
         <div class="row g-2 align-items-center mb-3">
            <div class="col">
               <h2 class="page-title">
                  Transaction History
               </h2>
            </div>
            <div class="col-auto ms-auto">
               <div class="btn-list">
                  <span class="d-sm-inline">
                     <a href="<?= base_url("partner_funds.php"); ?>" class="btn">
                        <i class="ti ti-arrow-left">
                        </i>
                        Back
                     </a>
                  </span>
               </div>
            </div>
         </div>
      </div>
      <div class="card" style="margin: 0 80px;">
         <!-- Added inline style with margin -->
         <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="card-table table-responsive">
                     <table class="table table-vcenter">
                        <thead>
                           <tr>
                              <th>
                                 User
                              </th>
                              <th>
                                 Name
                              </th>
                              <th>
                                 Transaction
                              </th>
                              <th>
                                 Date
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url('https://i.ibb.co/wQ7j7Tm/Expedite-logo.png')">
                                 </span>
                              </td>
                              <td class="text-nowrap text-secondary">
                                 Expedite
                              </td>
                              <td class="td-truncate">
                                 <div class="text-truncate">
                                     You have paid ₱13,000.00 for Painter (Arts and Illustration)
                                 </div>
                              </td>
                              <td class="text-nowrap text-secondary">
                                 Today
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">
               Showing
               <span>
                  1
               </span>
               to
               <span>
                  3
               </span>
               of
               <span>
                  3
               </span>
               entries
            </p>
            <ul class="pagination m-0 ms-auto">
               <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                     <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                        </path>
                        <path d="M15 6l-6 6l6 6">
                        </path>
                     </svg>
                     prev
                  </a>
               </li>
               <li class="page-item">
                  <a class="page-link" href="#">
                     1
                  </a>
               </li>
               <li class="page-item active">
                  <a class="page-link" href="#">
                     2
                  </a>
               </li>
               <li class="page-item">
                  <a class="page-link" href="#">
                     3
                  </a>
               </li>
               <li class="page-item">
                  <a class="page-link" href="#">
                     next
                     <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                        </path>
                        <path d="M9 6l6 6l-6 6">
                        </path>
                     </svg>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <?php include( 'includes/partner_footer.php'); ?>