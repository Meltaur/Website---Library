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
if(isset($_POST['zamien']))
					{
						$_SESSION['zamienianie']=true;
						$idukryte=$_POST['hidden'];
						$_SESSION['idkafelka']=$idukryte;
						header('Location: Twoja_biblioteka.php');
						$polaczenie->close();
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