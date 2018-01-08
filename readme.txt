Easy Photo Host


Установка

отредактируйте config.php:

$domain = "http://ваш_сайт/fotohost/"; //полный адрес установки скрипта, вместе с завершающим слешем
$max_size = 1024 * 250; //макс.размер картинки (250КБ)
$tsize = 150;  //размер preview
$path = "images/"; //папка с картинками
$tpath = "thumbs/"; //папка с preview


залейте все файлы на сайт, на папки images и thumbs поставьте права 0777

всё!

p.s. дизайн настраивается в файлах top.php, bottom.php, style.css

