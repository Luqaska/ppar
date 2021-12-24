<?php
  header("content-type: text/markdown");
  include_once("_config.txt");if(isset($_GET["q"]) && $_GET["q"]!=""){$is="q";}else{$is="h";} if($is=="h"){header("Location: /");} ?>
<link rel="stylesheet" href="/css/styles.css">
<title><?php if($is=="q"){$safeq=htmlentities($_GET["q"]);echo "'$safeq' - ";} echo $TITLE; ?></title>
<h2><a href="/md.php" style="text-decoration:none;color:black"><?php include "../_includes/logo.htm" ?></a></h2>


<form autocomplete="off" method="get">
<div class="autocomplete">
    <input type="text" id="myInput" name="q" autofocus placeholder="search"<?php if($is=="q"){echo " value=\"$_GET[q]\"";} ?>>
    <input type="submit" value="find"> 
</div>
</form> 

<?php
if($is=="h"){echo "\n\nBased on [Yessle](https://youtu.be/MRoekZ93bpQ) - [Code](https://github.com/luqaska/filde)\n\n";}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function highlight($line,$search_keyword){

$number_of_words = str_word_count($search_keyword);
$words = str_word_count($search_keyword,1);

if($number_of_words==1){
$line = str_replace(" " . $words[0] . " ", " <mark>" . $words[0] . "</mark> ",$line);
}
return $line;
}


if($_SERVER["REQUEST_METHOD"] == "GET"){

$search_keyword = test_input($_GET["q"]);



$txt = str_replace("type.php?","md.php?type&",str_replace("view.php?","md.php?view&",file_get_contents("database.txt")));

$keyword = "/" . $search_keyword . "/i";
$keyword_with_space = "/" . " " . $search_keyword . " " . "/i";
$keyword_in_start_title = "/" . "<b>" . $search_keyword . "" . "/i";

$t1=0;
//while($t1 <= 9){

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if($t1!=10&&preg_match($keyword_in_start_title,$line)){
if(!($search_keyword=="")){
echo "\n\n-----\n\n";
$line = highlight($line,$search_keyword);
echo $line;
echo "\n\n-----\n\n";
}
$t1=1;
}
}

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if($t1!=10&&preg_match($keyword_with_space,$line)&&!(preg_match($keyword_in_start_title,$line))){
if(!($search_keyword=="")){
echo "\n\n-----\n\n";
$line = highlight($line,$search_keyword);
echo $line;
echo "\n\n-----\n\n";
}
$t1=1;
}
}

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if($t1!=10&&preg_match($keyword,$line)&&!(preg_match($keyword_with_space,$line))&&!(preg_match($keyword_in_start_title,$line))){
if(!($search_keyword=="")){
echo "\n\n-----\n\n";
$line = highlight($line,$search_keyword);
echo $line;
echo "\n\n-----\n\n";
}
$t1=1;
}
}

//}

if($t1==0){echo "<div class='item' style='text-align:center'><h3>(￣ω￣;) 0 results...</h3></div>";}
if($t1==10&&$is=="q"){echo "<p class='btn'>Load more (coming soon)</p>";}

}
?>

</div>
</div>