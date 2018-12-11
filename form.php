<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="style_form.css" />
	<title>Форма бронирования</title>
</head>
<body>
	<div class="container">
		<!-- <h1 align="center">Форма бронирования</h1> -->

		<form class = "darkgrey" action="check_reserv.php" method="POST">
			<fieldset>
    			<legend>Бронирование</legend>

					<p> 
						<select class = "newForm check" name="room_name" required>
							<option selected value="0">Выберите тип номера</option>
							<option value="single">Single</option>
			  				<option value="double">Double</option>
			  				<option value="delux">Delux</option>
							<option value="family">Family</option>
							<option value="royal">Royal</option>
							<option value="appartment">Appartment</option>
						</select>
			 		</p>

					<p> 
						<select class = "newForm check" name="adult" required>
							<option selected value="0">Выберите количество взрослых</option>
							<option value="1">1</option>
			  				<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
			 		</p>
			 		<p> 
						<select class = "newForm check" name="child" required>
							<option selected value="0">Выберите количество детей</option>
							<option value="0">Без детей</option>
							<option value="1">1</option>
			  				<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
			 		</p> 
			 		<p>
			 			<br>
			 			Дата заезда:
			 		</p>
			 		<p>
						<input class = "newForm" type="date" name="date_in" required>
			 		</p> 
			 		<p>
			 			Дата выезда:
			 		</p>
			 		<p>
						<input class = "newForm" type="date" name="date_out" required>
			 		</p>
			 		<p>
			 			<br>
			 			Ваши данные:
			 		</p>
			 		<p>
		   				<input class = "newForm" type="text" name="guest_name" placeholder="Ваше имя">
		   			</p>
		   			<p>
		   				<input class = "newForm" type="text" name="guest_surname" placeholder="Ваша фамилия">
		   			</p>
		   			<p>
		   				<input class = "newForm" type="phone" name="guest_phone" min="6" max="10" placeholder="Телефон" required>
		   			</p>
		   			<p>
		   				<input class = "newForm" type="email" name="guest_mail" placeholder="Адрес электронной почты">
		   			</p>
					
					<br>
		   			<input class = "btn" type="submit" value="Забронировать">

			</fieldset>

	  	</form>

	</div>

	
	
</body>
</html>