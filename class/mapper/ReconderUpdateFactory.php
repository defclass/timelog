<?php
namespace mapper;

class ReconderUpdateFactory extends UpdateFactory {
	function newUpdate ( \domain\DomainObject $obj ){
		$id = $obj->getId();
		$cond = null ;
	
		$values['user_id'] = $obj->getUser_id();
		$values['tag_id'] = $obj->getTag_id();
		$values['date'] = $obj->getDate();
		$values['totalTime'] = $obj->getTotalTime();
		$values['stime'] = $obj->getStime();
		$values['etime'] = $obj->getEtime();
		$values['comment'] = $obj->getComment();
	
		if ( $id > -1){
			$cond['id'] = $id;
		}

		return $this->buildStatement ("reconder" ,$values ,$cond );
	}

}


?>
