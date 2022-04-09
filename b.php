<?php
    date_default_timezone_set('Europe/Moscow'); //Часовой пояс - Москва
    $time = date("Y-m-d H:i:s");
    $first_name_status = empty($_POST["first_name"]);
    $last_name_status = empty($_POST["last_name"]);
    $phone_status = empty($_POST["phone"]);
    $review_status = empty($_POST["review"]);
    $link = mysqli_connect("localhost", "root", "","reviews");
    $link->set_charset("utf8"); //Установка кодировки utf8
    //Кнопка "Назад"
    echo '<form action = "index.php" method = "post">';
    echo '<input type="button" value="Назад" onclick="history.back()">';
    echo '</form>';
    //First name
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
        //Last name
        $last_name = $_POST["last_name"];
        if(!preg_match('/^[А-Я]+[а-я]*$/u', $last_name)){
            $mistake = true;
            $continue = false;
        }   
    }
    if(!$last_name_status && !$review_status){
        if($mistake) echo "Ошибка в формате Фамилии!";
        //Phone number
        $mistake = false;
        $phone = $_POST["phone"];
        if ((!preg_match('/^[8][0-9]{10,10}+$/', $phone)) && (!preg_match('/^[+][7][0-9]{10,10}+$/', $phone))){
            $mistake = true;
            $continue = false;
        }
    }
    if(!$phone_status && !$review_status){
        $review = $_POST["review"];
        if($mistake) echo "Ошибка в формате номера телефона!<br>";
        if($continue){
            //Ищем в базе отзывы с таким же номером телефона
            $sql = "SELECT * FROM users WHERE phone = '$phone'";
            $result = mysqli_query($link, $sql);
            if($result != false){
                $database = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if(count($database) == 0){
                    //Отчет о добавленном отзыве
                    $sql = "INSERT INTO users SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', review = '$review', time = '$time'";
                    $result = mysqli_query($link, $sql);
                    echo "Ваш отзыв успешно отправлен <br>";
                    echo "Ваше Имя: <b> $first_name</b><br>";
                    echo "Ваша Фамилия:  <b> $last_name</b><br>";
                    echo "Ваш телефон:  <b> $phone</b><br>";
                }
                else echo "Вы уже оставляли отзыв.<br>";    //В случае потвторения номера
            }
            else{   //Если база пустая
                $sql = "INSERT INTO users SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', review = '$review', time = '$time'";
                $result = mysqli_query($link, $sql);
            }
        }
    }
?>