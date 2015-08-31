<?php
namespace mapper ;
class TagPersistenceFactory  extends PersistenceFactory {

	function getCollection(array $raw ){
		return new TagCollection($raw,$this->getDomainObjectFactory());
	}

	function getDomainObjectFactory(){
		return new TagFactory(); 
	}

	function getSelectionFactory(){
		return new TagSelectionFactory();
	}

	function getUpdateFactory(){
		return new TagUpdateFactory();
	}
	
	function getDeleteFactory(){
		return new TagDeleteFactory();
	}
	

}






?>
