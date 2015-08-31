<?php
namespace mapper;

class TagUpdateFactory extends UpdateFactory {
	function newUpdate ( \domain\DomainObject $obj ){
		$id = $obj->getId();
		$cond = null ;

		$values['name'] = $obj->getName();
		$values['user_id'] = $obj->getUser_Id();
		if (!is_null( $obj->getVisible() )) $values['visible'] = $obj->getVisible();

		if ( $id > -1){
			$cond['id'] = $id;
		}

		return $this->buildStatement ("tag" ,$values ,$cond );
	}

}


?>
