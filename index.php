<?

include("config.php");
echo "<link rel='stylesheet' type='text/css' href='css_style/body.css'>";
include("top.php");

?>
<form action="upload.php" method="post" enctype="multipart/form-data">
<table width=100% cellpadding=10 cellspacing=1 border=0 bgcolor=#A6E8FF>
<tr>
<td bgcolor=#B3ECFF align=center>
<br><br><br>
<?
$divd = 1024;
$isize = $max_size / $divd;
$isize2 = round($isize);
?>
<span class=blue>
<?=$lang['choose']?><br>
<?=$lang['maxfile']?> <?=$isize2?> <?=$lang['kb']?><br>
Кидать фото можно только с форматами jpg, jpeg, gif, png
</span><br><br>
<input name="userfile" type="file" size=40><br><br>
<input type="submit" value="<?=$lang['upload']?>">
<form action="upload.php" enctype="multipart/form-data" method="POST" name="form_upload">
    <label>Фото 1:<input name="file[]" type="file" /></label><br>
    <label>Фото 2:<input name="file[]" type="file" /></label><br>
    <label>Фото 3:<input name="file[]" type="file" /></label><br><br>
    <label><input name="button" type="submit" value="Отправить" /></label>
</form>
<br><br><br>
</td>
</tr>
</table>
</form>

<?

include("bottom.php");

?>