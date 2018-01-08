<?
include "config.php";
?>
<html>
<head>
<title>������ �������� ����</title>
<link rel="stylesheet" href="style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor=#8BE1FF text=#8BE1FF>
<form action="upload.php" method="post" enctype="multipart/form-data" target=_blank>
<?
$divd = 1024;
$isize = $max_size / $divd;
$isize2 = round($isize);
?>
<span class=ifr>
<?=$lang['choose']?><br>
<?=$lang['maxfile']?> <?=$isize2?> <?=$lang['kb']?><br>
jpg jpeg gif png
</span>
<br><br>
<input name="userfile" type="file"><br><br>
<input type="submit" value="<?=$lang['upload']?>">
</form>
<?php
$uploadDir = 'image/'; //папка для хранения файлов
$dir = '/iframe/'; //базовый путь к скрипту
$mwidth = 500; //ширина превью в пикселях
$allowedExt = array('jpg', 'jpeg', 'png', 'gif');
$maxFileSize = 2 * 1024 * 1024; //2 MB
//если получен файл
if (isset($_FILES)) {
    //проверяем размер и тип файла
    $ext = end(explode('.', strtolower($_FILES['Filedata']['name'])));
    if (!in_array($ext, $allowedExt)) {
        return;
    }
    if ($maxFileSize < $_FILES['Filedata']['size']) {
        return;
    }
    if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {
    //Магия с созданием уникального имени. Начало
        $fileName = $uploadDir.$_FILES['Filedata']['name'];
        $nameParts = explode('.', $_FILES['Filedata']['name']);
        $nameParts[count($nameParts)-2] =substr(md5(time()),7);
        $fileName = $uploadDir.implode('.', $nameParts);
        //если файл с таким именем уже существует... Невероятное! =)
        while(file_exists($fileName)) {
            //...добавляем текущее время к имени файла
            $nameParts = explode('.', $_FILES['Filedata']['name']);
            $nameParts[count($nameParts)-2] =substr(md5(time()),7);
            $fileName = $uploadDir.implode('.', $nameParts);
        }
        //Генерим путь к mini
        $dirParts=explode('/',$fileName);
        $dirParts[0].="/mini";
        $fileName2 = implode('/',$dirParts);
    //Магия с созданием уникального имени. Конец
        move_uploaded_file($_FILES['Filedata']['tmp_name'], $fileName);
        //Костыль ресайза картинок до width:500px; начало
        // Get new sizes
        list($width, $height) = getimagesize($fileName);
        if($width>$mwidth) {
        $newwidth=$mwidth;
        $k=$newwidth/$width;
        $newheight = $height * $k;
        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($fileName);

        // Resize
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagejpeg($thumb, $fileName2);
        $ext='<a href="'.$dir.$fileName.'"><img src="'.$dir.$fileName2.'"/></a>';
        echo $ext."<br/>";
        echo '<input type="text" size="150" value="'.htmlspecialchars($ext).'"><br />';
        }
        //Костыль ресайза картинок до width:500px; конец
        else {
            $ext='<img src="'.$dir.$fileName.'"/>';
        echo $ext."<br/>";
        echo '<input type="text" size="150" value="'.htmlspecialchars($ext).'"><br />';
        }
    }
}
</body>
</html>