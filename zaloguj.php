<?php
require_once './class.baza.php';

session_start();

$db=new Baza();

if (isset($_POST['legitymacja']) && isset($_POST['haslo']))
	{
		$login=$_POST['legitymacja'];
		$haslo=sha1($_POST['haslo']);
		$sql="select uprawnienia from tuzytkownicy where login='".$_POST['legitymacja']."' and haslo='".sha1(($_POST['haslo']))."'";
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->execute();
		

		if ($zapytanie->rowCount()==1){
			
			$dane=$zapytanie->fetch();
			
			$_SESSION['zalogowany']=true;
			if(!($plik=fopen('./log/log.txt','a')))
			echo 'Błąd zapisu do pliku logowania';
		
			$txt=date('d-m-Y H:i:s').' logowanie poprawne - '.$login."\n";
			fwrite($plik,$txt);
			
			switch($dane['uprawnienia'])
			{
				case '0':
					header('Location:panelStudent.php');

					exit();
				break;
				case '1':
					header('Location:panelTrener.php');
					
					exit();
				break;
			}
		}
		else{
			
			echo 'Nieprawidłowy login lub haslo!';
			echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><br />Powrót</a>';
			
			if(!($plik=fopen('./log/log.txt','a')))
			echo 'Błąd zapisu do pliku logowania';
		
			$txt=date('d-m-Y H:i:s').' LOGOWANIE NIEPOPRAWNE - '.$login."\n";
			fwrite($plik,$txt);
			
		}
		fclose($plik);
	}

	
?>