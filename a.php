<?php
    //Часовой пояс
    date_default_timezone_set('Europe/Moscow');
    //Получаем переменные
    $start_date = date_format(date_create($_POST['start_date']), "Y-m-d H:i:s");
    $end_date = date_format(date_create($_POST['end_date']), "Y-m-d H:i:s");
    //Пытаемся найти нашу базу данных
    try{
        $link = mysqli_connect("localhost", "root", "", "reviews");
        //Устанавливаем кодировку 
        $link->set_charset("utf8");
        $sql = "SELECT id, first_name, last_name, phone, review, time FROM users WHERE(time > '$start_date' AND time < '$end_date')";
        $result = mysqli_query($link, $sql);
    } catch(Exception $e){
        $result = false;
    }
    //Кнопка "Назад"
    echo '<div class=container1>';
    echo '<form action = "index.php" method = "post">';
    echo '<input type="button" value="Назад" onclick="history.back()">';
    echo '</form>';
    if($result != false){
        $database = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $table = array(array());
        //Заполнение массива для таблицы
        if(count($database) == 0) print '<br>Не найдено запросов в выбранный временной промежуток<br>';
        else{
        //Вычисляем количество найденных отзывов
        $n = $database[count($database)-1]['id'] - $database[0]['id']+1;
        for($i = 0; $i < $n; $i++){
            $table[$i][1] = $database[$i]['first_name'];
            $table[$i][2] = $database[$i]['last_name'];
            $table[$i][3] = $database[$i]['phone'];
            $table[$i][4] = $database[$i]['review'];
            $table[$i][5] = $database[$i]['time'];
        }
        //Отрисовка таблицы
        echo '<table border = "1"';
        echo '<tr><td>Имя</td><td>Фамилия</td><td>Номер телефона</td><td>Отзыв</td><td>Время</td>';
        for($i = 0; $i < $n; $i++){
            echo '<tr>';
            for($j = 1; $j <= 5; $j++){
            echo "<td>  ".$table[$i][$j]." </td>";
            }
            echo '</tr>';
        }
        echo '</table>';
        }
        echo '</div>';
        mysqli_close($link);
    }
    else print "<br>Записи отсутствуют";
?>