<?php 
	include 'Database.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['message'];
	
	if($name == ""){ 
		echo "Трябва да попълните име."; 
	}
	elseif($email == ""){ 
		echo "Трябва да попълните email.";
	}
	elseif($msg == ""){
		echo "Не сте написали съобщение."; 
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
?>