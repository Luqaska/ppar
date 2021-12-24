<?php echo "  <video class='show' poster='".$info->{"img"}."' controls><source src='".$info->{"vid"}."'></video>\n";
echo "<p>".htmlentities($info->{"description"})."</p>";