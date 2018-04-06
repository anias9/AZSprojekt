<?php
	session_start();
	
	if(isset($_POST['imie'])){ //wykonanie po naciśnięciu submit, bez względu na to czy dane sa poprawne - tutaj je sprawdzimy
		
		$poprawnosc = true; //ustawienie flagi - jeśli cokolwiek bedzie zle, zmiana na false
		$pattern = '#^[a-ż]+$#i';	//wyrazenia regularne - z zakresu [a-ż] i wielkość liter nie ma znaczenie
		$kod='waznykod';
		$imie=$_POST['imie'];
		
		if((strlen($imie)<3) || (strlen($imie)>15)){
			$poprawnosc = false;
			$_SESSION['error_imie']= 'Imie musi miec dlugosc z przedzialu od 3 do 15 liter';
		}
		
		if(preg_match($pattern, $imie)==false){ 
			$poprawnosc = false;
			$_SESSION['error_imie']= 'Niepoprawne znaki';
		}
		
		$nazwisko=$_POST['nazwisko'];
		if(preg_match($pattern, $nazwisko)==false){ 
			$poprawnosc = false;
			$_SESSION['error_nazwisko']= 'Niepoprawne znaki';
		}
		
		
		$legitymacja=$_POST['legitymacja'];
		if((is_numeric($legitymacja)==false)||(strlen($legitymacja)!=6)){ //zakładamy, że poprawna długość nr legitymacji to 6
			$poprawnosc = false;
			$_SESSION['error_legitymacja']= 'Niepoprawny numer pracownika';
		}
		
		$kod=$_POST['kod'];
		if($_POST['kod']!= $kod){
			$poprawnosc = false;
			$_SESSION['error_kod']= 'Niepoprawny kod!';
		}
		
		$haslo1=$_POST['haslo1'];
		$haslo2=$_POST['haslo2'];
		if(strlen($haslo1)<8 || strlen($haslo1)>30){
			$poprawnosc=false;
			$_SESSION['error_haslo1']= 'Podane haslo musi mieć od 8 do 30 znakow ';
		}
		
		if($haslo1!=$haslo2){
			$poprawnosc=false;
			$_SESSION['error_haslo2']= 'Podane hasla sa rozne!';
		}
		
	
		
		//Zapamiętane dane, wyswietlane po jakims bledzie
		$_SESSION['zap_imie'] = $imie;
		$_SESSION['zap_nazwisko'] = $nazwisko;
		$_SESSION['zap_legitymacja'] = $legitymacja;
		$_SESSION['zap_haslo1'] = $haslo1;
		$_SESSION['zap_haslo2'] = $haslo2;

		
		if($poprawnosc==true){

		require_once './class.baza.php';
		$db= new Baza();
	
		
		//$haslo=sha1($_POST['haslo1']);


		$sql='select * from ttrenerzy where nr_pracownika=?';
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->bindParam(1,$_POST['legitymacja']);
		$zapytanie->execute();
		if($zapytanie->rowCount()!=0){
			echo 'Istnieje już konto na ten numer pracownika...<br />';
			echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Powrót</a>';
			exit;
		}


		$sql="insert into tuzytkownicy (login,haslo,uprawnienia) values ('".$_POST['legitymacja']."','".(sha1($_POST['haslo1']))."','1')";
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->execute();
		
		$sql="insert into ttrenerzy (id_uzytkownik, nr_pracownika, imie, nazwisko) values
		((select id_uzytkownik from tuzytkownicy where login=?),?,?,?)";
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->bindParam(1,$_POST['legitymacja']);
		$zapytanie->bindParam(2,$_POST['legitymacja']);
		$zapytanie->bindParam(3,$_POST['imie']);
		$zapytanie->bindParam(4,$_POST['nazwisko']);
		$zapytanie->execute();		
		
		if($zapytanie->rowCount()!=0){
			echo 'Zarejestrowano poprawnie <br />';	
		}
	}
	
	else
		{
			header('Location:rejestracjaTrener.php');
			exit();
		}
	}
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Akademicki Zwiazek Sportowy</title>
	
	<style> 
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
		Imie: <br /><input type="text" value="<?php	//jezeli jest ustawiona wartosc zapamietana, to wystwietl, a nastepnie zwolnij pamiec
			if (isset($_SESSION['zap_imie']))
			{
				echo $_SESSION['zap_imie'];
				unset($_SESSION['zap_imie']);
			}
		?>" name="imie" placeholder="Podaj imię..." required /><br />
		
		<?php
			if(isset($_SESSION['error_imie'])){ //zmienna sesyjna o nazwie error_imie
				echo '<div class="error">'.$_SESSION['error_imie'].'</div>'; //wypisanie komunikatu o bledzie
				unset($_SESSION['error_imie']); //zwolnienie pamieci dla niepoprawnego imienia
			}
		?>
		
		Nazwisko: <br /><input type="text" value="<?php
			if (isset($_SESSION['zap_nazwisko']))
			{
				echo $_SESSION['zap_nazwisko'];
				unset($_SESSION['zap_nazwisko']);
			}
		?>" name="nazwisko" placeholder="Podaj nazwisko..." required/><br>
		
		<?php
			if(isset($_SESSION['error_nazwisko'])){ 
				echo '<div class="error">'.$_SESSION['error_nazwisko'].'</div>'; 
				unset($_SESSION['error_nazwisko']); 
			}
		?>
		
		
		Nr pracownika: <br /><input type= "text" value="<?php
			if (isset($_SESSION['zap_legitymacja']))
			{
				echo $_SESSION['zap_legitymacja'];
				unset($_SESSION['zap_legitymacja']);
			}
		?>" name="legitymacja" placeholder="Podaj nr pracownika..." required/><br>
		<?php
			if(isset($_SESSION['error_legitymacja'])){ 
				echo '<div class="error">'.$_SESSION['error_legitymacja'].'</div>'; 
				unset($_SESSION['error_legitymacja']); 
			}
		?>
		
		Kod otrzymany podczas zebrania trenerów: <br /><input type= "password" 
		name="kod" placeholder="Podaj kod..." required/><br>
		<?php
			if(isset($_SESSION['error_kod'])){ 
				echo '<div class="error">'.$_SESSION['error_kod'].'</div>'; 
				unset($_SESSION['error_kod']); 
			}
		?>

		Hasło: <br /><input type= "password" value="<?php
			if (isset($_SESSION['zap_haslo1']))
			{
				echo $_SESSION['zap_haslo1'];
				unset($_SESSION['zap_haslo1']);
			}
		?>" name="haslo1" placeholder="Podaj haslo..." required/><br>
		<?php
			if(isset($_SESSION['error_haslo1'])){ 
				echo '<div class="error">'.$_SESSION['error_haslo1'].'</div>'; 
				unset($_SESSION['error_haslo1']); 
			}
		?>
		
		Powtorz hasło: <br /><input type="password" value="<?php
			if (isset($_SESSION['zap_haslo2']))
			{
				echo $_SESSION['zap_haslo2'];
				unset($_SESSION['zap_haslo2']);
			}
		?>" name="haslo2" placeholder="Powtorz haslo..." required/><br>
		<?php
			if(isset($_SESSION['error_haslo2'])){ 
				echo '<div class="error">'.$_SESSION['error_haslo2'].'</div>'; 
				unset($_SESSION['error_haslo2']); 
			}
		?>
		
		<br /><input type="submit" value="Zarejestruj" /><br />
			<input type="reset" value="Zresetuj" /><br>
	</form>
	
	<?php
	echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><br />Anuluj - Powrót na stronę głowną</a>';
	?>
	
</body>
</html>