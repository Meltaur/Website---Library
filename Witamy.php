<!DOCTYPE HTML>
<?php
session_start();

if(!isset($_SESSION['udanarejestracja']))
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
		<h2>Dziękujemy za rejestrację w serwisie Moje Książki!</h2>
		<a href="Logowanie.php" class="tilelink_black">Zaloguj się</a></br>
		<a href="index.php" class="tilelink_black">Powrót do strony głównej</a></br>
		</div>
		
	</div>
</body>
</html> 	 