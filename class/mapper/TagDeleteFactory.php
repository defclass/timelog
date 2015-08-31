<?php
namespace mapper;

class TagDeleteFactory extends DeleteFactory {
	function newDelete ( \domain\DomainObject $obj ){
		$id = $obj->getId();
		$cond = null ;
		if ( $id > -1){
			$cond['id'] = $id;
		}

		return $this->buildStatement ("tag" ,$cond );
	}

}


?>
