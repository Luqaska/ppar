<?php if(isset($_GET["id"])){
  if(file_exists("db/authors/$_GET[id].json")){
    $ainf = json_decode(file_get_contents("db/authors/$_GET[id].json")); ?>
<html dir="ltr" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>plan.Procrastin.Ar</title>
  </head>
  <body class="home">
    <a href="/" style="color:black;text-decoration:none"><?php include "_includes/logo.htm" ?></a>
    <div><img src="<?= $ainf->{"avatar"} ?>" width="100px" height="100px" alt="Avatar"></div>
    <h1 style="color:white"><?= $ainf->{"name"} ?></h1>
    <div class="list"><p>
<?php if($ainf->{"web"}){
  echo "<a href='".$ainf->{"web"}."'><i class='fa fa-globe'></i></a>\n";
}
if($ainf->{"ig"}){
  echo "<a href='https://instagram.com/".$ainf->{"ig"}."/'><i class='fa fa-instagram'></i></a>\n";
}
if($ainf->{"tw"}){
  echo "<a href='https://twitter.com/".$ainf->{"tw"}."'><i class='fa fa-twitter'></i></a>";
} ?>

    </p></div>
    <div class="list"><div>
      <?= $ainf->{"about"} ?>

    </div></div>
    <div class="list">
      <h3>Último subido</h3>
<?php
    $list=explode("\n",file_get_contents("db/posts/index.txt")); $i=0; $s=count($list); $p=0;
      while($i < count($list) || $p < 5){
        if(file_exists("db/posts/".$s.".json")){
        $inft = json_decode(file_get_contents("db/posts/".$s.".json"));
        if($inft->{"author"}==$_GET["id"]){
          echo "<li><a href='view.php?id=$s'>".$inft->{"title"}."</a></li>";
        }
      }
    $s--;$i++;$p++;
    }
 ?>

  </div>
  <div class="list">
    <h3>Todo el contenido de este estilo</h3>
    <p>(De viejo a nuevo)</p>
<?php 
    $list=explode("\n",file_get_contents("db/posts/index.txt")); $i=1;
      while($i <= count($list)){
        if(file_exists("db/posts/".$i.".json")){
        $inft = json_decode(file_get_contents("db/posts/".$i.".json"));
        if($inft->{"author"}==$_GET["id"]){
          echo "<li><a href='view.php?id=$i'>".$inft->{"title"}."</a></li>";
        }
      }
    $i++;
    } ?>

  </div>
  <p><span>&copy;2021 plan.procrastin.ar</span></p>
</body>
</html>
<?php }else{header("Location: /");}
}else{header("Location: /");} ?>