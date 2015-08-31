<?php
namespace mapper;
abstract class UpdateFactory{
	abstract function newUpdate ( \domain\DomainObject $obj );

	//fields 数组，键是设置的字段名
	//	       值是设置的字段值；
	//conditions 数组 ，键是where子句的字段名，
	//		    值是where子句的字段值；
	//
	protected function buildStatement( $table , array $fields ,array $conditions = null ){
		$terms = array ();

		//没有$condition 就默认是 update 了吗？

		if ( ! is_null ( $conditions ) ) {
			$query = " update {$table} set ";
			$query .= implode( " =?,", array_keys ($fields))." = ?" ; 
			$terms = array_values( $fields );
			$cond = array();
			$query .= " where ";
			foreach ( $conditions as $key => $val ){
				$cond[] = "$key = ?";
				$terms[] = $val;

			}
			$query .= implode( "and " ,$cond );

		}else{
			$query = " insert into {$table} (";
			$query .= implode(" ," , array_keys($fields) );
			$query .= ") values (";
			foreach ( $fields as $name => $value){
				$terms[] = $value;
				$qs[] = '?';
			}
			$query .= implode(",",$qs);
			$query .= ")";
		}	
		return array($query , $terms );
	}	


}

?>
