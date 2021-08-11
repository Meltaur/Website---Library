<?php
session_start();
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
if(isset($_POST['zamien_reverse']))
					{
						unset($_SESSION['zamienianie']);
						header('Location:Twoja_Biblioteka.php');
					}
					else
					{
						header('Location: index.php');
					}
}					
}		
catch(Exeception $e)
{
				echo '<span style="color:red;">Błąd serwera! Prosimy o rejestrację w późniejszym terminie.</span>';	
}	
		
?>