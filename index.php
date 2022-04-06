<html>
    <head>
        <title> Книга отзывов</title>
        <style>
        
        </style>
    </head>
    <body>
        <form action="b.php" method="post">
            Имя <br><input type="text" name="first_name"><br>
            Фамилия <br><input type="text" name="last_name"><br>
            Номер телефона <br><input type="text" name="phone"><br>
            <br><input type="submit" value="Отправить"><br>
            <br><textarea name="review" cols=32 rows=5></textarea><br>
        </form>
        <form action="a.php" method="post">
            <br><input type="datetime-local" name="start_date"><br>
            <br><input type="datetime-local" name="end_date"><br>
        </form>
    </body>
</html>