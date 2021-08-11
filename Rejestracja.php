<?php
	session_start();
	if(isset($_POST['Email']))
	{
	$wszystko_ok=true;

		$nick=$_POST['Login'];
		if((strlen($nick)<3) || (strlen($nick))>20)
		{
			$wszystko_ok=false;
			$_SESSION['e_nick']="Login musi posiadać od 3 do 20 znaków.";
		}
	
		if(ctype_alnum($nick)==false)
		{
			$wszystko_ok=false;
			$_SESSION['e_nick']="Login musi składać się tylko z liter i cyfr(bez polskich znaków).";
		}
		
		$email=$_POST['Email'];
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email!=$emailB))
		{
			$wszystko_ok=false;
			$_SESSION['e_email']="Podaj poprawny adres email.";
		}
		$haslo1=$_POST['Has1o1'];
		$haslo2=$_POST['Haslo2'];
		if((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_ok=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków.";
		}
		if($haslo1!=$haslo2)
		{
			$wszystko_ok=false;
			$_SESSION['e_haslo']="Podane hasła różnią się.";
		}
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		$sekret= "6LdvYVgUAAAAAF9keEFtdEyBX4ol0GJLhzk841vq";
		$sprawdz= file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		$odpowiedz= json_decode($sprawdz);
		if($odpowiedz->success==false)
		{
			$wszystko_ok=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem.";
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
				$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				if(!$rezultat) throw new Exception($polaczenie->error);
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_ok=false;
					$_SESSION['e_email']="Istnieje już konto pod podanym emailem.";
				}
				$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE Login='$nick'");
				if(!$rezultat) throw new Exception($polaczenie->error);
				$ile_takich_loginow = $rezultat->num_rows;
				if($ile_takich_loginow>0)
				{
					$wszystko_ok=false;
					$_SESSION['e_nick']="Podany login jest już zajęty.";
				}
				
				
					if($wszystko_ok == true)
					{
						
						if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$email', '$haslo_hash')"))
						{
							$_SESSION['udanarejestracja']=true;
							header('Location: Witamy.php');
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
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


<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="Description" content="Prywatna biblioteka">
	<meta name="Keywords" content="Książki">
	<meta name="Author" content="Wojciech Fierek">
	<title>Moje książki</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
		<h1>Rejestracja</h1>
			<form method="post">
			<div id="float">
				<input type="text" class="Okno_rejestracji" name="Login" placeholder="Login" onfocus="this.placeholder=''" onblur="this.placeholder='Login'">
					<?php
					if(isset($_SESSION['e_nick']))
						{
							echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
							unset($_SESSION['e_nick']);
						}
					?>
				<input type="text" class="Okno_rejestracji" name="Email" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'">
				<?php
					if(isset($_SESSION['e_email']))
						{
							echo '<div class="error">'.$_SESSION['e_email'].'</div>';
							unset($_SESSION['e_email']);
						}
				?>
				<input type="password" class="Okno_rejestracji" name="Has1o1" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'">
				<?php
					if(isset($_SESSION['e_haslo']))
						{
							echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
							unset($_SESSION['e_haslo']);
						}
				?>
				<input type="password" class="Okno_rejestracji" name="Haslo2" placeholder="Powtórz hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Powtórz Hasło'">
				<div class="g-recaptcha" data-sitekey="6LdvYVgUAAAAAEvu452IINsosF_rISnFr4MqJ0MU"></div>
				<?php
					if(isset($_SESSION['e_bot']))
						{
							echo '<div class="error1">'.$_SESSION['e_bot'].'</div>';
							unset($_SESSION['e_bot']);
						}
				?>
				</div>
				<div style="clear: both"></div>
				<div>
				<input type="submit" class="Przycisk_rejestracji" name="Zarejestruj_sie" value="Zarejestruj się">
				</div>	
			</form>
		</div>
		<div id="Logowanie">
		<?php
			if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
		{
			echo "Witaj ".$_SESSION['Imie']."!</br>";
			echo '<a href="Logout.php">Wyloguj się</a>';
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
		Miejsce na reklamy.
		</div>
		<div id="footer">
		Moje książki- twoja prywatna biblioteka, w sieci od 2018r. &copy;
		</div>
	</div>
</body>
</html> 	 