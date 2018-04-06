<?php

require_once 'class.pdf.php';
require_once 'class.baza.php';


$db=new Baza();
$pdf=new PDF();
$pdf->AddPage();
$rozmiary=array(10,30,30,30,30,50);
$pdf->Wiersz($rozmiary[0],$rozmiary[1],$rozmiary[2],$rozmiary[3],$rozmiary[4],$rozmiary[5]);
$pdf->Output('I');


?>
