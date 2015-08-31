<?php
namespace mapper ;
class UserPersistenceFactory  extends PersistenceFactory {

	function getCollection(array $raw ){
		return new UserCollection($raw,$this->getDomainObjectFactory());
	}

	function getDomainObjectFactory(){
		return new UserFactory(); 
	}

	function getSelectionFactory(){
		return new UserSelectionFactory();
	}

	function getUpdateFactory(){
		return new UserUpdateFactory();
	}

	function getDeleteFactory(){
		return new UserDeleteFactory();
	}

	

}






?>
