<?php
namespace mapper;
abstract class DeleteFactory{
	abstract function newDelete ( \domain\DomainObject $obj );

	//conditions 数组 ，键是where子句的字段名，
	//		    值是where子句的字段值；
	//
	protected function buildStatement( $table , array $conditions = null ){

		$query = " delete from {$table} where ";
		foreach ( $conditions as $key => $val ){
			$cond[] = "$key = ?";
			$terms[] = $val;

		}
		$query .= implode("and", $cond);
		return array($query , $terms );
	}	


}

?>
