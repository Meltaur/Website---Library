<!DOCTYPE html>
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
	<script type="text/javascript">
	
	function odliczanie()
	{
	var dzisiaj= new Date();
	var dzien= dzisiaj.getDate();
	var miesiac= dzisiaj.getMonth()+1;
	var rok= dzisiaj.getFullYear();
	var godzina= dzisiaj.getHours();
	if(godzina<10) godzina= "0"+godzina;
	var minuta= dzisiaj.getMinutes();
	if(minuta<10) minuta= "0"+minuta;
	var sekunda= dzisiaj.getSeconds();
	if(sekunda<10) sekunda= "0"+sekunda;
	document.getElementById("zegarek").innerHTML = 
	dzien+"/"+miesiac+"/"+rok+"|"+godzina+":"+minuta+":"+sekunda;
	setTimeout("odliczanie()",1000);
	}
	
	</script>
</head>
<body onload="odliczanie();">
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
			<div>
			<div id="zegarek"></div>
			</div>
			<div style="clear: both"></div>
		</div>
		<div id="content">
		<h1>Strona Główna</h1>
		Witam na stronie Moje książki. W zakładce "Twoja biblioteka" możesz zobaczyć swoją kolekcje.</br> W zakładce "Dodaj książkę" możesz dodawać pozycje do swojej biblioteki. Natomiast w zakładce "Statystyki" zobaczysz ciekawostki które nasz serwis zgromadził na temat twojego księgozbioru. 
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