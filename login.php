<?php
	session_start();
	$mess = '<h1  class="title-form">Вход</h1>';
	if(isset($_POST['login']) && isset($_POST['pswd'])){
		$login = trim(htmlspecialchars($_POST['login']));
		$pswd = trim(htmlspecialchars($_POST['pswd']));

		if($login != '' && $pswd != ''){
			$_SESSION['user'] = $login;
			header("Location: import.php");
		}else{
			$mess = '<h1 class="error">Введите логин и пароль</h1>';
		}
	}

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Войти</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<form action="" class="login-form" method="post">
		<?php echo $mess; ?>
		<input type="text" name="login" placeholder="Логин">
		<input type="password" name="pswd" placeholder="Пароль">
		<input type="submit" name="submit" value="Войти">
	</form>
</body>
</html>
	<?php
?>