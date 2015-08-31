<?php
namespace mapper ;
class ReconderPersistenceFactory  extends PersistenceFactory {

	function getCollection(array $raw ){
		return new ReconderCollection($raw,$this->getDomainObjectFactory());
	}

	function getDomainObjectFactory(){
		return new ReconderFactory(); 
	}

	function getSelectionFactory(){
		return new ReconderSelectionFactory();
	}

	function getUpdateFactory(){
		return new ReconderUpdateFactory();
	}

	function getDeleteFactory(){
		return new ReconderDeleteFactory();
	}

	

}






?>
