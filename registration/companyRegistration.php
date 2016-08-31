<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Регистрация</title>
	</head>

	<body>
		<nav>
			<a href="singleRegistration.php">Индивидуална регистрация</a> |
			<a href="companyRegistration.php">Регистрация на фирма</a>
		</nav>
		
		<p>Индивидуална регистрация</p>
		<form action="companyRegistrationProcess.php" method="post">
			Име на фирмата/организацията: 
			<input type="text" name="companyName" value="TechHuddle"><br>
			Email:
			<input type="email" name="email" value="hristo.tsvetkov@techhuddle.com"><br>
			Телефон за контакт:
			<input type="text" name="phone" value="0884341987"><br>
			Сайт:
			<input type="text" name="website" value="http://www.techhuddle.com/"><br>
			Лого:
			<input type="file" name="logo" value="Hristo"><br>
			<input type="submit" name="submit" value="Изпращане">
		</form>
	</body>
</html>