<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Класиране</title>
		
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>

	<body>
		<nav>
			<a href="singleRegistration.php">Индивидуална регистрация</a> |
			<a href="companyRegistration.php">Регистрация на отбор</a> |
			<a href="contactForm.php">Контакти</a> |
			<a href="rankings.php">Класиране</a>
		</nav>
		<table>
			<tr>
				<th>№</th>
				<th>Име</th>
				<th>Фамилия</th> 
				<th>Точки</th>
			</tr>
			
			<?php 
				include 'connectDB.php'; 
				$result = mysql_query("SELECT `first_name`, `last_name`, `points` FROM `runners`ORDER BY `points` DESC");
				
				$index = 1;

				while ($row = mysql_fetch_array($result)) {
			?>
					<tr>
						<td><?php print $index?></td>
						<td><?php print $row['first_name']?></td>
						<td><?php print $row['last_name']?></td> 
						<td><?php print $row['points']?></td>
					</tr>
			<?php
				$index = $index + 1;
				}
			?>
		</table>
		<br>
		<table>
			<tr>
				<th>№</th>
				<th>Компания</th>
				<th>Точки</th> 
				<th>Лого</th>
			</tr>
			
			<?php 
				include 'connectDB.php'; 
				$result = mysql_query("SELECT `name`, `logo`, `points` FROM `companies` ORDER BY `points` DESC");

				$index = 1;

				while ($row = mysql_fetch_array($result)) {
			?>
					<tr>
						<td><?php print $index?></td>
						<td><?php print $row['name']?></td>
						<td><?php print $row['points']?></td> 
						<td><?php print $row['logo']?></td>
					</tr>
			<?php
				$index = $index + 1;
				}
			?>
		</table>
	</body>
</html>


