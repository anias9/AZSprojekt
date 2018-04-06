<?php

class Baza {
	const DNS='mysql:host=localhost;dbname=azsprojekt;charset=utf8';
	const UZYTKOWNIK='root';
	const HASLO='';
	
	public $klient;
	
	function __construct(){
		$this->polacz();
	}
	public function polacz(){
	try{
		$this->klient=new PDO(
			self::DNS,
			self::UZYTKOWNIK,
			self::HASLO
		);
	}
	catch (PDOException $e){
		die('Wystąpił następujący błąd bazy danych: '.$e->getMessage());
	}
	return true;
	}
}