<?php
	include_once('db_connect.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<title>Приложение-задачник</title>
		<link rel="stylesheet" href="style.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	</head>
	<body>
		<div id="menu">
			<ul>
				<li><a href="index.php">Добавить задачу</a></li>
				<li><a href="admin.php">Вход</a></li>
				<li><a href="listTasks.php">Список задач</a></li>
			</ul>
		</div>
		<div id="content">
			<div id="admin">
				<form action="allQuery.php" method="POST" id="enterAdmin">
					<input type="text" name="adminName" id="adminName" placeholder="Ваш логин"/>
					<input type="password" name="adminPassword" id="adminPassword" placeholder="Ваш пароль"/>
					<input type="submit" name="enter" id="buttonEnter" value="Войти"/>
				<form>
			</div>
			<div id="notCheckedTask">
				<?php
					if($_SESSION['admin']){
						$tasksForCheck = mysqli_query($CONNECT, "SELECT * FROM tasks");
						$row = mysqli_fetch_array($tasksForCheck);
						do {
							if($row['status'] == 1) $checked = 'checked';
							else $checked = '';
							echo '
								<div id="notChecked">
									<form action="allQuery.php" method="POST">
										Задача от <span>'.$row['name'].'</span>
										c email <span>'.$row['email'].'</span> : 
										<textarea name="checkedText">'.$row['text'].'</textarea>
										<input type="checkbox" name="check" id="check" value="1" '.$checked.'/>
										<label for="check">Проверено</label>
										<input type="text" name="id"  id="idTask" value="'.$row['id'].'"/>
										<input type="submit" name="buttonCheck" id="buttonCheck" value="Внести изменения"/>
									</form>
								</div>
							';
						}while($row = mysqli_fetch_array($tasksForCheck));
					}
				?>
			</div>
		</div>
	</body>
	
</html>