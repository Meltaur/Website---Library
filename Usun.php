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
if(isset($_POST['usun']))
					{
						$idukryte=$_POST['hidden'];
						if($polaczenie->query("DELETE FROM ksiazki WHERE id='$idukryte'"))
							{
								header('Location: Twoja_biblioteka.php');
							}
						else
							{
								throw new Exception($polaczenie->error);
							}
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