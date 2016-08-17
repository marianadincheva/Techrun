<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Контакти</title>
	</head>

	<body>
		<nav>
			<a href="singleRegistration.php">Индивидуална регистрация</a> |
			<a href="companyRegistration.php">Регистрация на отбор</a> |
			<a href="contactForm.php">Контакти</a> |
			<a href="rankings.php">Класиране</a>
		</nav>
		
		<p>Пишете ни с въпроси или коментари</p>
		<form action="contact.php" method="post">
			Вашето име:
			<input type="text" name="name"><br>
			Email:
			<input type="email" name="email"><br>
			Съобщение:
			<textarea name="message" rows="4" cols="50"></textarea><br>
			<input type="submit" name="submit" value="Изпращане">
		</form>	
	</body>
</html>

