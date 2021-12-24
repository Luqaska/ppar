<?php
include "config/general.php";
include "config/images.php";
header("Content-Type: application/rss+xml");
$aaa = str_replace("rss.php", "", $_SERVER["REQUEST_URI"]);
$eee = "http://$_SERVER[HTTP_HOST]$aaa";
if($WEBSITE_HTACCESS==True){$htaccess="p'";}else{$htaccess="pub.php?n=";}
?>
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title><?php echo $WEBSITE_NAME ?></title>
<link><?php echo $eee ?></link>
<?php if($WEBSITE_PROFILE_URL==True){echo "<image>\n  <url>$WEBSITE_PROFILE_URL</url>\n  <title>Photo</title>\n  <link>$eee</link></image>\n";} ?>
<?php $a = count($data) -1; $ao = 0; $next = $a + 1;
while($ao < count($data)){
  echo "<item>\n<title>".$data[$a][1]."</title>\n<link>$eee$htaccess$next</link>\n<guid>$eee$htaccess$next</guid>\n<description>".$data[$a][1]."</description>\n</item>\n";
  $a--; $ao++; $next--;
} ?>
</channel>
</rss>
