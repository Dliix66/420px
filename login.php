<?php

	require_once('utils.php');
	
	$txt = "";
	$htmlTxt = "";
	$errors = "";

	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		if (isset($_POST['reset']))
		{
			$user->logout();
			header("Refresh:0");
			exit();
		}

		if (strlen($_POST[User::$nameKey]) == 0 || strlen($_POST[User::$tokenKey]) == 0)
		{
			$errors = $errors."Fill in all the fields.</br>";
		}
		else if (!$user->login($_POST[User::$nameKey], $_POST[User::$tokenKey]))
		{
			$errors = $errors."Wrong username/password.</br>";
		}
	}
	else
	{
		$user->resume();
	}

	$hasCookie = isset($user->name);

	if ($hasCookie)
	{
		header('Location: index.php');
  		exit();
	}
	else
	{
		$nameKey = User::$nameKey;
		$tokenKey = User::$tokenKey;

		$htmlTxt = $htmlTxt."<form name=\"cookie\" action=\"login.php\" method=\"post\">";
		$htmlTxt = $htmlTxt."Name: <input type=\"text\" name=\"$nameKey\"/> <br/>";
		$htmlTxt = $htmlTxt."Password: <input type=\"password\" name=\"$tokenKey\"/> <br/>";
		$htmlTxt = $htmlTxt."<input type=\"submit\" value=\"Log In\"/>";
		$htmlTxt = $htmlTxt."</form>";
		$htmlTxt = $htmlTxt."<form name=\"signup\" action=\"signup.php\" method=\"get\"><input type=\"submit\" value=\"Sign Up\"/></form>";
	}
?>

<html>
<head><title>Login</title></head>
<body>

	<?php
		echo $errors;
		echo $htmlTxt;
	?>

</body>