<?php
namespace registry;

class  PDORigister extends Registry {
	private static $instance;

	private function __construct(){}

	static function instance(){
		if  ( ! isset( self::$instance)){
			$dsn = 'mysql:unix_socket=/tmp/mysql.sock;dbname=timelog';
			$username = 'root';
			$password = '';
			
			self :: $instance =new \PDO($dsn, $username, $password);
			self :: $instance->query("set names utf8;"); 
		}
			return self :: $instance ;
	}


	
}
?>
