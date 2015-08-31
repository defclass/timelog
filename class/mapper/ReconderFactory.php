<?php
namespace mapper;
class ReconderFactory extends DomainObjectFactory  {

	function createObject (array $array){

		$obj = new \domain\Reconder( $array['id']);
		
		$obj->setUser_id($array['user_id']);
		$obj->setTag_id($array['tag_id']);
		$obj->setDate($array['date']);
		$obj->setTotalTime($array['totalTime']);
		$obj->setStime($array['stime']);
		$obj->setEtime($array['etime']);
		$obj->setComment($array['comment']);
		return $obj;

	}


}


?>
