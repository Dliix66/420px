<?php
	require_once('utils.php');

	$txt = "";
	$htmlTxt = "";
	$errors = "";

	$userId = -1;
	$user = new User();
	$connected = $user->resume();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		if (isset($_POST['reset']))
		{
			$user->logout();
			header("Refresh:0");
			exit();
		}

		if (isset($_FILES['file'])) // ADDING IMG
		{
			if ($_FILES['file']['error'] > 0) 					$errors .= "Erreur durant l'upload...";
			else if ($_FILES['file']['size'] > 104857600) 		$errors .= "Le fichier est trop gros... Taille maximale: 100Mo";
			else
			{
				$extensions_valides = array('jpg', 'jpeg', 'png');
				$extension = substr(strrchr($_FILES['file']['name'], '.'),1);
				$extension_upload = strtolower($extension);
				if (!in_array($extension_upload, $extensions_valides))
				{
					$errors .= "Fichier non supporté.";
				}
				else
				{
					// good file, move it
					$user->addImage($_FILES['file'], $_POST['tags'], $_POST['desc'], $extension);
					header('Location: index.php?id='.$user->id);
					exit();
				}
			}
		}
	}
	else if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if (isset($_GET['id']))
		{
			$userId = $_GET['id'];
		}
		if (isset($_GET['delete']))
		{
			$user->deleteImage($_GET['delete']);
			header('Location: index.php?id='.$userId);
			exit();
		}
	}


	$name = $user->name;
	$token = $user->token;
	if ($connected)
	{
		$txt = "Bonjour $name !</br>";
		$htmlTxt .= "$txt</br>";
		$htmlTxt .= "<form name=\"cookie\" action=\"index.php\" method=\"post\">";
		$htmlTxt .= "<input type=\"submit\" name=\"reset\" value=\"Déconnexion\"/></form>";
	}
	else
	{
		$htmlTxt .= "<form name=\"cookie\" action=\"login.php\" method=\"post\">";
		$htmlTxt .= "<input type=\"submit\" name=\"reset\" value=\"Login\"/></form>";
	}
?>

<html lang='en'>
	<head>
		<meta charset='utf-8'/>
		<title>420px</title>
		<link rel="stylesheet" type="text/css" href="index.css"/>
	</head>
	<body>
		<div class='header'>
			<div id='title'><h1><a href='index.php'><font color="red">420px</font></a></h1></div>
			<div id='search-bar'><?php echo $htmlTxt; ?></div>
		</div>
		<?php
			if (strlen($errors) > 0) echo $errors."<br><br>";

			if ($userId != -1)
			{
				$tmpUserName = Db::instance()->getUserFromId($userId)->name;

				echo "<p><center>Images uploaded by $tmpUserName :</center></p>";
			}
		?>
		<div class="images">
			<?php
				$images = Db::instance()->getImages($userId);
				foreach ($images as $value) {
					echo Image::getHtmlForImage($value, $connected, $user);
				}
			?>
		</div>
		<?php
			if ($connected)
			{
				$footer  = '<div class="footer"><form name="addImg" action="index.php" method="post" enctype="multipart/form-data">';
				$footer .= '<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />';
				$footer .= '<input type="file" name="file"/>';
				$footer .= '<input id="desc" placeholder="Description" name="desc">';
				$footer .= '<input id="tags" placeholder="Tags" name="tags">';
				$footer .= '<button class="addImg">Add New Image</button></div>';

				echo $footer;
			}
		?>
	</body>
</html>