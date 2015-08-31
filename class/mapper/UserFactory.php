<?php
namespace mapper;
class UserFactory extends DomainObjectFactory  {

	function createObject (array $array){

		$obj = new \domain\User( $array['id']);
		
		$obj->setReg_time($array['reg_time']);
		$obj->setEmail($array['email']);
		$obj->setUsername($array['username']);
		$obj->setPassword($array['password']);
		$obj->setBanned($array['banned']);
		return $obj;

	}


}


?>
