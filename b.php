<html>
    <head>
        <title>
            Найденные запросы
        </title>
        <style>
            input{
                border-radius: 5px;
                font-size: 20pt;
                position: relative;
                left: 40%;
            }
            div.feedback{
                font-size: 20pt;
                position: absolute;
                left: 35%;
                top: 10%;
            }
        </style>
    </head>
    <body>
<?php
    //Скрипт для создания базы
    $link = mysqli_connect("localhost", "root", "");
    //Установка кодировки utf8
    $link->set_charset("utf8");
    $sql = "SELECT * FROM users";
    $result = mysqli_query($link, $sql);
    //Создание базы в случае ее отсутствия
    if($result == false){
        $sql = "CREATE DATABASE reviews";
        $result = mysqli_query($link, $sql);
        $result = mysqli_select_db($link, 'reviews');
        $sql = "CREATE TABLE users (
        id int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name varchar(20) CHARACTER SET utf8 DEFAULT NULL,
        last_name varchar(30) CHARACTER SET utf8 DEFAULT NULL,
        phone varchar(15) CHARACTER SET utf8 DEFAULT NULL,
        review text CHARACTER SET utf8 DEFAULT NULL, time datetime NOT NULL
        )";
        $result = mysqli_query($link, $sql);
    }
    else{
        $result = mysqli_select_db($link, 'reviews');
    }
    //Объявление переменных
    date_default_timezone_set('Europe/Moscow');
    $time = date("Y-m-d H:i:s");
    $first_name_status = empty($_POST["first_name"]);
    $last_name_status = empty($_POST["last_name"]);
    $phone_status = empty($_POST["phone"]);
    $review_status = empty($_POST["review"]);
    //Кнопка "Назад"
    echo '<div class = feedback>';
    echo '<form action = "index.php" method = "post">';
    echo '<input type="button" value="Назад" onclick="history.back()">';
    echo '</form>';
    //Проверка заполненности полей
    if($first_name_status || $last_name_status || $phone_status || $review_status){
         echo "Вы заполнили не все поля!";
    }
    else{
        $continue = true;
        $mistake = false;
        $first_name = $_POST["first_name"];
        if(!preg_match('/^[А-Я]+[а-я]*$/u', $first_name)){
            $mistake = true;
            $continue = false;
        }
    }
    if(!$first_name_status  && !$review_status){
        if($mistake) echo "Ошибка в формате Имени!<br>";
        $mistake = false;
        $last_name = $_POST["last_name"];
        if(!preg_match('/^[А-Я]+[а-я]*$/u', $last_name)){
            $mistake = true;
            $continue = false;
        }   
    }
    if(!$last_name_status && !$review_status){
        if($mistake) echo "Ошибка в формате Фамилии!";
        $mistake = false;
        $phone = $_POST["phone"];
        if ((!preg_match('/^[8][0-9]{10,10}+$/', $phone)) && (!preg_match('/^[+][7][0-9]{10,10}+$/', $phone))){
            $mistake = true;
            $continue = false;
        }
    }
    /*
    Удаление префикса из номера телефона
    для последующего сравнения в запросе SQL
    */
    $short_phone = " ";
    if($phone[0] == "+"){
        for($i = 0; $i < 10; $i++){
            $short_phone[$i] = $phone[$i+2];
        }
    }
    else{
        for($i = 0; $i < 10; $i++){
            $short_phone[$i] = $phone[$i+1];
        }
    }
    //Запись отзыва в базу
    if(!$phone_status && !$review_status){
        $review = $_POST["review"];
        if($mistake) echo "Ошибка в формате номера телефона!<br>";
        if($continue){
            $sql = "SELECT * FROM users WHERE phone LIKE '%$short_phone%'";
            $result = mysqli_query($link, $sql);
            if($result != false){
                $database = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if(count($database) == 0){
                    //Проверка повторения номера телефона
                    $sql = "INSERT INTO users SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', review = '$review', time = '$time'";
                    $result = mysqli_query($link, $sql);
                    echo "Ваш отзыв успешно отправлен <br>";
                    echo "Ваше Имя: <b> $first_name</b><br>";
                    echo "Ваша Фамилия:  <b> $last_name</b><br>";
                    echo "Ваш телефон:  <b> $phone</b><br>";
                }
                else echo "Вы уже оставляли отзыв.<br>";
            }
            //Заполнение в случае, когда в базе еще нет записей
            else{
                $sql = "INSERT INTO users SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', review = '$review', time = '$time'";
                $result = mysqli_query($link, $sql);
            }
        }
    }
    mysqli_close($link);
    echo '</div>';
?>
    </body>
</html>