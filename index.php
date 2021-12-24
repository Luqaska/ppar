<?php if($_SERVER["REQUEST_URI"]=="/" || $_SERVER["REQUEST_URI"]=="/index.php"){ ?><!DOCTYPE html>
<html dir="ltr" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>plan.Procrastin.Ar</title>
  </head>
  <body class="home">
    <!-- ojo... -->
    <?php include "_includes/logo.htm" ?>
    <form width="100%" action="/search/" method="GET"><input width="100%" type="text" name="q" placeholder="Buscar"><input type="submit" value="Search"><br><span style="background:white;border-radius:0 0 5px 5px;padding:0 20px">Based on <a href='https://github.com/luqaska/filde'>Filde</a></span></form>
    <div class="list">
      <h3>Explorá</h3>
      <li><a href="type.php?c=img">Dibujitos</a></li>
      <li><a href="type.php?c=txt">Documentos</a></li>
      <li><a href="type.php?c=digiart">Arte.txt</a></li>
    </div>
    <div class="list">
      <h3>Contacto</h3>
      <li><a href="libro/">Libro de visitas</a></li>
      <li><a href="bbs/">BBS</a></li>
      <li><a href="https://twitter.com/plan_PAr">Twitter</a></li>
    </div>
    <div class="list">
      <h3>Último subido</h3>
      <?php $list=explode("\n",file_get_contents("db/posts/index.txt")); $i=0; $s=count($list);
      while($i < 5){
        if(file_exists("db/posts/".$s.".json")){
          $inft = json_decode(file_get_contents("db/posts/".$s.".json"));
          echo "<li><a href='view.php?id=$s'>".$inft->{"title"}."</a></li>";
        }
        $s--;$i++;
      } ?>
    </div>
    <p><span>&copy;2021 plan.procrastin.ar</span></p>
  </body>
</html><?php }else{include_once("404.html");} ?>