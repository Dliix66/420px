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

		$confirmKey = 'confirm';
		if (strlen($_POST[User::$nameKey]) == 0 || strlen($_POST[User::$tokenKey]) == 0 || strlen($_POST[$confirmKey]) == 0)
		{
			$errors = $errors."Fill in all the fields.</br>";
		}
		else if ($_POST[User::$tokenKey] !== $_POST[$confirmKey])
		{
			$errors = $errors."Passwords do not match.</br>";
		}
		else
		{
			$createError = $user->create($_POST[User::$nameKey], $_POST[User::$tokenKey]);
			if ($createError != null)
			{
				$errors .= $createError."<br>";
			}
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

		$htmlTxt = $htmlTxt."<form name=\"signup\" action=\"signup.php\" method=\"post\">";
		$htmlTxt = $htmlTxt."Name: <input type=\"text\" name=\"$nameKey\"/> <br/>";
		$htmlTxt = $htmlTxt."Password: <input type=\"password\" name=\"$tokenKey\"/> <br/>";
		$htmlTxt = $htmlTxt."Confirm: <input type=\"password\" name=\"confirm\"/> <br/>";
		$htmlTxt = $htmlTxt."<input type=\"submit\" value=\"Sign Up\"/>";
		$htmlTxt = $htmlTxt."</form>";
		$htmlTxt = $htmlTxt."<form name=\"login\" action=\"login.php\" method=\"get\"><input type=\"submit\" value=\"Login\"/></form>";
	}
?>

<html>
<head><title>SignUp</title></head>
<body>

	<?php
		echo $errors;
		echo $htmlTxt;
	?>

</body>