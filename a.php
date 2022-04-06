<?php
    date_default_timezone_set('Europe/Moscow');
    //Переменные
    $start_date = date_format(date_create($_PORT['start_date']), "Y-m-d H:i:s");
    $end_date = date_format(date_create($_PORT['end_date']), "Y-m-d H:i:s");
    
?>