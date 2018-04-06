<?php

	class plikiTekstowe{
		
		public function czytaj($nazwaPliku){
			$tWiersz= array();
			if ($file = fopen($nazwaPliku, "r")) {
				while(!feof($file)) {
				
				$ileWierszy = count(file($nazwaPliku)); // -1
				
				for($i= 0; $i<$ileWierszy; $i++){
					$wiersz = fgets($file);
					$tWiersz[$i] = $wiersz;
				}
					
			}
				fclose($file);
		}
		return $tWiersz;
				
	}
	
	public function ileWierszy($nazwaPliku){
		if ($file = fopen($nazwaPliku, "r")) {
			
			$ileWierszy = count(file($nazwaPliku)); // -1
					
				fclose($file);
		}
		return $ileWierszy;
	}

}

?>

