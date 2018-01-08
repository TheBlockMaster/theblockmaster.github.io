<?

include("config.php");
include("top.php");


$id=$_GET['id'];
if ($_GET['id']) {
  $id = $_GET['id'];
} else {
  die ("No ID Selected");
}

$urlf=$domain.$path.$id;
$rawid=substr($id,0,strlen($id)-4);
$thbf=$domain.$tpath.$rawid.".png";

?>
<a href='v.php?id=<?=$id?>' target=_blank><img src='<?=$thbf?>' border=0></a><br><br>
<?=$lang['bbcode']?>:<br>
<input type="text" size="60" onmouseover="this.select()" value="[url=<?=$domain?>v.php?id=<?=$id?>][img]<?=$thbf?>[/img][/url]"><br><br>
<?=$lang['html']?>:<br>
<input type="text" size="60" onmouseover="this.select()" value="<a href='<?=$domain?>v.php?id=<?=$id?>' target=_blank><img src='<?=$thbf?>' border=0></a>"><br><br>
<?=$lang['url']?>:<br>
<input type="text" size="60" onmouseover="this.select()" value='<?=$domain?>v.php?id=<?=$id?>'><br><br>
<?=$lang['directurl']?>:<br>
<input type="text" size="60" onmouseover="this.select()" value="<?=$urlf;?>"><br><br>
<?

include("bottom.php");

?>