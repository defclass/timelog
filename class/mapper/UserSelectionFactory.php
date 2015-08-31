<?php
namespace mapper;
/*
 *  newSelection 返回的数组 $core. " ".$where : " select name, age from user where id >? and name =? "
 *  			    $values ：与之相对应的值的 数组  
 */

class UserSelectionFactory extends SelectionFactory {
	function newSelection( IdentityObject $obj){
		$fields = implode ( ',' , $obj->getObjectFields() );
		$core = " select * from user ";
		list ( $where , $values ) = $this->buildWhere( $obj );
		return array( $core. " ".$where, $values );
	}



}


?>
