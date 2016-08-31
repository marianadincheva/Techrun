<?php
	include '../Database.php';
	$db = new Database;
	$query = "SELECT DISTINCT `company_id`, `name` FROM `companies` ORDER BY `name` ASC"; //@todo remove SQL
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
			<a href="companyRegistration.php">Регистрация на фирма</a>
		</nav>
		
		<p>Индивидуална регистрация</p>
		<form action="singleRegistrationProcess.php" method="post">
			Име:
			<input type="text" name="firstName" value="Hristo"><br>
			Фамилия:
			<input type="text" name="lastName" value="Tsvetkov"><br>
			Дата на раждане: 
			<input type="date" name="bday" value="1994-09-29"><br>
			Пол:
			<input type="radio" name="sex" value="M" checked="checked">Мъж
			<input type="radio" name="sex" value="F">Жена<br>
			Email:
			<input type="email" name="email" value="dreben_ji_1994@abv.bg"><br>
			Телефон:
			<input type="text" name="phone" value="0884341987"><br>
			Компания:
			<select name="companyId">
				<?php foreach ($companies as $company){ ?>
					<option value="<?php print $company['company_id']; ?>" <?php if($company['name'] == 'TechHuddle') print 'selected="selected"'?>> <?php print $company['name']; ?> </option>
				<?php } ?>			
			</select><br>	
			<input type="submit" name="submit" value="Изпращане">
		</form>
	</body>
</html>