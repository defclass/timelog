<?php
namespace controller;
class EdittagPage  extends Page{
	
	function __construct(){}
	
	function process(\registry\RequestRegistry $req){
		
		$user_id = $req->get('user_id');
		$finder = \mapper\PersistenceFactory::getFinder('domain\\Tag');
		$tag_idobj = new \mapper\IdentityObject();
		$tag_idobj->field('user_id')->eq($user_id);
		$Tag_Collection_object = $finder->find($tag_idobj);
		
		$edittag = array();
		while($Tag_Collection_object->valid()){
			$obj = $Tag_Collection_object->next();
			$visible = $obj->getVisible();
			$name = $obj->getName();
			$edittag[] = array("name"=>$name,"visible" => $visible);
		}

		$this->tpl->assign('edittag',$edittag);
		
	}	

	function draw(){
		$this->tpl->draw('edittag');
	}
}


?>