<?php
namespace mapper ;
/*
 *  这类是获得其它类的方法，有一个干净的接口
 */
abstract class PersistenceFactory {

	abstract function getCollection(array $raw );
	abstract function getDomainObjectFactory();
	abstract function getSelectionFactory();
	abstract function getUpdateFactory();
	abstract function getDeleteFactory();

	//利用这个类来获得标识对象
	function getIdentityObject(){
		return new IdentityObject();
	}



	static	function getFactory($type){
		$name = explode('\\',$type);
		$collection_name = '\\mapper\\'.$name[1].'PersistenceFactory';
		return  new $collection_name();
	}

	static function getFinder($type){
		$factory = self :: getFactory( $type  );
		return new DomainObjectAssembler($factory);
	}

	function Finder(){
		
		return new DomainObjectAssembler($this);
	}



}

?>
