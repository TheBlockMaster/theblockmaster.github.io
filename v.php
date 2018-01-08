<?php
include("config.php");
include("top.php");


$id=$_GET['id'];
if ($_GET['id']) {
  $id = $_GET['id'];
} else {
  die ("No ID Selected");
}

echo "<center><img src='$path$id'><br><br>

".$lang['wanna']." <a href='code.php?id=$id'>".$lang['getcode']."</a></center>";

include("bottom.php");


?>