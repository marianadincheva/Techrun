<!DOCTYPE html>
<html>
	<head>
		<title>Rankings</title>
	</head>
	<body>
		<form action="generateRankings.php" method="post">
			<select name="rankingsType">
				<option value="male">Males</option>
				<option value="female">Females</option>
				<option value="company">Companies</option>
			</select>
			<input type="submit" name="Submit" value="Show">
		</form>
	</body>
</html>