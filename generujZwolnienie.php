<?php
	session_start();
	
	if(isset($_POST['imie'])){ //wykonanie po naciśnięciu submit, bez względu na to czy dane sa poprawne - tutaj je sprawdzimy
		
		$poprawnosc = true; //ustawienie flagi - jeśli cokolwiek bedzie zle, zmiana na false
		$pattern = '#^[a-ż]+$#i';	//wyrazenia regularne - z zakresu [a-ż] i wielkość liter nie ma znaczenie
		
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
		
		$data_urodzenia=$_POST['data_urodzenia'];
		
		$telefon=$_POST['telefon'];
		if((is_numeric($telefon)==false)||(strlen($telefon)!=9)){ //zakładamy, że poprawna długość telefonu to 9
			$poprawnosc = false;
			$_SESSION['error_telefon']= 'Niepoprawny numer telefonu';
		}
		
		$kierunek_studiow=$_POST['kierunek_studiow'];
		if(preg_match($pattern, $nazwisko)==false){ 
			$poprawnosc = false;
			$_SESSION['error_kierunekstudiow']= 'Niepoprawne znaki';
		}
		
		$email=$_POST['email'];
		$emailSprawdzony = filter_var($email, FILTER_SANITIZE_EMAIL); //na zmienna, nie zawiera ewentualnych niepoprawnych znaków z $email, np. polskie znaki,.\]
		if((filter_var($emailSprawdzony, FILTER_VALIDATE_EMAIL)==false) || ($emailSprawdzony!=$email)){ //$emailSprawdzony nie waliduje sie lub emailSprawdzony rózny od email, ze wzgledu na usuniete niedozwolone znaki
			$poprawnosc = false;
			$_SESSION['error_email']= 'Niepoprawny adres email';
		}
		
		$legitymacja=$_POST['legitymacja'];
		if((is_numeric($legitymacja)==false)||(strlen($legitymacja)!=6)){ //zakładamy, że poprawna długość nr legitymacji to 6
			$poprawnosc = false;
			$_SESSION['error_legitymacja']= 'Niepoprawny numer legitymacji';
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
		
		if (!isset($_POST['regulamin']))
		{
			$poprawnosc=false;
			$_SESSION['error_regulamin']="Nie zatwierdzono regulaminu";
		}	
		
		//Zapamiętane dane, wyswietlane po jakims bledzie
		$_SESSION['zap_imie'] = $imie;
		$_SESSION['zap_nazwisko'] = $nazwisko;
		$_SESSION['zap_dateurodzenia'] = $data_urodzenia;
		$_SESSION['zap_telefon'] = $telefon;
		$_SESSION['zap_kierunekstudiow'] = $kierunek_studiow;
		$_SESSION['zap_email'] = $email;
		$_SESSION['zap_legitymacja'] = $legitymacja;
		$_SESSION['zap_haslo1'] = $haslo1;
		$_SESSION['zap_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) //jezeli checkbox jest zaznaczony
			$_SESSION['zap_regulamin'] = true;
		
		
		if($poprawnosc==true){

		require_once './class.baza.php';
		$db= new Baza();
	
		
		//$haslo=sha1($_POST['haslo1']);


		$sql='select * from tstudenci where nr_legitymacji=?';
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->bindParam(1,$_POST['legitymacja']);
		$zapytanie->execute();
		if($zapytanie->rowCount()!=0){
			echo 'Istnieje już konto na ten numer legitymacji...<br />';
			echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Powrót</a>';
			exit;
		}


		$sql="insert into tuzytkownicy (login,haslo,uprawnienia) values ('".$_POST['legitymacja']."','".(sha1($_POST['haslo1']))."','0')";
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->execute();
		
		$sql="insert into tstudenci (id_uzytkownik, nr_legitymacji, imie, nazwisko, data_urodzenia, telefon, kierunek_studiow, email) values
		((select id_uzytkownik from tuzytkownicy where login=?),?,?,?,?,?,?,?)";
		$zapytanie=$db->klient->prepare($sql);
		$zapytanie->bindParam(1,$_POST['legitymacja']);
		$zapytanie->bindParam(2,$_POST['legitymacja']);
		$zapytanie->bindParam(3,$_POST['imie']);
		$zapytanie->bindParam(4,$_POST['nazwisko']);
		$zapytanie->bindParam(5,$_POST['data_urodzenia']);
		$zapytanie->bindParam(6,$_POST['telefon']);
		$zapytanie->bindParam(7,$_POST['kierunek_studiow']);
		$zapytanie->bindParam(8,$_POST['email']);
		$zapytanie->execute();		
	}	
	else
		{
			header('Location:rejestracjaStudent.php');
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
		
		Data urodzenia: <br /><input type="date" value="<?php
			if (isset($_SESSION['zap_dateurodzenia']))
			{
				echo $_SESSION['zap_dateurodzenia'];
				unset($_SESSION['zap_dateurodzenia']);
			}
		?>" name="data_urodzenia" placeholder="Podaj datę urodzenia..." required/> np. 1995-12-25<br>
		
		<?php
			if(isset($_SESSION['error_dataurodzenia'])){ 
				echo '<div class="error">'.$_SESSION['error_dataurodzenia'].'</div>'; 
				unset($_SESSION['error_dataurodzenia']); 
			}
		?>
		
		Telefon: <br /><input type="number" value="<?php
			if (isset($_SESSION['zap_telefon']))
			{
				echo $_SESSION['zap_telefon'];
				unset($_SESSION['zap_telefon']);
			}
		?>" name="telefon" placeholder="Podaj telefon..." required/><br>
		
		<?php
			if(isset($_SESSION['error_telefon'])){ 
				echo '<div class="error">'.$_SESSION['error_telefon'].'</div>'; 
				unset($_SESSION['error_telefon']); 
			}
		?>
		
		Kierunek studiów: <br /><input type="text" value="<?php
			if (isset($_SESSION['zap_kierunekstudiow']))
			{
				echo $_SESSION['zap_kierunekstudiow'];
				unset($_SESSION['zap_kierunekstudiow']);
			}
		?>" name="kierunek_studiow" placeholder="Podaj kierunek studiów..." required/><br>
		
		<?php
			if(isset($_SESSION['error_kierunekstudiow'])){ 
				echo '<div class="error">'.$_SESSION['error_kierunekstudiow'].'</div>'; 
				unset($_SESSION['error_kierunekstudiow']); 
			}
		?>
		
		E-mail: <br /><input type= "email" value="<?php
			if (isset($_SESSION['zap_email']))
			{
				echo $_SESSION['zap_email'];
				unset($_SESSION['zap_email']);
			}
		?>" name= "email" placeholder="Podaj email..." required /><br>
		<?php
			if(isset($_SESSION['error_email'])){ 
				echo '<div class="error">'.$_SESSION['error_email'].'</div>'; 
				unset($_SESSION['error_email']); 
			}
		?>
		Nr legitymacji: <br /><input type= "text" value="<?php
			if (isset($_SESSION['zap_legitymacja']))
			{
				echo $_SESSION['zap_legitymacja'];
				unset($_SESSION['zap_legitymacja']);
			}
		?>" name="legitymacja" placeholder="Podaj nr legitymacji..." required/><br>
		<?php
			if(isset($_SESSION['error_legitymacja'])){ 
				echo '<div class="error">'.$_SESSION['error_legitymacja'].'</div>'; 
				unset($_SESSION['error_legitymacja']); 
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
		
		<label>
			<input type="checkbox"  value="<?php
			if (isset($_SESSION['zap_regulamin']))
			{
				echo $_SESSION['zap_regulamin'];
				unset($_SESSION['zap_regulamin']);
			}
		?>" name="regulamin" />Akceptuje <a href="regulamin.pdf"><u>regulamin</u></a>
		</label>
		<?php
			if (isset($_SESSION['error_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['error_regulamin'].'</div>';
				unset($_SESSION['error_regulamin']);
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