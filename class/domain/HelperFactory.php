<?php
namespace domain ;

class HelperFactory{
	static function getCollection($type){
		$name = explode('\\',$type);
		$collection_name = '\\mapper\\'.$name[1].'Collection';
		$collection = new $collection_name();
		return $collection->objects;

	}


	static function getFinder($type){
		$name = explode('\\',$type);
		$Mapper_name= '\\mapper\\'.$name[1].'Mapper';
		$Mapper = new $Mapper_name();
		return $Mapper;
	}

}



?>
