<?php 
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
?>