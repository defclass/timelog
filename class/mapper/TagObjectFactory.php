<?php
namespace mapper;
class TagObjectFactory extends DomainObjectFactory  {

	function createObject (array $array){
		$obj = new \domain\Tag($array['id']);
		$obj->setName($array['name']);
		$obj->setFid($array['fid']);
		$obj->setVisible($array['visible']);
		return $obj;
	}


}


?>
