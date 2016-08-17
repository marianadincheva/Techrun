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
		
		<p>Индивидуален участник</p>
		<form action="singleRegistration.php" method="post">
			Име:
			<input type="text" name="firstName"><br>
			Фамилия:
			<input type="text" name="lastName"><br>
			Дата на раждане: 
			<input type="date" name="bday"><br>
			Пол:
			<input type="radio" name="sex" value="male">Мъж
			<input type="radio" name="sex" value="female">Жена<br>
			Email:
			<input type="email" name="email"><br>
			Телефон:
			<input type="text" name="phone"><br>
			Компания:
			<select>
				<?php
					include 'connectDB.php';
					$companies = mysql_query("SELECT DISTINCT `company` FROM `runners` ORDER BY `company`");
					
					while ($row = mysql_fetch_array($companies)){
				?>
	   				<option> <?php print $row['company'] ?> </option>
				
				<?php
					}
				?>			
			</select><br>	
			<input type="submit" name="submit" value="Изпращане">
		</form>
	</body>
</html>

<?php
	if(isset($_POST['submit'])){
		include 'connectDB.php'; 
		mysql_query("INSERT INTO `runners` (`first_name`, `last_name`, `birth_date`, `sex`, `email`, `phone`, `company`) 
			VALUES ('".$_POST['firstName']."', '".$_POST['lastName']."', '".$_POST['bday']."', '".$_POST['sex']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['companyName']."')" );
	}
?>