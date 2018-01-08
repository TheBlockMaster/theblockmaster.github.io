<?php
/**  
 * Функция загрузки файла (аплоадер)  
 * @param  int    $max_file_size    максимальный размер файла в мегабайтах  
 * @param  array  $valid_extensions массив допустимых расширений  
 * @param  string $upload_dir       директория загрузки  
 * @return array                    сообщение о ходе выполнения  
 */ 
    $extensions = array('jpg', 'jpeg', 'png', 'gif');  
    $upload_dir = 'img_user';  // папка для загрузки (создать на сервере)
 
    function uploadHandle($max_file_size = 1024, $valid_extensions = array(), $upload_dir = '.', $i = 0)  
    {  
       
        $error = null;  
        $info  = null;  
        $max_file_size *= 1048576;  // размер файла в Mb
        if ($_FILES['file']['error'][$i] === UPLOAD_ERR_OK)  
        {  
            // проверяем расширение файла  
            $file_extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);  
            if (in_array(strtolower($file_extension), $valid_extensions))  
            {  
                // проверяем размер файла  
                if ($_FILES['file']['size'][$i] < $max_file_size)  
                {  
          $file_name = time() . $_FILES['file']['name'][$i];  // к имени файла добавляем метку времени, чтобы исключить одинаковые имена
                    $destination = $upload_dir .'/' . $file_name;  
       
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $destination))  
                        $info = 'Файл успешно загружен';  
                    else 
                        $error = 'Не удалось загрузить файл';  
                }   
                else 
                    $error = 'Размер файла больше допустимого';  
            }   
            else 
                $error = 'У файла недопустимое расширение';  
        }   
        else 
        {  
            // массив ошибок  
            $error_values = array( 
 
                UPLOAD_ERR_INI_SIZE   => 'Размер файла больше разрешенного директивой upload_max_filesize в php.ini',  
                UPLOAD_ERR_FORM_SIZE  => 'Размер файла превышает указанное значение в MAX_FILE_SIZE',                            
                UPLOAD_ERR_PARTIAL    => 'Файл был загружен только частично',   
                UPLOAD_ERR_NO_FILE    => 'Не был выбран файл для загрузки',   
                UPLOAD_ERR_NO_TMP_DIR => 'Не найдена папка для временных файлов',   
                UPLOAD_ERR_CANT_WRITE => 'Ошибка записи файла на диск'
 
                                  );  
       
            $error_code = $_FILES['file']['error'][$i];  
       
            if (!empty($error_values[$error_code]))  
                $error = $error_values[$error_code];  
            else 
                $error = 'Случилось что-то непонятное';  
        }  
       
        return array('info' => $info, 'error' => $error);  
    }
?>