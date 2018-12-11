<?php
$to = $_POST['feed_mail'];
// "lakeresort@yandex.ru"; // емайл получателя данных из формы 

$subject = "Форма обратной связи на PHP"; // тема полученного емайла 

$message = $_POST['message'];
$headers  = 'MIME-Version: 1.0' . "\r\n"; // заголовок соответствует формату плюс символ перевода строки
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // указывает на тип посылаемого контента


mail($to, $subject , $message, $headers); //отправляет получателю на емайл значения переменных

echo "<a href=\"feedback.php\">Вернуться к форме обратной связи</a>";
?>