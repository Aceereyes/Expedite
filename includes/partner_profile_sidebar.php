<?php
    $links = [
        'Overview'                          => base_url('partner_profile_overview.php'),
        'My Profile'                        => base_url('partner_profile.php'),
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
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
})
</script>