<?php
	require_once('utils.php');

	$txt = "";
	$htmlTxt = "";
	$errors = "";

	$imgId = -1;
	$img = null;
	$user = new User();
	$connected = $user->resume();

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if (isset($_GET['id']))
		{
			$imgId = $_GET['id'];
			$img = new Image($imgId);

			if (isset($_GET['filtre']) && is_numeric($_GET['value']))
			{
				switch ($_GET['filtre']) {
					case 'gris':
						$img->grayScale();
						break;

					case 'luminosite':
						$img->brightness($_GET['value']);
						break;

					case 'contraste':
						$img->contrast($_GET['value']);
						break;

					case 'opacite':
						$img->opacity($_GET['value']);
						break;

					case 'flou':
						$img->blur($_GET['value']);
						break;

					case 'sepia':
						$img->sepia();
						break;

					case 'contours':
						$img->edgeDetect();
						break;
					
					default:
						header('Location: index.php');
						exit();
				}
			}
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	else
	{
		header('Location: index.php');
		exit();
	}
	
	if (!$connected || $imgId == -1 || $img == null || $img->obj == null || $img->obj->userId != $user->id)
	{
		header('Location: index.php');
		exit();
	}


	$name = $user->name;
	$token = $user->token;

	$txt = "Bonjour $name !</br>";
	$htmlTxt .= "$txt</br>";
	$htmlTxt .= "<form name=\"cookie\" action=\"index.php\" method=\"post\">";
	$htmlTxt .= "<input type=\"submit\" name=\"reset\" value=\"Déconnexion\"/></form>";
?>

<html lang='en'>
	<head>
		<meta charset='utf-8'/>
		<title>Edit Image</title>
		<link rel="stylesheet" type="text/css" href="index.css"/>
	</head>
	<body>
		<div class='header'>
			<div id='title'><h1><a href='index.php'><font color="red">420px</font></a></h1></div>
			<div id='search-bar'><?php echo $htmlTxt; ?></div>
		</div>
		<?php
			if (strlen($errors) > 0) echo $errors."<br><br>";
		?>
		<div class="images">
			<?php
				echo Image::getHtmlForImage($img->obj, $connected, $user);
			?>
		</div>
		<form action="edit.php" method="get">
			<label>Filtre:</label>
			<select name="filtre">
				<option value="gris">Gris</option>
				<option value="contraste">Contraste</option>
				<option value="luminosite">Luminosité</option>
				<option value="sepia">Sepia</option>
				<option value="opacite">Opacité</option>
				<option value="flou">Flou</option>
				<option value="contours">Contours</option>
			</select>
			<br>
			<label>Valeur:</label>
			<input type="number" name="value" min="-100" max="100" value="0"></input>
			<br>
			<input type="hidden" name="id" value=<?php echo "$imgId" ?>>
			<input type="submit" value="Appliquer le filtre !">
		</form>
	</body>
</html>