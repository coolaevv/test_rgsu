<?php

	session_start();
	require_once 'connecting_bd.php';

	if(isset($_FILES['file'])){
		$file_name = $_FILES['file']['name'];
		$uploadDIR = __DIR__.'/data/';
		$uploadfile = $uploadDIR.basename($_FILES['file']['name']);

		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		    $xml = simplexml_load_file('data/'.$file_name);
		    $attributes = $xml->attributes();
		    $users = $xml->User;

		    $arr_rewards = [];

		    foreach($users as $user){
		    	$name = (string)$user->attributes()->Name;
		    	$User_Pets = $user->Pets->Pet;

		    	foreach($User_Pets as $User_Pet){
			    	$Pet_Code = (string)$User_Pet->attributes()->Code;
				    $Pet_Type = (string)$User_Pet->attributes()->Type;
				    $Pet_Gender = (string)$User_Pet->attributes()->Gender;
				    $Pet_age = (string)$User_Pet->attributes()->Age;
				    $Pet_Name = (string)$User_Pet->Nickname->attributes()->Value;
				    $Pet_Breed = (string)$User_Pet->Breed->attributes()->Name;
				    $Rewards = $User_Pet->Rewards;

			    	$sql = "INSERT INTO `users`(`id`, `name`, `code`, `type`, `gender`, `age`, `nickname`, `breed`) 
			    	VALUES ('','$name','$Pet_Code','$Pet_Type','$Pet_Gender','$Pet_age','$Pet_Name','$Pet_Breed')";
			    	mysqli_query($link, $sql);

				    foreach($Rewards as $Reward){
				    	$Rewards_2 = $Reward->Reward;
				    	foreach($Rewards_2 as $Reward_2){
				    		$REWARDS = $Reward_2->attributes()->Name;
				    		array_push($arr_rewards, $REWARDS);
				    		$comma_separated = implode(",", $arr_rewards);
				    		$add_rewards = "UPDATE `users` 
				    		SET `rewards`='$comma_separated' WHERE `nickname` = '$Pet_Name'";
				    		mysqli_query($link, $add_rewards);
				    	}
				    }
		    	}
		    }
		    mysqli_close($link);
		    header("Location: index.php");
		}else {
		    echo "Возможная атака с помощью файловой загрузки!\n";
		}
	}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Загрузить данные</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<form action="" class="load-data" method="post"  enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit" name="submit" value="Загрузить">
	</form>
</body>
</html>

	<?php

?>