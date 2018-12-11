<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Подключение к БД</title>
</head>
<body>


        <?php

        // ====================== подключение ==========================

        // $link = mysqli_connect("localhost", "root", "root", "test_database");

        $link = mysqli_connect("localhost", "uskov_project1_2018_2", "LokzNGLA", "uskov_project1_2018_2");


        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        echo "Соединение с MySQL установлено!" . PHP_EOL;
        // echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;

        echo "<br>";

        // $str_SQL = "SELECT * FROM `rooms` WHERE name = 'double'";

        //выполнение запроса
        // $query = mysqli_query($link, $str_SQL);




        // if ($result = $query) {

        //     /* извлечение ассоциативного массива */
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         print_r($row);
        //         echo '<br>';
        // //     }

        //     /* удаление выборки */
        //     mysqli_free_result($result);
        // }

        echo '<hr>';

        // $query = mysqli_query($link, "SELECT name, number
        // FROM `rooms`
        // WHERE  price < '700000'
        // and not EXISTS (SELECT * FROM `reserved` 
        // WHERE rooms.id = reserved.id)");



// ========================= константы ============================

        $room_name = $_POST['room_name'];
        $adult = $_POST['adult'];
        $child = $_POST['child'];
        $date_in = $_POST['date_in'];
        $date_out = $_POST['date_out'];
        $guest_name = $_POST['guest_name'];
        $guest_surname = $_POST['guest_surname'];
        $guest_phone = $_POST['guest_phone'];
        $guest_mail = $_POST['guest_mail'];

        $today = date("Y-m-d"); 

        $insert_query = "INSERT INTO `reserved`(id, room_name, date_in, date_out, adult, child, guest_name, guest_surname, guest_phone, guest_mail, club_card, description) VALUES ('0', '$room_name', '$date_in', '$date_out', '$adult', '$child', '$guest_name', '$guest_surname', '$guest_phone', '$guest_mail', '0', '0')";

        $check_query = "SELECT COUNT(*) FROM `reserved` WHERE room_name = '$room_name' and (date_in >= '$date_out' or date_out <= '$date_in')";

       
        // ниже запрос номеров, которые свободны в указанные даты, но его нужно доработать
        $check_vacancy = "SELECT * FROM `reserved` WHERE date_in >= '$date_out' or date_out <= '$date_in'";

  
        echo "<hr>";

// ======================= запросы ============================


// ======================== проверка даты =============================

        $check_date = mysqli_query($link, $check_query);

        print_r($check_date);

        $ans = mysqli_fetch_assoc($check_date);
        print_r($ans[current_field]);

        // $answer = mysqli_fetch_assoc($check_date); 
        // print_r($answer[current_field]);
        // echo '<br>';
        



        // $query_room_id = mysqli_query($link, "SELECT `id` FROM `rooms` WHERE name = '$room_name'");

        // if ($result = $query_room_id) {

        //     /* извлечение ассоциативного массива */
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         print_r($row['id']);
        //         echo '<br>';
        //     }

        //     /* удаление выборки */
        //     mysqli_free_result($result);
        // }

// ================================ раскоментить! ======================

        if ($date_out > $date_in and $date_in >= $today) {
            $insert_reserv = mysqli_query($link, $insert_query);
                }
        else {
            echo "Выберите другие даты пребывания <br>";
            // echo "<a href=\"form.php\">Вернуться к форме бронирования</a>";
        }


        if ($insert_reserv) {
            echo "Сервер сообщает что добавление прошло успешно <br>";
            mail("krudda@yandex.ru", "Подтверждение бронирования", "Бронирование прошло успешно!");
                if (mail)
                    echo "Письмо отправлено <br>";
                
        }
        else {
            echo "Сервер сообщает об ошибке добавления данных";
            echo "<br> <a href=\"form.php\">Вернуться к форме бронирования</a>";
        }

        echo "<br>";

// ===================================================================

        // if ($check_date != 0)
        //     echo "<hr> Номер занят в эти даты";

        



        // if ($result = $insert_reserv) {

        //     while ($row = mysqli_fetch_assoc($result)) {
        //         print_r($row['id']);
        //         echo '<br>';
        //     }

        //     /* удаление выборки */
        //     mysqli_free_result($result);



        //print_r($row);

        mysqli_close($link);
        ?>

        <hr>


        <a href="form.php">Вернуться к форме бронирования</a>

    </body>
</html>
