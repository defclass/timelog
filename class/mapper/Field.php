<?php
namespace mapper;
/*
 * 这个类储存 字段名 name 并提供 组装的一些工具
 */
class Field {
	protected $name = null;
	protected $operator = null;
	protected $comps = array();
	protected $incomplete = false ;

	function __construct( $name ){
		$this ->name = $name;
	}


	function addTest( $operator ,$value ){
		$this->comps[] = array ('name' => $this->name, 'operator' => $operator , 'value' => $value );
	}

	function getComps() { 
		return $this->comps; 
	}

	function isIncomplete(){
		return empty( $this -> comps) ;
	}
	


}



?>
