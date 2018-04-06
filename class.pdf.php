<?php

require_once './fpdf.php';

class PDF extends FPDF{

	function Header(){
	$this->AddFont('ArialPL','','arial.php'); 
	$this->AddFont('ArialPL','B','arialbd.php');
	$this->SetFont('ArialPL','B',12);
	$this->Cell(0,7,'Data wygenerowania: '.date('d-m-Y').'r.');
	$this->Ln(15);
}

	function Naglowek($rozm1,$rozm2,$rozm3, $rozm4, $rozm5, $rozm6){
		$this->SetFont('ArialPL','B',14);
		$this->SetTextColor(0,255,0);
		$this->SetFillColor(0,0,0);
		$this->Cell($rozm1,7,'Lp.',1,0,'C', true);//1 - obramowanie, 0 - nie przechodzimy do kolejnej linii, C - wycentrowanie
		$this->Cell($rozm2,7,'Student',1,0,'C', true);
		$this->Cell($rozm3,7,'Trener',1,0,'C', true);//1 - obramowanie, 1 - przechodzimy do kolejnej linii, C - wycentrowanie
		$this->Cell($rozm4,7,'Data',1,0,'C', true);
		$this->Cell($rozm5,7,'Dyscyplina',1,0,'C', true);
		$this->Cell($rozm6,7,'Miejsce',1,1,'C', true);
	}
	
	
	function Wiersz($rozm1,$rozm2,$rozm3, $rozm4, $rozm5, $rozm6){

		$db=new Baza();
		$sql = "select s.nazwisko as 'student', t.nazwisko as 'trener',data,dyscyplina,miejsce 
		from ttreningi w join tstudenci s on w.id_student=s.id_student join ttrenerzy t on w.id_trener=t.id_trener";
		$zapytanie=$db->klient->query($sql);
		$lp=1;
		$this->Naglowek($rozm1,$rozm2,$rozm3, $rozm4, $rozm5, $rozm6);
		$this->SetFont('ArialPL','',11);
		$this->SetTextColor(0,0,0);
		
		while($dane=$zapytanie->fetch()){
			if($lp%2==0)
				$this->SetFillColor(255,255,255);
			else
				$this->SetFillColor(200,200,200);
				
		$this->Cell($rozm1,7,$lp,1,0,'C', true);
		$this->Cell($rozm2,7,iconv('UTF-8','WINDOWS-1250',$dane['student']),1,0,'L', true);
		$this->Cell($rozm3,7,iconv('UTF-8','WINDOWS-1250',$dane['trener']),1,0,'L', true);
		$this->Cell($rozm4,7,$dane['data'],1,0,'L', true);
		$this->Cell($rozm5,7,iconv('UTF-8','WINDOWS-1250',$dane['dyscyplina']),1,0,'L', true);
		$this->Cell($rozm6,7,$dane['miejsce'],1,1,'L', true);
			$lp++;
		}
	}
	
	function Footer(){
	$this->AliasNbPages('{razem}');
	$this->SetFont('ArialPL','',10);
	$this->SetY(-15);
	$this->Cell(0,7,'Strona '.$this->PageNo().' z {razem}',0,0,'C');
}

}