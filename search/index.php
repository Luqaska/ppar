<?php if($_SERVER["REQUEST_URI"]!="/search"){
  include_once("_config.txt");if(isset($_GET["q"]) && $_GET["q"]!=""){$is="q";}else{$is="h";} if($is=="h"){header("Location: /");} ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<title><?php if($is=="q"){$safeq=htmlentities($_GET["q"]);echo "'$safeq' - ";} echo $TITLE; ?></title>
</head>
<body class="<?= $is ?>">

<div id="container">
<div id="content">
<div id="header">
<a href="?" style="text-decoration:none"><h1><div style="font-family:'DejaVu Sans', sans-serif;font-weight:bold" id="logo"><span><span style="color:#843511">plan</span><span style="color:#FCBF49">.</span>Procrastin<span style="color:#FCBF49">.</span><span style="color:#75AADB">Ar</span></p></span></div></h1></a>
</div>

<div class="form">
<form autocomplete="off" method="get">
<div class="autocomplete">
    <input type="text" id="myInput" name="q" autofocus placeholder="search"<?php if($is=="q"){echo " value=\"$_GET[q]\"";} ?>>
    <input type="submit" value="find"> 
</div>
</form> 
</div>

<?php
if($is=="h"){echo "<div id='sub'><p>Based on <a href='https://youtu.be/MRoekZ93bpQ'>Yessle</a> - <a href='https://github.com/luqaska/filde'>Code</a></p></div>";}
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


echo "<br><br>";

$txt = file_get_contents("database.txt");

$keyword = "/" . $search_keyword . "/i";
$keyword_with_space = "/" . " " . $search_keyword . " " . "/i";
$keyword_in_start_title = "/" . "<b>" . $search_keyword . "" . "/i";

$t1=0;
//while($t1 <= 9){

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if($t1!=10&&preg_match($keyword_in_start_title,$line)){
if(!($search_keyword=="")){
echo "<div class='item'>";
$line = highlight($line,$search_keyword);
echo $line;
echo "</div>";
}
$t1=1;
}
}

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if($t1!=10&&preg_match($keyword_with_space,$line)&&!(preg_match($keyword_in_start_title,$line))){
if(!($search_keyword=="")){
echo "<div class='item'>";
$line = highlight($line,$search_keyword);
echo $line;
echo "</div>";
}
$t1=1;
}
}

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if($t1!=10&&preg_match($keyword,$line)&&!(preg_match($keyword_with_space,$line))&&!(preg_match($keyword_in_start_title,$line))){
if(!($search_keyword=="")){
echo "<div class='item'>";
$line = highlight($line,$search_keyword);
echo $line;
echo "</div>";
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

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = [
<?php
include 'autosuggest_list.txt';
echo '"' . ' ' . '"';
?>
];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>


</body>
</html>
<?php }else{include_once($_SERVER['DOCUMENT_ROOT']."/404.html");} ?>