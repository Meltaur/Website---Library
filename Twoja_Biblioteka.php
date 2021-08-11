<!DOCTYPE HTML>
<?php 
session_start();
if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
{
$id= $_SESSION['id'];
require_once "Connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{					
			$polaczenie= new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie-> connect_errno != 0)
				{
					throw new Exception(mysqli_connect_errno());
				}
			else
			{
				if ($wynik = $polaczenie->query("SELECT * FROM ksiazki WHERE id_u='$id'"))
					{
						$ile_ksiazek = $wynik->num_rows;
					}
					$polaczenie->close();
			}
		}
		catch(Exeception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Prosimy o rejestrację w późniejszym terminie.</span>';	
			}
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
	<link rel="stylesheet" href="css/fontello.css" type="text/css"/>
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
		<h1>Twoja Biblioteka</h1>
<?php
		if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
		{
			if($ile_ksiazek==0)
			{
				echo 'Twoja biblioteka jest pusta. Dodaj pozycje w zakładcę "Dodaj książkę"';
			}
			else
			{
			$i=$ile_ksiazek;
			for ($i = 1; $i <= $ile_ksiazek; $i++)
				{
					$row = mysqli_fetch_assoc($wynik);
					$indeks=$row['id'];
					$a1 = $row['Nazwa'];
					$a2 = $row['Autor'];
					$a3 = $row['Wydawnictwo'];
	if(isset($_SESSION['zamienianie']) && ($_SESSION['zamienianie']==true) && ($indeks==$_SESSION['idkafelka']))
	{
echo<<<END
	<div class="biblioteka">
		<div class="tekst">
		$i.</br>
		<form method="post" action="Zamiana.php">
		<div class="Zamiana">
		<input type="text" value="$a1" name="NazwaZ" class="Okna_updatu"></br>
		<input type="text" value="$a2" name="AutorZ" class="Okna_updatu"></br>
		<input type="text" value="$a3" name="WydawnictwoZ" class="Okna_updatu"></br>
		<input type="hidden" name="hidden" value="$indeks">
		</div>
		<input type="submit" value="Dokonaj zmian" class="Przycisk_zamiany" name="Zamiana">
		</form>
		</div>
		<form method="post" action="Zamien_reverse.php">
		<input type="hidden" name="hidden" value="$indeks">
		<input type="submit" class="nic_zielone" value="&#xe801;" style="font-family:fontello;" name="zamien_reverse"> 
		</form>
END;
		unset($_SESSION['zamienianie']);
	}
	else
	{
echo<<<END
				<div class="biblioteka">
				<div class="tekst">
				$i.</br>
				Tytuł: $a1</br>
				Autor: $a2</br>
				Wydawnictwo: $a3</br>
				</div>
			<form method="post" action="Zamien.php">
			<input type="hidden" name="hidden" value="$indeks">
			<input type="submit" class="nic_zielone" value="&#xe801;" style="font-family:fontello;" name="zamien"> 
			</form>
END;
	}
echo<<<END
		<form method="post" action="Usun.php">
			<input type="hidden" name="hidden" value="$indeks">
			<input type="submit" class="nic_czerwone" value="&#xe800;" style="font-family:fontello;" name="usun"> 
		</form>
		</div>
END;
				}
			}
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