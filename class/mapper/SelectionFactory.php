<?php
namespace mapper;
/*
 * buildWhere 返回 如 $where: "where name = ? and  tall > ? "
 * 		      $values  是与之相对应的值的数组 
 */
abstract class SelectionFactory  {
	abstract function newSelection( IdentityObject $obj);

	function buildWhere (IdentityObject $obj){
	
		if ($obj->isVoid() ){
			return array("", array());
		}

		$compstrings = array();
		$values = array();
		foreach ( $obj->getComps() as $comp ){
			$compstrings[] = " {$comp['name']} {$comp['operator']} ? ";
			$values [] = $comp['value'] ;
		}
		$where = " where " . implode (" and " ,$compstrings );
		return array($where ,$values);
	}

}


?>
