<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="style_form.css" />
	<title>Форма обратной связи</title>
</head>
<body>
	<div class="container">
		<!-- <h1 align="center">Форма бронирования</h1> -->

		<form class = "darkgrey" action="fb.php" method="POST">
			<fieldset>
    			<legend>напишите нам</legend>

			 		<p>
		   				<input class = "newForm" type="text" name="feed_name" placeholder="ваше имя">
		   			</p>
		   			<p>
		   				<input class = "newForm" type="phone" name="feed_phone" min="6" max="10" placeholder="телефон" required>
		   			</p>
		   			<p>
		   				<input class = "newForm" type="email" name="feed_mail" placeholder="адрес электронной почты">
		   			</p>

		   			<p>
  						<textarea rows="10" cols="47" name="message" placeholder="ваше сообщение"></textarea>
		   			</p>
					
					<br>
		   			<input class = "btn" type="submit" value="отправить сообщение">

			</fieldset>

	  	</form>

	</div>

	
	
</body>
</html>