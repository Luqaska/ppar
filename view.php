<?php if(isset($_GET["id"])){
  if(file_exists("db/posts/".$_GET["id"].".json")){
    $info = json_decode(file_get_contents("db/posts/".$_GET["id"].".json")); ?>
<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width" />
<link href="css/styles.css" rel="stylesheet" type="text/css">
<title>plan.Procrastin.Ar</title>
<meta property="og:title" content="<?= $_GET["id"] ?>" />
<meta property="og:type" content="video.movie" />
<meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
<meta property="og:image" content="<?= $info->{"img"} ?>" />
</head>
<body class="view">
<!-- ojo... -->
<?php
echo '<a href="index.php" style="text-decoration:none">';
include "_includes/logo.htm";
echo "</a>\n";
$title = htmlentities($info->{"title"});
echo "<h1><span style='background:white'>$title</span><br><span id='author'>por ";
if($info->{"author"}!=0){
  $ainf = json_decode(file_get_contents("db/authors/".$info->{"author"}.".json"));
  echo "<a href='author.php?id=".$info->{"author"}."'>".htmlentities($ainf->{"name"})."</a>";
}else{
  echo "Anónimo";
}
echo "</span></h1>\n";
include "addons/".$info->{"addon"}.".php"; ?>
<div style="margin:0 10%"><script src="https://giscus.app/client.js"
  data-repo="luqaska/ppar-foro"
  data-repo-id="R_kgDOGdHphw"
  data-category="Comentarios"
  data-category-id="DIC_kwDOGdHph84CAE_V"
  data-mapping="og:title"
  data-reactions-enabled="1"
  data-emit-metadata="0"
  data-theme="light"
  data-lang="es"
  crossorigin="anonymous"
async></script></div>

<p><span style="background:white">&copy;2021 plan.procrastin.ar</span></p>
</body>
</html>
<?php
  }else{header("Location: /");}
}else{header("Location: /");} ?>