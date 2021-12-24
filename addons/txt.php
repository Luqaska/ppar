<?php if($info->{"type"}=="txt"){
  echo "<div>".htmlentities($info->{"text"})."</div>\n";
}elseif($info->{"type"}=="pdf"){
  echo "<div class='pdf'><iframe style='border:none' width='100%' height='600px' type='application/pdf' src='".$info->{"file"}."'></iframe></div>";
}