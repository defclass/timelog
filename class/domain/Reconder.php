<?php
namespace domain;

class Reconder extends DomainObject{
	private $user_id;
	private $tag_id;
	private $date;
	private $totalTime;
	private $stime;
	private $etime;
	private $comment;

	function __construct($id = null , $user_id = null, $tag_id =null, $date = null, $totalTime =null, $stime = null, $etime =null, $comment = null){

		parent :: __construct($id);

		$this->user_id = $user_id;
		$this->tag_id = $tag_id;
		$this->date = $date;
		$this->totalTime = $totalTime;
		$this->stime = $stime;
		$this->etime = $etime;
		$this->comment = $comment;

		
	}	     

	//getter setter
	function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	function getUser_id(){
		return $this->user_id;
	}

	function setTag_id($tag_id){
		$this->tag_id = $tag_id;
		$this->markDirty();
	}

	function getTag_id(){
		return $this->tag_id;
	}
	function setDate($date){
		$this->date = $date;
		$this->markDirty();
	}

	function getDate(){
		return $this->date;
	}
	function setTotalTime($totalTime){
		$this->totalTime = $totalTime;
		$this->markDirty();
	}

	function getTotalTime(){
		return $this->totalTime;
	}
	function setStime($stime){
		$this->stime = $stime;
		$this->markDirty();
	}

	function getStime(){
		return $this->stime;
	}
	function setEtime($etime){
		$this->etime = $etime;
		$this->markDirty();
	}

	function getEtime(){
		return $this->etime;
	}
	function setComment($comment){
		$this->comment = $comment;
		$this->markDirty();
	}

	function getComment(){
		return $this->comment;
	}
}


?>
