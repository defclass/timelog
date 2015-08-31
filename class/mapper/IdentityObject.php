<?php
namespace mapper;

/*
 *     	这个类 将Field类 组合 生成 age > 40 这个一个 子句 ；返回的结
 *  果是一个数组
 *  	enforce 这个数组是限定 一定要有某些字段 ，不然会抛出错误。
 */

class IdentityObject {
	protected $currentfield = null;
	protected $fields = array ();

	private $and = null ;
	private $enforce = array();

	function __construct($field = null , array $enforce =null){

		if ( !is_null($enforce)){

			$this->enforce = $enforce;
		}

		if ( ! is_null ($field )){
			$this->field($field);
		}
	
	}

	function getObjectFields(){

		return $this->enforce;
	}


	function field( $fieldname){
		if (! $this->isVoid() && $this->currentfield->isIncomplete()){
			throw new \Exception("Incomplete field");
		}

		$this->enforceField($fieldname);

		if ( isset ($this->fields[$fieldname])){
			$this->currentfield = $this->fields[ $fieldname ];
		}else{
			$this->currentfield = new Field($fieldname);
			$this->fields[$fieldname] = $this->currentfield;
		}
		return $this;

	}


	function isVoid(){
		return empty ( $this->fields );
	}

	function enforceField($fieldname){
		if ( ! in_array($fieldname, $this->enforce ) && !empty( $this->enforce)){
			$forcelist = implode(', ', $this->enforce);
			throw new \Exception("{$fieldname} not a legal field ($forcelist)");
		}
	
	}



	function eq($value){
		return $this->operator("=" , $value);	
	}

	function lt($value){
		return $this->operator("<" , $value);
	}

	private function operator($symbol , $value){
		if ($this->isVoid()){
			throw new \Exception("no object field defined");
		}

		$this->currentfield->addTest($symbol ,$value);
		return $this;
	}

	function getComps(){
		$ret = array();
		foreach ($this->fields as $key => $field){
			$ret = array_merge ($ret , $field->getComps());
		}
		return $ret;
	
	}


}




?>
