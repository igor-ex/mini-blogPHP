<?php defined('SITE') or die; ?>
<?php

class db{
	static private $con;
	static private $options = array(
		//PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "utf8"'
	);
	static function get(){
		if(!self::$con)
			self::connect();
		return self::$con;
	}
	static private function connect(){
		self::$con = new PDO('mysql:host=localhost;dbname=ff','iii','iii',self::$options);
	}
	static function connected(){
		if(self::$con)
			return true;
		else
			return false;
	}
	static function disconnect(){
		self::$con = NULL;
	}
}
