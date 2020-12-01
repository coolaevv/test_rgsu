<?php
	session_start();
	require_once 'connecting_bd.php';
	if (isset($_SESSION['user'])){
		$sql = "SELECT `id`, `name`, `code`, `type`, `gender`, `age`, `nickname`, `breed`, `rewards` 
		FROM `users` WHERE `age` > '3'";
		$query = mysqli_query($link, $sql);
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Просмотр данных</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<a href="logout.php">Выйти</a>
	<div class="container">
		<?php
			foreach($query as $item){
				?>
				<div class="card-body">
					<div class="name">
						<?php echo $item['name']; ?>
					</div>
					<div class="pets">
						<?php echo '<div class="item">Питомец: '.$item['type'].'</div>'; ?>
						<?php echo '<div class="item">Пол: '.$item['gender'].'</div>'; ?>
						<?php echo '<div class="item">Возраст: '.$item['age'].'</div>'; ?>
						<?php echo '<div class="item">Кличка: '.$item['nickname'].'</div>'; ?>
						<?php echo '<div class="item">Порода: '.$item['breed'].'</div>'; ?>
						<?php echo '<div class="item">Достижения: '.$item['rewards'].'</div>'; ?>
					</div>
				</div>
				<?php
			}
		?>
	</div>

</body>
</html>
		<?php
		mysqli_close($link);
	}else{
		header("Location: login.php");
	}
?>