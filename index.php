<?php
$searchRoot = __DIR__;
$searchResult = array();
if(isset($_POST['search_file_name'])) {

    $searchName = $_POST['search_file_name'];

    function funcSearch ($searchRoot, $searchName, &$searchResult) 
    {
        $rootList = array_diff(scandir($searchRoot), ['..', '.']);   
        foreach ($rootList as $key => $value) {
            $path = $searchRoot . '/' . $value;
            if (is_dir($path)) {
                funcSearch($path, $searchName, $searchResult);
            } else {
                if($rootList[$key] == $_POST['search_file_name'] && filesize($path) > 0) {
                    $searchResult[$key] = $searchRoot . '/' . $value;             
                }
            }
        }

    }

    echo funcSearch($searchRoot, $searchName, $searchResult);
    if(count($searchResult) < 1) {
        echo "Массив пуст";
    } else {
        var_dump($searchResult);
    }
}



 ?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="css/style.css" rel="stylesheet"> -->
    </head>
    <body>
        <form method="post">
           <input name="search_file_name" type="text" placeholder="Введите имя искомого файла"> 
           <input name="btn_send" type="submit"> 
        </form>
    </body>
</html>