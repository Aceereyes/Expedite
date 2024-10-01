<?php
    include('includes/partner_header.php');
?>
<div class="page-body">
      <div class="container">
         <div class="row g-2 align-items-center mb-3">
            <div class="col">
               <h2 class="page-title">
                  Pre-recorded Answer
               </h2>
            </div>
            <div class="col-auto ms-auto">
               <div class="btn-list">
                  <span class="d-sm-inline">
                     <a href="<?= base_url("partner_examine_qview.php"); ?>" class="btn">
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
                <iframe width="100%" height="800" src="https://www.youtube.com/embed/NWWaOWRRR38?si=8m_G4HyQhdR17X7G" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<div class="form-group" style="text-align: center; padding-top: 20px">
            <a href="<?= base_url("partner_dashboard.php"); ?>">
                <button class="btn btn-primary" id="withdrawBtn" style="width: 200px; border-radius: 20px;">Proceed</button>
            </a>
      </div>
                  

<?php
    include('includes/partner_footer.php');
?>