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
			<a href="contactForm.php">Контакти</a> |
			<a href="rankings.php">Класиране</a>
		</nav>
		
		<p>Регистрация на отбор</p>
		<form action="companyRegistration.php" method="post">
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
	require_once('connectDB.php');
	if(isset($_POST['submit'])) {
		//@check if empty;
		$db = new Database();
		//@combine columns and values
		/*[
			'name' => $_POST['companyName], 
			...
		]*/
		$columns = ["name", "email", "phone", "website"];
		$values = [$_POST['companyName'], $_POST['email'], $_POST['phone'], $_POST['website']];
		$db->insert("companies", $columns, $values);
	}
?>