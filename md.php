<?php header("content-type: text/markdown") ?>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<title>plan.Procrastin.Ar</title>
<h2><a href="md.php" style="text-decoration:none;color:black"><?php include "_includes/logo.htm" ?></a></h2>
<?php if(isset($_GET["author"])){
if(isset($_GET["id"])){
  if(file_exists("db/authors/$_GET[id].json")){
    $ainf = json_decode(file_get_contents("db/authors/$_GET[id].json")); ?>
<img src="<?= $ainf->{"avatar"} ?>" width="100px" height="100px" alt="Avatar">

# <?= $ainf->{"name"} ?>


<?php if($ainf->{"web"}){
  echo "<a href='".$ainf->{"web"}."'><i class='fa fa-globe'></i></a>\n";
}
if($ainf->{"ig"}){
  echo "<a href='https://instagram.com/".$ainf->{"ig"}."/'><i class='fa fa-instagram'></i></a>\n";
}
if($ainf->{"tw"}){
  echo "<a href='https://twitter.com/".$ainf->{"tw"}."'><i class='fa fa-twitter'></i></a>";
} ?>


`
<?= $ainf->{"about"} ?>
`


### Último subido
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


### Todo el contenido de este estilo

(De viejo a nuevo)

<?php 
$list=explode("\n",file_get_contents("db/posts/index.txt")); $i=1;
while($i <= count($list)){
  if(file_exists("db/posts/".$i.".json")){
    $inft = json_decode(file_get_contents("db/posts/".$i.".json"));
    if($inft->{"author"}==$_GET["id"]){
      echo "- [".$inft->{"title"}."](?view&id=$i)\n";
    }
  }
$i++;
} ?>
<?php }else{header("Location: /");}
}else{header("Location: /");}
}elseif(isset($_GET["type"])){
if(isset($_GET["c"])){
  if(file_exists("addons/$_GET[c].php")){ ?>

# <?= $_GET["c"] ?>


### Último subido
<?php
    $list=explode("\n",file_get_contents("db/posts/index.txt")); $i=0; $s=count($list); $p=0;
      while($i < count($list) || $p < 5){
        if(file_exists("db/posts/".$s.".json")){
        $inft = json_decode(file_get_contents("db/posts/".$s.".json"));
        if($inft->{"addon"}==$_GET["c"]){
          echo "- [".$inft->{"title"}."](?view&id=$s)\n";
        }
      }
    $s--;$i++;$p++;
    }
 ?>



### Todo el contenido de este estilo

(De viejo a nuevo)
<?php 
    $list=explode("\n",file_get_contents("db/posts/index.txt")); $i=1;
      while($i <= count($list)){
        if(file_exists("db/posts/".$i.".json")){
        $inft = json_decode(file_get_contents("db/posts/".$i.".json"));
        if($inft->{"addon"}==$_GET["c"]){
          echo "- [".$inft->{"title"}."](?view&id=$i)\n";
        }
      }
    $i++;
    } ?>
<?php }else{header("Location: /");}
}else{header("Location: /");}
}elseif(isset($_GET["view"])){
if(isset($_GET["id"])){
  if(file_exists("db/posts/".$_GET["id"].".json")){
    $info = json_decode(file_get_contents("db/posts/".$_GET["id"].".json")); ?>

<?php
$title = htmlentities($info->{"title"});
echo "# $title\n\n> por ";
if($info->{"author"}!=0){
  $ainf = json_decode(file_get_contents("db/authors/".$info->{"author"}.".json"));
  echo "[".htmlentities($ainf->{"name"})."](?author&id=".$info->{"author"}.")";
}else{
  echo "Anónimo";
}
echo "\n\n";
include "addons/".$info->{"addon"}.".php"; ?>

<?php
  }else{header("Location: /");}
}else{header("Location: /");}
}else{ ?>
<form action="/search/md.php" method="GET">

<input type="text" name="q" placeholder="Buscar"><input type="submit" value="Search">

Based on [Filde](https://github.com/luqaska/filde)

</form>


### Explorá
- [Dibujitos](?type&c=img)
- [Documentos](?type&c=txt)
- [Arte.txt](?type&c=digiart)


### Contacto
- [Libro de visitas](libro/) (HTML)
- [BBS](bbs/) (HTML)
- [Twitter](https://twitter.com/plan_PAr) (HTML)

### Último subido
<?php $list=explode("\n",file_get_contents("db/posts/index.txt")); $i=0; $s=count($list);
while($i < 5){
  if(file_exists("db/posts/".$s.".json")){
    $inft = json_decode(file_get_contents("db/posts/".$s.".json"));
    echo "- [".$inft->{"title"}."](?view&id=$s)\n";
  }
  $s--;$i++;
}
} ?>

------

(C)2021 plan.procrastin.ar