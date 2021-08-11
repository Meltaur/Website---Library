<!DOCTYPE HTML>
<?php
session_start();
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
		<div id="logo">
		Moje książki
		</div>
		<div id="menu">
			<a href="index.php" class="tilelink">
				<div class="option" >Strona główna</div>
			</a>
			<a href="Twoja_biblioteka.php" class="tilelink">
				<div class="option">Twoja biblioteka</div>
			</a>
			<a href="Dodaj_książkę.php" class="tilelink">
				<div class="option">Dodaj książkę</div>
			</a>
			<div style="clear: both"></div>
		</div>
		<div id="content">
		<h1>Statystyki</h1>
		<?php
		if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
		{
			echo "Jesteś zalogowany!";
		}
		else
		{
		echo "Sekcja dostępna dla zalogowanych użytkowników.";
		}
	?>
		</div>
		<div id="Logowanie">
		<?php
		if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
		{
			echo '<div class="przywitanie">Witaj '.$_SESSION['Imie']."!</br>";
			echo '<a href="logout.php" class=tilelink_black>Wyloguj się</a></div>';
		}
		else
		{
echo<<<END
			<a href="Logowanie.php" class="tilelink">
			<div class="Przyciski" >Logowanie</div>
			</a>
			<a href="Rejestracja.php" class="tilelink">
			<div class="Przyciski" >Rejestracja</div>
			</a>
END;
		}
		?>
		</div>
		<div id="Reklama">
		Miejsce na reklamy
		</div>
		<div id="footer">
		Moje książki- twoja prywatna biblioteka, w sieci od 2018r. &copy;
		</div>
	</div>
</body>
</html> 	 