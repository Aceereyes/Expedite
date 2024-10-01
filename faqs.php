<?php
    include('includes/guest_header.php');
?>
    <div class="page-body">
        <div class="container">
            <div class="page-title mb-3">
                Frequently Asked Questions
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
    </div>
<?php
    include('includes/guest_footer.php');
?>