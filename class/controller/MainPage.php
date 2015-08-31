<?php
namespace controller;
class MainPage  extends Page{
	
	function __construct(){}
	
	function process(\registry\RequestRegistry $req){
		$user_id = $req->get('user_id');
		$user_id_select = new \mapper\IdentityObject();
		$user_id_select->field('user_id')->eq($user_id);
		$rec_finder = \mapper\PersistenceFactory :: getFinder('domain\\Reconder');
		$tag_finder = \mapper\PersistenceFactory :: getFinder('domain\\Tag');
	


		$collection_rec = $rec_finder->Find($user_id_select);
		$collection_tag = $tag_finder->Find($user_id_select);

		//所有的reconder

		$reconders = array();
		$collection_rec->rewind();
		while($collection_rec->valid()){
			$rec_obj = $collection_rec->next();
			$collection_tag->rewind();
			while($collection_tag->valid()){
				$tag_obj = $collection_tag->next();
				//找到相应的标签
				if($rec_obj->getTag_id() == $tag_obj->getId()){
					$tagName  =  $tag_obj->getName();
					$totalTime = \util\Caltime::numDiff2Time($rec_obj->getTotalTime());
					$stime 	=date("Y-m-d H:i:s",$rec_obj->getStime());
					$etime	= date("Y-m-d H:i:s",$rec_obj->getEtime());
					$comment = $rec_obj->getComment();
					$areconder =  array('tagName'=>$tagName,'totalTime'=>$totalTime,'stime'=>$stime,'etime'=>$etime,'comment'=>$comment);			

					$reconders[] = $areconder;
				}

			}

		}
		//最近的日期排前面。
		krsort($reconders);
	

		//通过访问数据库对象的方法来获取标签的字段
		$tag_vis = array();
		$collection_tag->rewind();
		while($collection_tag->valid()){
			$tag_obj = $collection_tag->next();
			$taglist = $tag_obj->getName();
			$visible = $tag_obj->getVisible();
			$tag_vis[] = array('tagList'=>$taglist,'visible'=>$visible);
		}
	
		$this->tpl->assign('reconders',$reconders);
		$this->tpl->assign('tagList',$tag_vis);
	                 
	}

	

	function draw(){
		$this->tpl->draw('main');
	}
}


?>