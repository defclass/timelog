<?php
namespace mapper;
class TagFactory extends DomainObjectFactory  {

	function createObject (array $array){

		$obj = new \domain\Tag( $array['id']);
		$obj->setName($array['name']);
		$obj->setVisible($array['visible']);
		$obj->setUser_Id($array['user_id']);

		return $obj;

	}


}


?>
