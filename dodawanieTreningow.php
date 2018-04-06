<?php

		session_start();
		require_once './class.baza.php';
		require_once './class.plikiTekstowe.php';
		
		if (!isset($_SESSION['zalogowany']))
			{
				header('Location:zaloguj.php');
				exit();
			}
	
		
		$db= new Baza();
		$pliki= new plikiTekstowe();
		$nazwa = 'dyscypliny.txt';
		$nazwaM = 'miejsce.txt';
		$czytaj=$pliki->czytaj($nazwa);
		$czytajM=$pliki->czytaj($nazwaM);
		$ileWierszy=$pliki->ileWierszy($nazwa);
		$ileWierszyM=$pliki->ileWierszy($nazwaM);
		
		echo 'Dostepnych dyscyplin: '.$ileWierszy.'<br /><br />';
		echo 'Dostepnych miejsc treningowych: '.$ileWierszyM.'<br /><br />';
		
		$_SESSION['dys1'] = $czytaj[0];
		$_SESSION['dys2'] = $czytaj[1];
		$_SESSION['dys3'] = $czytaj[2];
		$_SESSION['dys4'] = $czytaj[3];
		$_SESSION['dys5'] = $czytaj[4];
		$_SESSION['dys6'] = $czytaj[5];
		$_SESSION['dys7'] = $czytaj[6];
		$_SESSION['dys8'] = $czytaj[7];
		
		$_SESSION['msc1']= $czytajM[0];
		$_SESSION['msc2']= $czytajM[1];
		$_SESSION['msc3']= $czytajM[2];	
		
			if(isset($_POST['listaM'])){
				if(isset($_POST['lista'])){
					$listaM=$_POST['listaM'];
					$lista=$_POST['lista'];
					
					if($listaM=="0"){
						if($lista=="0"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys1']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="1"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys2']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="2"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys3']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="3"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys4']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="4"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys5']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="5"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys6']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="6"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys7']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
						else if($lista=="7"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys8']);
							$zapytanie->bindParam(5,$_SESSION['msc1']);
							$zapytanie->execute();
						}
					}
					else if($listaM=="1"){
							if($lista=="0"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys1']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="1"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys2']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="2"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys3']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="3"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys4']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="4"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys5']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="5"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys6']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="6"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys7']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
						else if($lista=="7"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys8']);
							$zapytanie->bindParam(5,$_SESSION['msc2']);
							$zapytanie->execute();
						}
					}
					else{
						if($lista=="0"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys1']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="1"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys2']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="2"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys3']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="3"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys4']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="4"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys5']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="5"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys6']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="6"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys7']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
						else if($lista=="7"){
							$sql="insert into ttreningi (id_student, id_trener, data,dyscyplina,miejsce) values((select id_student from tstudenci where nr_legitymacji=?),(select id_trener from ttrenerzy where nr_pracownika=?),?,?,?)";
							$zapytanie=$db->klient->prepare($sql);
							$zapytanie->bindParam(1,$_POST['ids']);
							$zapytanie->bindParam(2,$_POST['idt']);
							$zapytanie->bindParam(3,$_POST['data']);
							$zapytanie->bindParam(4,$_SESSION['dys8']);
							$zapytanie->bindParam(5,$_SESSION['msc3']);
							$zapytanie->execute();
						}
					}
				}
			}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Akademicki Zwiazek Sportowy</title>
	
</head>
<body>
	
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
	<br />Data treningu: <br /><input type="date"  name="data" required /><br />
	Dyscyplina <br /><select name="lista">
												<option value="0"><?php echo $_SESSION['dys1'] ?></option>
												<option value="1"><?php echo $_SESSION['dys2'] ?></option>
												<option value="2"><?php echo $_SESSION['dys3'] ?></option>
												<option value="3"><?php echo $_SESSION['dys4'] ?></option>
												<option value="4"><?php echo $_SESSION['dys5'] ?></option>
												<option value="5"><?php echo $_SESSION['dys6'] ?></option>
												<option value="6"><?php echo $_SESSION['dys7'] ?></option>
												<option value="7"><?php echo $_SESSION['dys8'] ?></option>
												</select><br /><br />
	Miejsce treningu: <br /><br /><select name="listaM">
												<option value="0"><?php echo $_SESSION['msc1'] ?></option>
												<option value="1"><?php echo $_SESSION['msc2'] ?></option>
												<option value="2"><?php echo $_SESSION['msc3'] ?></option>
												</select><br /><br />
	Podaj nr_legitymacji studenta<input type="text"  name="ids" required /><br />
	Podaj nr_pracownika trenera, którego chcesz dodac<input type="text"  name="idt" required /><br />

	<input type="submit" value="Dodaj" />
	</form>
	
	<?php
	echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><br />Anuluj - Powrót na stronę poprzednia</a>';
	?>
	
</body>
</html>