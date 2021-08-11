<?php
session_start();
	if(isset($_POST['Ksiazka']))
	{
	$wszystko_ok=true;
		$id=$_SESSION['id'];
		$Nazwa_1=$_POST['Ksiazka'];
		if((strlen($Nazwa_1)<2) || (strlen($Nazwa_1))>50)
		{
			$wszystko_ok=false;
			$_SESSION['e_nazwa']="Nazwa musi posiadać od 2 do 50 znaków.";
		}
		
		$Autor_1=$_POST['Autor'];
		if((strlen($Autor_1)<2) || (strlen($Autor_1))>50)
		{
			$wszystko_ok=false;
			$_SESSION['e_autor']="Imię autora musi posiadać od 2 do 50 znaków.";
		}
		$Wydawnictwo_1=$_POST['Wydawnictwo'];
		if((strlen($Wydawnictwo_1)<2) || (strlen($Wydawnictwo_1))>50)
		{
			$wszystko_ok=false;
			$_SESSION['e_wydawnictwo']="Nazwa wydawnictwa musi posiadać od 2 do 50 znaków.";
		}
		
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
				if($wszystko_ok==true)
				{
					if($polaczenie->query("INSERT INTO ksiazki VALUES (NULL, '$id', '$Nazwa_1', '$Autor_1', '$Wydawnictwo_1')"))
					{
						$_SESSION['udane_dodanie']="Książka została dodana do biblioteki!";
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
			}
				$polaczenie->close();
		}
		catch(Exeception $e)
		{
		echo '<span style="color:red;">Błąd serwera! Prosimy o rejestrację w późniejszym terminie.</span>';	
		}
	}
    ?>
	
	
<!DOCTYPE HTML>
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
		<h1>Dodaj książkę</h1>
		<?php
		if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
		{
echo<<<END
		<div>
			<form method="post">
				<div id="float">
				<input type="text" class="Okno_rejestracji" name="Ksiazka" placeholder="Nazwa książki" onfocus="this.placeholder=''" onblur="this.placeholder='Nazwa książki'">
END;
					if(isset($_SESSION['e_nazwa']))
						{
							echo '<div class="error">'.$_SESSION['e_nazwa'].'</div>';
							unset($_SESSION['e_nazwa']);
						}
echo<<<END
				<input type="text" class="Okno_rejestracji" name="Autor" placeholder="Autor" onfocus="this.placeholder=''" onblur="this.placeholder='Autor'">
END;
					if(isset($_SESSION['e_autor']))
						{
							echo '<div class="error">'.$_SESSION['e_autor'].'</div>';
							unset($_SESSION['e_autor']);
						}
echo<<<END
				<input type="text" class="Okno_rejestracji" name="Wydawnictwo" placeholder="Wydawnictwo" onfocus="this.placeholder=''" onblur="this.placeholder='Wydawnictwo'">
END;
					if(isset($_SESSION['e_wydawnictwo']))
						{
							echo '<div class="error">'.$_SESSION['e_wydawnictwo'].'</div>';
							unset($_SESSION['e_wydawnictwo']);
						}
echo<<<END
				</div>
				<div style="clear: both"></div>
				</br><input type="submit" class="Przycisk_dodawania" name="Dodaj_książkę" value="Dodaj książkę">
			</form>
END;
	if(isset($_SESSION['udane_dodanie']))
						{
							echo '<div class="przywitanie">'.$_SESSION['udane_dodanie'].'</div>';
							unset($_SESSION['udane_dodanie']);
						}
		echo '</div>';

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