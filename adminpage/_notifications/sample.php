<?php
$lotto_colors = array("red","yellow","blue","green","pink","black");
$lotto_colors_result = array_rand($lotto_colors,1);
?>
<div id = "random_colors">
<div style = "background-color:<?php echo $lotto_colors[$lotto_colors_result];?>;  height: 10%; width: 10%; border-radius:10px"><?php echo $lotto_colors[$lotto_colors_result];?></div>asdas
</div>