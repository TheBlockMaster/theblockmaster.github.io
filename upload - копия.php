<?

//create thumbnails
function createthumb($name,$sourcetype,$filename,$new_w,$new_h){
  if ($sourcetype==".jpg"){
    $src_img=imagecreatefromjpeg($name);
  }
  if ($sourcetype==".png"){
    $src_img=imagecreatefrompng($name);
  }
  if ($sourcetype==".gif"){
    $src_img=imagecreatefromgif($name);
  }

  $old_x=imageSX($src_img);
  $old_y=imageSY($src_img);
  if ($old_x > $old_y) {
    $thumb_w=$new_w;
    $thumb_h=$old_y*($new_h/$old_x);
  }
  if ($old_x < $old_y) {
    $thumb_w=$old_x*($new_w/$old_y);
    $thumb_h=$new_h;
  }
  if ($old_x == $old_y) {
    $thumb_w=$new_w;
    $thumb_h=$new_h;
  }

  $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
  imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

  imagejpeg($dst_img,$filename);
  imagedestroy($dst_img);
  imagedestroy($src_img);
}

//------------------------ START HERE ------------------
include("config.php");
include("top.php");

if(!isset($_FILES['userfile'])) exit;
if(!is_uploaded_file($_FILES['userfile']['tmp_name'])) exit;

if ($_FILES['userfile']['size']>$max_size) {
  echo "<p align=center>".$lang['toobig']."</p>";
  exit;
}

$pictype="";
switch(strtolower($_FILES['userfile']['type'])){
  case "image/jpeg" : $pictype=".jpg"; break;
  case "image/pjpeg": $pictype=".jpg"; break;
  case "image/gif"  : $pictype=".gif"; break;
  case "image/png"  : $pictype=".png"; break;
  case "image/x-png": $pictype=".png"; break;
  default           : $pictype=""; break;
}

if($pictype!="") {
//-------
  do {
    $uniq=md5(uniqid(rand(),1));
    $srcfile=$path.$uniq.$pictype;
  } while(file_exists($srcfile));

  $res = copy($_FILES['userfile']['tmp_name'], $srcfile);

  if (!$res) {
    echo "<p align=center>".$lang['copyerr']."</p>";
    exit;
  }
  @chmod($srcfile,0666);
  //set url variable
  $imgf = $path . $uniq . $pictype;
  $thbf = $tpath . $uniq . ".jpg";
  createthumb($imgf,$pictype,$thbf,$tsize,$tsize);
  @chmod($thbf,0666);
  $urlf = $domain . $path . $uniq . $pictype;

  ?>
<br> 
<hr noshade size=1> 
<center> 
  <p><b><?=$lang['success']?></b></p>
  <a href='v.php?id=<?=$uniq.$pictype?>' target=_blank><img src='<?=$tpath.$uniq.".jpg"?>' border=0></a><br><br>

  <?=$lang['bbcode']?>:<br>
  <input type="text" size="60" onmouseover="this.select()" value="[url=<?=$domain?>v.php?id=<?=$uniq.$pictype?>][img]<?=$domain.$tpath.$uniq.".jpg"?>[/img][/url]"><br><br>
  <?=$lang['html']?>:<br>
  <input type="text" size="60" onmouseover="this.select()" value="<a href='<?=$domain?>v.php?id=<?=$uniq.$pictype?>' target=_blank><img src='<?=$domain.$tpath.$uniq.".jpg"?>' border=0></a>"><br><br>
  <?=$lang['url']?>:<br>
  <input type="text" size="60" onmouseover="this.select()" value='<?=$domain?>v.php?id=<?=$uniq.$pictype?>'><br><br>
  <?=$lang['directurl']?>:<br>
  <input type="text" size="60" onmouseover="this.select()" value="<?=$urlf;?>"><br><br>
</center>
  <?
//------
} else {
  echo "<p align=center>".$lang['format']."</p>";
  exit;
}

include("bottom.php");

?>