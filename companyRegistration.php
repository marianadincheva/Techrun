<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Регистрация</title>
	</head>

	<body>
		<nav>
			<a href="singleRegistration.php">Индивидуална регистрация</a> |
			<a href="companyRegistration.php">Регистрация на отбор</a> |
			<a href="contact.php">Контакти</a> |
			<a href="rankings.php">Класиране</a>
		</nav>
		
		<p>Регистрация на отбор</p>
		<form action="teamRegistrationForm.php" method="post">
			Име на фирмата/организацията: 
			<input type="text" name="companyName"><br>
			Email:
			<input type="email" name="email"><br>
			Телефон за контакт:
			<input type="text" name="phone"><br>
			Сайт:
			<input type="text" name="website"><br>
			Лого:
			<input type="file" name="logo"><br>
			<input type="submit" name="submit" value="Изпращане">
		</form>
	</body>
</html>

<?php
	if(isset($_POST['submit'])){
		include 'connectDB.php'; 
		mysql_query("INSERT INTO `companies` (`name`, `email`, `phone`, `website`) 
			VALUES ('".$_POST['companyName']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['website']."')");
	}
?>