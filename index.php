<html>
    <head>
        <title> Книга отзывов</title>
        <style>
            div.format{
                font-size: 20pt;
            }
            div.review
            {
                font-size: 20pt;
                position: absolute;
                top: 50%;
                left: 35%;
                margin-right: -50%;
                transform: translate(-50%, -50%)
            }
            div.request
            {
                font-size: 20pt;
                position: absolute;
                top: 37%;
                left: 70%;
                margin-right: -50%;
                transform: translate(-50%, -50%)
            }
            input[type=datetime-local]
            {
                border-radius: 7px;
                font-size: 15pt;
                height: 50px;
                width: 350px;
            }
            input[type=submit]
            {
                border-radius: 7px;
                font-size: 15pt;
                height: 40px;
                width: 150px;
            }
            input[type=text]
            {
                border-radius: 7px;
                font-size: 15pt;
                height: 50px;
                width: 350px;
            }
        </style>
    </head>
    <body>
        <div class="format">
        <br> Вводите имя и фамилию кириллицей с большой буквы <br>
        Номер телефона вводите начиная с +7 или 8 без пробелов<br>
        </div>
        <form action="b.php" method="post">
            <div class="review">
            Имя <br><input type="text" name="first_name"><br>
            Фамилия <br><input type="text" name="last_name"><br>
            Номер телефона <br><input type="text" name="phone"><br>
            <br><input type="submit" value="Отправить"><br>
            Ваш отзыв <br><textarea name="review" cols=32 rows=5></textarea><br>
        </div>
        </form>
        <div class="request">
        <form action="a.php" method="post">
            Посмотреть отзывы других пользователей <br>
            за выбранный промежуток<br><input type="datetime-local" name="start_date"><br>
            <br><input type="datetime-local" name="end_date"><br>
            <br><input type="submit" value="Отправить"><br>
        </form>
        </div>
    </body>
</html>