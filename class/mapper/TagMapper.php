<?php
namespace mapper;

class TagMapper extends Mapper{



	function __construct(){
		
		parent::__construct();

		$this->selectIdStmt = self::$PDO->prepare(
			"select * from tag where name = ?");

		$this->selectAllStmt = self::$PDO->prepare(
			"select * from tag ");
		
		$this->updateStmt = self::$PDO->prepare(
			"update tag set name = ? , visible = ? where id = ?  ");
		$this->insertStmt = self::$PDO->prepare(
			"insert into tag (name ) values (?)");
		$this->deleteStmt = self:: $PDO->prepare(
			"delete from tag where id = ?");

	
	}

	protected function doCreateObject(array $array){
		$obj = new \domain\Tag($array['id']);
		$obj->setName($array['name']);
		$obj->setFid($array['fid']);
		$obj->setVisible($array['visible']);
		return $obj;

	}

	function getCollection(array $raw){
		return new TagCollection($raw,$this);
	}

	//获取id
	function selectStmt(){
		return $this->selectIdStmt ;
	}


	//获取全部标签
	function selectAllStmt(){
		return $this->selectAllStmt ;
	}


	//插入标签
	function doInsert(\domain\DomainObject $object){
		$values = array($object->getName());
		$rt = $this->insertStmt->execute($values);
		$id = self :: $PDO ->lastInsertId();
		$object ->setId($id);

		//返回插入数据的结果
		return $rt;
	}

	//更新标签
	function update(\domain\DomainObject $object){
		$values = array($object->getName(),$object->getVisible(),$object->getId());
		return $this->updateStmt->execute($values);


	}

	function delete(\domain\DomainObject $object){
		$values = array($object->getId());

		return	$this->deleteStmt->execute($values);
	}


}




?>
