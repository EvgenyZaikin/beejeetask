<?php

	include_once('db_connect.php');

	if($_POST['add']){
		$name = strip_tags($_POST['name']);
		$email = strip_tags($_POST['email']);
		$task = strip_tags($_POST['task']);
		$pictureFile = $_FILES['picture'];
		
		$pictureExtension = array_pop(explode('.', $pictureFile['name']));
		if($pictureExtension == 'jpg' || $pictureExtension == 'gif' || $pictureExtension == 'png'){
			$directory = 'picture/';
			$newName = time().'.'.$pictureExtension;
			$in = dirname(__FILE__).'/'.$direcory.$newName;
			if(!is_dir($in)){
				mkdir(dirname($in));
			}
			
			if($pictureExtension == 'jpg'){
				$source = imagecreatefromjpeg($pictureFile['tmp_name']);
			} else if($pictureExtension == 'gif'){
				$source = imagecreatefromgif($pictureFile['tmp_name']);
			} else if($pictureExtension == 'png'){
				$source = imagecreatefrompng($pictureFile['tmp_name']);
			}
			$widthSource = imagesx($source);
			$heightSource = imagesy($source);
			if($widthSource > 320){
				$newPicture = imagecreatetruecolor(320, 240);
				imagecopyresampled($newPicture, $source, 0, 0, 0, 0, 320, 240, $widthSource, $heightSource);
				if($pictureExtension == 'jpg'){
					$pictureFile['tmp_name'] = imagejpeg($newPicture, $in);
					imagedestroy($source);
					imagedestroy($newPicture);
				}else if($pictureExtension == 'gif'){
					$pictureFile['tmp_name'] = imagegif($newPicture, $in);
					imagedestroy($source);
					imagedestroy($newPicture);
				}else if($pictureExtension == 'png'){
					$pictureFile['tmp_name'] = imagepng($newPicture, $in);
					imagedestroy($source);
					imagedestroy($newPicture);
				}
			} else {
				if($pictureExtension == 'jpg'){
					$pictureFile['tmp_name'] = imagejpeg($source, $in);
					imagedestroy($source);
				} else if($pictureExtension == 'gif'){
					$pictureFile['tmp_name'] = imagegif($source, $in);
					imagedestroy($source);
				}else if($pictureExtension == 'png'){
					$pictureFile['tmp_name'] = imagepng($source, $in);
					imagedestroy($source);
				}
			}
	
			move_uploaded_file($pictureFile['tmp_name'], $in);
			$picture = $newName;
		} else $picture = '';
		
		mysqli_query($CONNECT, "INSERT INTO tasks VALUES(NULL, '$name', '$email', '$task', '$picture', 0)");
		header('Location:index.php');
	}
	
	if($_POST['enter']){
		$admin = strip_tags($_POST['adminName']);
		$password = strip_tags($_POST['adminPassword']);
		
		$check = mysqli_query($CONNECT, "SELECT * FROM admin WHERE name='$admin' AND password='$password'");
		if(mysqli_fetch_array($check) > 0){
			$_SESSION['admin'] = true;
		}

		header('Location:admin.php');
	}
	
	if($_POST['buttonCheck']){
		$checkedText = strip_tags($_POST['checkedText']);
		$status = $_POST['check'];
		
		mysqli_query($CONNECT, "UPDATE tasks SET text='$checkedText', status='$status' WHERE id='$_POST[id]'");
	}
	
	if($_POST['buttonSort']){
		$choice = $_POST['sortTask'];
		if($choice == 'r1') $_SESSION['howSort'] = '';
		else if($choice == 'r2') $_SESSION['howSort'] = 'ORDER BY name';
		else if($choice == 'r3') $_SESSION['howSort'] = 'ORDER BY email DESC';
		else if($choice == 'r4') $_SESSION['howSort'] = 'ORDER BY status DESC';
		
		header('Location:listTasks.php');
	}
?>