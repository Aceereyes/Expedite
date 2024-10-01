<?php
    include('includes/partner_header.php');
?>

<div class="page-body">
      <div class="container">
         <div class="row g-2 align-items-center mb-3">
            <div class="col">
               <h2 class="page-title">
                  Questions
               </h2>
            </div>
            <div class="col-auto ms-auto">
               <div class="btn-list ">
                   <span class="d-sm-inline">
                     <a class="btn">
                        Add Questions
                     </a>
                  </span>  
                  <span class="d-sm-inline">
                     <a href="<?= base_url("partner_examine_qschedules.php"); ?>" class="btn">
                      <i class="ti ti-arrow-left">
                        </i>
                        Back
                     </a>
                  </span>  
               </div>
            </div>
         </div>
      </div>
      <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="accordion">
<?php
                        $faqs = \App\Models\CRM\FAQ::active()->get();
                        if($faqs->count() > 0) {
                            foreach($faqs as $faq) {
                                echo '<div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false">
                                            '.$faq->title.'
                                        </button>
                                    </h2>
                                    <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            '.$faq->content.'
                                        </div>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo '<div class="alert alert-info">There are no Frequently Asked Questions.</div>';
                        }
?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" style="text-align: center; padding-top: 20px">
            <a href="partner_examine_qanswers.php">
                <button class="btn btn-primary" id="withdrawBtn" style="width: 200px; border-radius: 20px;">View Answers</button>
            </a>
      </div>
    </div>
         


<?php
    include('includes/partner_footer.php');
?>