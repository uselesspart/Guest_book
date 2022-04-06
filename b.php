<?php
    $first_name_status = empty($_POST["first_name"]);
    $last_name_status = empty($_POST["last_name"]);
    $phone_status = empty($_POST["phone"]);
    //First name
    if($first_name_status || $last_name_status || $phone_status)
    {
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
    if(!$first_name_status)
    {
        if($mistake) echo "Ошибка в формате Имени!<br>";
        $mistake = false;
        //Last name
        $last_name = $_POST["last_name"];
        if(!preg_match('/^[А-Я]+[а-я]*$/u', $last_name)){
            $mistake = true;
            $continue = false;
        }   
    }
    if(!$last_name_status)
    {
        if($mistake) echo "Ошибка в формате Фамилии!";
        //Phone number
        $mistake = false;
        $phone = $_POST["phone"];
        if ((!preg_match('/^[8][0-9]{10,10}+$/', $phone)) && (!preg_match('/^[+][7][0-9]{10,10}+$/', $phone))){
            $mistake = true;
            $continue = false;
        }
    }
    if(!$phone_status)
    {
        if($mistake) echo "Ошибка в формате номера телефона!<br>";
        if($continue){
            echo "Ваш отзыв успешно отправлен <br>";
            echo "Ваше ФИО: <b> $first_name</b><br>";
            echo "Ваше e-mail:  <b> $last_name</b><br>";
            echo "Ваш телефон:  <b> $phone</b><br>";
        }
    }
?>