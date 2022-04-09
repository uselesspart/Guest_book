<?php
    date_default_timezone_set('Europe/Moscow'); //Часовой пояс - Москва
    //Переменные
    $start_date = date_format(date_create($_POST['start_date']), "Y-m-d H:i:s");
    $end_date = date_format(date_create($_POST['end_date']), "Y-m-d H:i:s");
    $link = mysqli_connect("localhost", "root", "","reviews"); 
    $link->set_charset("utf8"); //Устанавливаем кодировку
    $sql = "SELECT id, first_name, last_name, phone, review, time FROM users WHERE(time > '$start_date' AND time < '$end_date')";
    $result = mysqli_query($link, $sql);
    $database = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $table = array(array());
    echo '<div class=container1>';
    echo '<form action = "index.php" method = "post">';
    //Кнопка "Назад"
    echo '<input type="button" value="Назад" onclick="history.back()">';
    echo '</form>';
    //Заполнение массива для таблицы
    if(count($database) == 0) print '<br>Не найдено запросов в выбранный временной промежуток<br>';
    else{
    $n = $database[count($database)-1]['id'] - $database[0]['id']+1;    //Вычисляем количество найденных отзывов
    for($i = 0; $i < $n; $i++){
        $table[$i][1] = $database[$i]['first_name'];
        $table[$i][2] = $database[$i]['last_name'];
        $table[$i][3] = $database[$i]['phone'];
        $table[$i][4] = $database[$i]['review'];
        $table[$i][5] = $database[$i]['time'];
    }
    //Отрисовка таблицы
    echo '<table border = "1"';
    echo '<tr><td>IP</td><td>System</td><td>Host</td><td>Page</td><td>Time</td>';
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
?>