<?php
session_start();
if((!isset($_POST['L_Login'])) || (!isset($_POST['L_Haslo'])))
{
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit();
}
require_once "Connect.php";
try
{
$polaczenie= new mysqli($host, $db_user, $db_password, $db_name);
if($polaczenie-> connect_errno != 0)
{
	throw new Exception(mysqli_connect_errno());
}
else
{
	$login = $_POST['L_Login'];
	$haslo = $_POST['L_Haslo'];
	$login = htmlentities($login, ENT_QUOTES, "UTF-8"); 
	
	if($rezultat = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE Login='%s' ",
	mysqli_real_escape_string($polaczenie,$login))))
	{
		 $ilu_userow = $rezultat->num_rows;
		 if($ilu_userow>0)
		 {
			 $wiersz= $rezultat->fetch_assoc();
			 if(password_verify($haslo, $wiersz['Haslo']))
			 {
				 $_SESSION['zalogowany']= true;
				 $_SESSION['id'] = $wiersz['id'];
				 $_SESSION['Imie'] = $wiersz['Login'];
				 unset($_SESSION['blad']);
				 $rezultat->free_result();
				 header('Location:'.$_SERVER['HTTP_REFERER']);
			 }
			 else
			{
				$_SESSION['blad']= '<span style="color:red">Niepoprawny login lub haslo!</span>';
				header('Location: Logowanie	.php?msg=failed');	
			}
		 }
		 
		 else
		{
				$_SESSION['blad']= '<span style="color:red">Niepoprawny login lub haslo!</span>';
				header('Location: Logowanie	.php?msg=failed');
				
		}
	}
	
	$polaczenie->close();
}
}
catch(Exeception $e)
		{
		echo '<span style="color:red;">Błąd serwera! Prosimy o rejestrację w późniejszym terminie.</span>';	
		}


?>