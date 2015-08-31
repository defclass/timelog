<?php
namespace domain;

class Tag extends  DomainObject{
	private $fid;
	private $name;
	private $visible;
	private $newname;
	private $user_id;

	function __construct($id = null , $user_id=null,$fid = null, $name =null, $visible =null){
		parent :: __construct( $id );
		
		$this->user_id = $user_id;
		$this->fid = $fid;
		$this->name = $name;
		$this->visible = $visible;
	}	     

	//获取所有的Reconders
	function getReconders($str_type){
		return \domain\HelperFactory::getCollection($str_type);
	}






	//getter setter
	function setUser_Id($user_id){
		$this->user_id = $user_id;
		$this->markDirty();
	}

	function getUser_Id(){
		return $this->user_id;
	}
	function setFid($fid){
		$this->fid = $fid;
		$this->markDirty();
	}

	function getFid(){
		return $this->fid;
	}

	function setName($name){
		$this->name = $name;
		$this->markDirty();
	}

	function getName(){
		return $this->name;
	}
	function setVisible($visible){
		$this->visible = $visible;
		$this->markDirty();
	}

	function getVisible(){
		return $this->visible;
	}

	function setNewname($name){
		$this->newname= $name;
		$this->markDirty();
	}
	function getNewname(){
		return $this->newname;
	}
}


?>
