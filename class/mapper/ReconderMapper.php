<?php
namespace mapper;

class ReconderMapper extends Mapper{
	protected $selectStmt;
	protected $updateStmt;
	protected $insertStmt;

	function __construct(){
		parent:: __construct();
		$this->selectStmt = self::$PDO->prepare(
			"select * from reconder where tag_id = ? and user_id= ?");
		$this->selectAllStmt = self::$PDO->prepare(
			"select * from reconder ");
		$this->updateStmt = self::$PDO->prepare(
			"update reconder set user_id = ?,tag_id=?, date=?, totalTime=?, stime=?, etime=?, comment=? where tag_id = ?  ");
		$this->insertStmt = self::$PDO->prepare(
			"insert into reconder (user_id, tag_id, date, totalTime, stime, etime, comment) values (?,?,?,?,?,?,?)");

	}

	function getCollection(array $raw){
		return new ReconderCollection($raw,$this);
	}

	function update(\domain\DomainObject $object){
		$values = array(
					$object->getUser_id(),
					$object->getTag_id(),
					$object->getDate(),
					$object->getTotalTime(),
					$object->getStime(),
					$object->getEtime(),
					$object->getComment(),
					
			);	

			$this->updateStmt->execute($values);
	}



	protected function doInsert(\domain\DomainObject $object){
		$values = array(
			$object->getUser_id(),
			$object->getTag_id(),
			$object->getDate(),
			$object->getTotalTime(),
			$object->getStime(),
			$object->getEtime(),
			$object->getComment(),
		);

		
		$this->insertStmt->execute($values);

		//获取最后插入的id
		$id = self :: $PDO ->lastInsertId();

		$object->setId( $id );
	
	}

	protected function selectStmt(){
		return $this->selectStmt;	
	}

	protected function selectAllStmt(){
		return $this->selectAllStmt;	
	}


	protected function doCreateObject(array $array){
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
