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
			<div id="sort">
				<form action="allQuery.php" method="POST" id="sortingForm">
					<input type="radio" name="sortTask" id="r1" value="r1"/><label for="r1">Нет</label>
					<input type="radio" name="sortTask" id="r2" value="r2"/><label for="r2">По имени</label>
					<input type="radio" name="sortTask" id="r3" value="r3"/><label for="r3">По email</label>
					<input type="radio" name="sortTask" id="r4" value="r4"/><label for="r4">По статусу исполнения</label>
					<input type="submit" name="buttonSort" value="Отсортировать"/>
				<form>
			</div>
			<div id="showTasks">
				<?php
					$result = mysqli_query($CONNECT, "SELECT * FROM tasks $_SESSION[howSort]");
					$row = mysqli_fetch_array($result);
					if($row > 0){
						do{
							echo '
								<div id="showTask">
									Задача от <span>'.$row['name'].' </span>
									c email <span>'.$row['email'].'</span> : 
									<span>'.$row['text'].'</span> со статусом <span>'.$row['status'].' </span>
									<img src="'.$row['picture'].'" width="320" height="240"/>
								</div>
							';
						} while($row = mysqli_fetch_array($result));
					}
				?>
			</div>
		</div>
	</body>
	
</html>