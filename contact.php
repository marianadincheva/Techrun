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
			<a href="contact.php">Контакти</a> |
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

<?php 
	if(isset($_POST['submit'])){
		include 'connectDB.php';
		$name = $_POST['name'];
		$email = $_POST['email'];
		$msg = $_POST['message'];
		
		if($name == ""){ 
			echo "Трябва да попълните името!"; 
		}
		elseif($email == ""){ 
			echo "Трябва да попълните email-a";
		}
		elseif($msg == ""){
			echo "Не сте написали съобщение"; 
		}
		else{
	    	$msg2 = "$name Ви е изпратил следното съобщение:\n\n$msg\n\nЗа контакти: $email";
	    	if(mail(EMAIL, "test", $msg2)){
	      		echo "Съобщението е изпратено успешно";
	    	}
	    	else{ 
	    		echo "Съобщението не е изпратено успешно"; 
	    	}
	  	}
	}
?>