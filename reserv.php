<?php include 'header.php'; ?>

  <div class="reserv_container">
    <?php 

      $link = mysqli_connect("localhost", "root", "root", "test_database");

      mysqli_set_charset($link,'utf8');

        // $link = mysqli_connect("localhost", "uskov_project1_2018_2", "LokzNGLA", "uskov_project1_2018_2");

            if (!$link) {
                echo "<p style=\"color=\"red\"\"><i><strong>Ошибка: Невозможно установить соединение с MySQL.</strong></i>" . PHP_EOL;
                echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }

            echo "<i><strong>Соединение с MySQL установлено! </strong></i>" . PHP_EOL;
            echo "<br>";
            echo "<br>";

            $SQL_get_rooms = "SELECT DISTINCT `name`, `capacity_adult`, `capacity_child` FROM `rooms`";

          //выполнение запроса
            $query = mysqli_query($link, $SQL_get_rooms);

            if ($result = $query) {

                /* извлечение ассоциативного массива */
                while ($row = mysqli_fetch_assoc($result)) {
                  $results[] = $row;
                }
               /* удаление выборки */
                // mysqli_free_result($result);
            }


            // echo "<hr>";
            for ($i=0; $i <= count($results); $i++) { 
              print_r($results[$i]);
              echo '<br>';
            }
            
            echo("<p>Конец служебной области</p><hr>")
            ?>

            <!-- // ============================ форма бронирования =============================== -->

            <form class = "form_reserv" method="POST">
            <h2>БРОНИРОВАНИЕ НОМЕРА</h2>

              <!-- <fieldset> -->
                <!-- <legend>Бронирование</legend> -->
                  
                  <p>
                    <strong>Выберите тип номера:</strong>
                  </p>
                  <p> 
                    <select class = "row_reserv check_reserv" name="room_name">
                      <option selected value="single">Single</option>
                      <option value="double">Double</option>
                      <option value="delux">Delux</option>
                      <option value="family">Family</option>
                      <option value="royal">Royal</option>
                      <option value="appartment">Appartment</option>
                    </select>
                  </p>
                  <br> 
                  <p>
                   <strong> Укажите количество гостей:</strong>
                  </p>

                  <p> 
                    <select class = "row_reserv check_reserv" name="adult">
                      <option selected value="1">Взрослых</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                  </p>
                  <p> 
                    <select class = "row_reserv check_reserv" name="child">
                      <option selected value="0">Детей</option>
                      <option value="0">Без детей</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                  </p>
                  <br> 
                  <p>
                    <strong>Даты пребывания:</strong>
                    <br>
                  </p>
                  <p class="p_small">
                    Заезд:
                  </p>
                  <p class="p_small">
                    <input class = "row_reserv_small" type="date" name="date_in" required>
                  </p> 
                  <p class="p_small">
                    Выезд:
                  </p>
                  <p>
                    <input class = "row_reserv_small" type="date" name="date_out" required>
                  </p>
                  <br>
                  <p>
                    <strong>Ваши данные:</strong>
                  </p>
                  <p>
                    <input class = "row_reserv" type="text" name="guest_name" placeholder= "Ваше имя">
                  </p>
                  <p>
                    <input class = "row_reserv" type="text" name="guest_surname" placeholder="Ваша фамилия">
                  </p>
                  <p>
                    <input class = "row_reserv" type="phone" name="guest_phone" min="6" max="10" placeholder="Телефон" required>
                  </p>
                  <p>
                    <input class = "row_reserv" type="email" name="guest_mail" placeholder="Адрес электронной почты" required>
                  </p>
            
                  <br>
                  <input class = "btn_reserv" type="submit" value="забронировать">

              <!-- </fieldset> -->

            </form>

            <?php 

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
            $SQL_insert_query = "INSERT INTO `reserved`(`id`, `room_name`, `date_in`, `date_out`, `adult`, `child`, `guest_name`, `guest_surname`, `guest_phone`, `guest_mail`, `club_card`, `description`) VALUES ('0', '$room_name', '$date_in', '$date_out', '$adult', '$child', '$guest_name', '$guest_surname', '$guest_phone', '$guest_mail', '0', '0')";

            // ========= пременные для отправки подтверждения на почту =================
            $to = $_POST['guest_mail'];
            // "lakeresort@yandex.ru"; // емайл получателя данных из формы 
            $subject = "Благодарим Вас за бронирование номера"; // тема полученного емайла 
            $message = "Благодарим Вас за бронирование номера";
            $headers  = 'MIME-Version: 1.0' . "\r\n"; // заголовок соответствует формату плюс символ перевода строки
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // указывает на тип посылаемого контента
            // =========

// ======================= проверка возможности размещения по кол-ву гостей ==================================
     
            for ($i=0; $i <= count($results); $i++) { 
              if ($results[$i]['name'] == $room_name) {
                if (!empty($_POST) and $adult <= $results[$i]['capacity_adult'] and $child <= $results[$i]['capacity_child']) {
                  // =========  бронирование ========================
                  if ($date_out > $date_in and $date_in >= $today) {
                    $insert_reserv = mysqli_query($link, $SQL_insert_query);
                  }
                  else {
                    if (!empty($_POST)) {
                      echo "Выберите другие даты пребывания <br>";
                      break;

                    }
                    // echo "Выберите другие даты пребывания <br>";
                  // echo "<a href=\"form.php\">Вернуться к форме бронирования</a>";
                  }
                  // =========  бронирование ========================
                  echo "<h2>Ураааааа, можно бронировать</h2>";
                }
                else
                  if (!empty($_POST))
                    echo "<h2>К сожалению размещение гостей в таком количестве в выбранном номере невозможно</h2>"; 
                }
            }             
// ================================================================================

            if ($insert_reserv) {
              echo "<h2>Сервер сообщает что добавление прошло успешно </h2><br>";
              mail($to, $subject , $message, $headers); 
            }
              
            

            // foreach ($results as $key => $arr) {
            //   foreach ($arr as $key1 => $value) {
            //     if ($arr['name'] == $room_name)
            //       echo "<h2>Ураааааа</h2>"; 
            //     }
            //     // echo($arr[$value]) ."<br>";
            //     // echo "<h2>Ураааааа</h2>";
            //     }
              
              // echo $value. " <br>";
              // if ($key == $room_name) {
              //   echo "<h2>Ураааааа</h2>";
              //   echo($value);
              
            

            // print_r($results['capacity_adult']);

            // echo $room_name;

            // $check = $results[2]['name'];
            // echo $check;

             ?>








  </div>
<?php include 'footer.php'; ?>
  