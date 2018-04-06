<?php

session_start();

if(isset($_SESSION['zalogowany'])){
	header('Location: panelStudent.php');
}

if(isset($_POST['login']))
	$login=$_POST['login'];
if(isset($_POST['haslo'])) 
	$haslo=sha1($_POST['haslo']);

$sql='select * from tuzytkownicy where login=? and haslo=?'; 
$zapytanie=$db->prepare($sql);
$zapytanie->bindParam(1,$login);
$zapytanie->bindParam(2,$haslo);
$zapytanie->execute();
if ($zapytanie->rowCount()==1){
	$dane=$zapytanie->fetch();
	echo 'Zalogowano poprawnie jako <b> '.$_SESSION['imie'].' '.$_SESSION['nazwisko'].'<br />';
	echo '<a href="./panelStudent.php">Przejdź do strony</a> | <a href="./wyloguj.php">Wyloguj</a>';
} else {
	
	echo 'Błąd logowania, spróbuj ponownie<br />';
	echo '<a href="./logujStudent.php">Zaloguj</a>';
}
?>