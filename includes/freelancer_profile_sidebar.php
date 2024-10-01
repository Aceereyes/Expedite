<?php
    $links = [
        'My Profile'                        => base_url('freelancer_profile.php'),
        'Academic Qualifications'           => base_url('freelancer_profile_academic.php'),
        'Professional Qualifications'       => base_url('freelancer_profile_professional.php'),
        'Language Proficiency'              => base_url('freelancer_profile_language.php'),
        'Training & Workshops'              => base_url('freelancer_profile_training.php'),
        'Work Experience'                   => base_url('freelancer_profile_work.php'),
        'My Curriculum Vitae'               => base_url('freelancer_profile_cv.php'),
        'Other Attachments'                 => base_url('freelancer_profile_other.php'),
        // 'Applied Jobs'                      => base_url('freelancer_profile_applied.php'),
    ];
?>
    <div id="profileNav">
<?php
        foreach($links as $name => $link) {
            echo "<div class=\"list-group list-group-transparent\">
                <a href=\"$link\" class=\"list-group-item list-group-item-action d-flex align-items-center\">$name</a>
            </div>";
        }
?>
    </div>

<script>
$(function(){
    var current = location.pathname.replace('_edit', '');
    $('#profileNav div a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
})
</script>