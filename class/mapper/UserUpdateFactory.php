<?php
namespace mapper;

class UserUpdateFactory extends UpdateFactory {
	function newUpdate ( \domain\DomainObject $obj ){
		$id = $obj->getId();
		$cond = null ;
		$values['username'] = $obj->getUsername();
		$values['email'] = $obj->getEmail();
		$values['password'] = $obj->getPassword();
		$values['banned'] = $obj->getBanned();
		$values['reg_time'] = $obj->getReg_time();
		if ( $id > 0){
			$cond['id'] = $id;
		}

		return $this->buildStatement ("user" ,$values ,$cond );
	}

}


?>
