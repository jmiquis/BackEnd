<?php

class Database{
	public static function connect(){
		$db = new mysqli('127.0.0.1:3308', 'root', 'root', 'tienda_master');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}



}