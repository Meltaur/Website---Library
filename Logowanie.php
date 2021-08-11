<!DOCTYPE HTML>
<?php
session_start();

if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
{
	header('Location: index.php');
	exit();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="Description" content="Prywatna biblioteka">
	<meta name="Keywords" content="Książąki">
	<meta name="Author" content="Wojciech Fierek">
	<title>Moje książki</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
	<div id="container">
		<div id="Logowanie2">
		<form action="Serwer.php" method="post">
		<input type="text" name="L_Login" class="Okno_logowania" placeholder="Login" onfocus="this.placeholder=''" onblur="this.placeholder='Login'">
		<input type="password" name="L_Haslo" class="Okno_logowania" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'">
		<input type="submit" value="Zaloguj się" class="Przycisk_logowania">
		</form>
		<a href="index.php" class="tilelink_black">Powrót do strony głównej</a></br>
		Nie posiadasz konta? <a href="Rejestracja.php" class="tilelink_black">Zarejestruj się!</a>
<?php
		if(isset($_GET['msg']) && $_GET["msg"] == 'failed')
		{	
			echo $_SESSION['blad'];
		}
?>
		</div>
		
	</div>
</body>
</html> 	 