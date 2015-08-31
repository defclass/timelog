<?php
namespace mapper;

abstract class Mapper{
	protected static $PDO;

	function __construct(){
		self::$PDO = \Registry\PDORigister::instance();
	}

	function findAll(){
		$this->selectAllStmt()->execute(array());
		return $this->getCollection(
			$this->selectAllStmt()->fetchAll());
       	}

	function find($name){
		$this->selectStmt()->execute( array($name) );
		$array = $this->selectStmt()->fetch();
		if(!is_array( $array )) {return null ;}
		if( ! isset ( $array['name'] )){ return null;}
			$object = $this->createObject($array);
		return $object	;

	}


	function insert(\domain\DomainObject $obj){
		return $this->doInsert($obj);
	}

	function createObject(array $array){
		$obj = $this->doCreateObject($array);
		return $obj;
	
	}

	abstract function update(\domain\DomainObject $object);
	protected abstract function doCreateObject(array $array);
	protected abstract function doInsert(\domain\DomainObject $object);
	protected abstract function selectStmt();




}




?>
