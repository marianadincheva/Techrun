<?php
	include 'Database.php';
	$db = new Database;
	$query = "SELECT DISTINCT `name` FROM `companies` ORDER BY `name` ASC"; //@todo remove SQL
	$companies = $db->sendQuery($query);
?>
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
		
		<p>Индивидуален участник</p>
		<form action="singleRegistrationProcess.php" method="post">
			Име:
			<input type="text" name="firstName" value="Hristo"><br>
			Фамилия:
			<input type="text" name="lastName" value="Tsvetkov"><br>
			Дата на раждане: 
			<input type="date" name="bday" value="12.12.2006"><br>
			Пол:
			<input type="radio" name="sex" value="M">Мъж
			<input type="radio" name="sex" value="F">Жена<br>
			Email:
			<input type="email" name="email" value="hristo@email.com"><br>
			Телефон:
			<input type="text" name="phone" value="012345"><br>
			Компания:
			<select name="companyName">
				<?php foreach ($companies as $company){ ?>
					<option> <?php print $company['name'] ?> </option>
				<?php } ?>			
			</select><br>	
			<input type="submit" name="submit" value="Изпращане">
		</form>
	</body>
</html>