<!DOCTYPE html>
<html>

	<head>
		<title>Приложение-задачник</title>
		<link rel="stylesheet" href="style.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="js.js"></script>
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
			<form action="allQuery.php" method="POST" enctype="multipart/form-data" id="addTask">
				<input type="text" name="name" id="name" placeholder="Ваше имя" required />
				<input type="email" name="email" id="email" placeholder="Ваш email" required />
				<p>Текст задачи:</p>
				<textarea name="task" id="task"></textarea>
				<p>Картинка:</p>
				<input type="file" name="picture" id="picture"/>
				<input type="submit" name="add" id="add"/>
			</form>
			<button id="show">Предварительный просмотр</button>
			<div id="hidden">
				Задача от <span id="hiddenName"></span>
				с email <span id="hiddenEmail"></span>
				c содержанием: <span id="hiddenTask"></span>
				<button id="close">Закрыть</button>
			</div>
		</div>
	</body>
	
</html>