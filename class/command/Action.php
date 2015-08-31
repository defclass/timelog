<?php
namespace command;
class Action extends Command{
	private $name;
	private $totalTime;
	private $stime;
	private $etime;
	function doExecute(\registry\RequestRegistry $req){
		$result= $this->insert($req);
		if ( $result){

			$arr2 =$this->readone(array($result[0],$result[1]));

			
			//如果有两条记录
			if (!empty($result[2])){

				$arr1 =$this->readone(array($result[0],$result[2]));
				$arr2 =$this->readone(array($result[0],$result[1]));

				$arr['reconders'] = '2';
				$arr['arr1'] = $arr1	;
				$arr['arr2'] = $arr2	;

			}else{//或者只有一条记录

				$arr['reconders'] = '1';
				$arr['arr1']=$arr2;
			}
			$arr['success'] = 1;

			$this->makeup($arr);
		}
	}


//返回的数组，第一个是tag_obj
//	     第二个是一条记录 rec_obj
//	    第三个 ：如果有第三条，那么是两条记录的前一条
	function insert(\registry\RequestRegistry $req){
		
		//实例化需要的数据
		$id = null;
		$user_id = $req->get('user_id');
		$tag_id = "";
		$date = "";
		$totalTime= $req->get('totalTime');
		$stime	= $req->get('stime');
		$etime	= $req->get('etime');
		$comment = $req->get('comment');
		//实例化需要的数据


		//获取tag_id
		$finder = \mapper\PersistenceFactory::getFinder('domain\\Tag');
		$idobj = new \mapper\IdentityObject();

		/* 获取的tag对象　，必须限定user_id,tagName */
		$idobj->field('name')->eq($req->get('tagName'))->field('user_id')->eq($user_id);;
		
		$tag_obj= $finder->findOne($idobj);



		$tag_id = $tag_obj->getId(); 


		$arr[0] = $tag_obj;
		//获取date
		$today_00 =strtotime("today");

		if($etime < $today_00) {
			$date = date("Ymd",$etime);
			$reconder_obj = new \domain\Reconder($id,$user_id,$tag_id,$date,$totalTime, $stime, $etime, $comment);	
		
		
		}
		
		if($stime < $today_00 && $etime > $today_00){
			$front_time = $stime;
			$behind_time = $etime;	
			
			$date  = date("Ymd",$stime) ;
			$stime = $stime;
			$etime = $today_00;
			$totalTime = $etime - $stime;
			
			$reconder_obj_first =	new \domain\Reconder($id,$user_id,$tag_id,$date,$totalTime, $stime, $etime, $comment);
			//$mapper = $reconder_obj_first->getMapper();
			//$mapper->insert($reconder_obj_first);

			//返加一个数组。
			$arr[2] = $reconder_obj_first;

			$date = date("Ymd",$behind_time) ;
			$stime = $today_00 ;
			$etime = $behind_time;	
			$totalTime = $etime - $stime ;
			
			$reconder_obj =	new \domain\Reconder($id,$user_id,$tag_id,$date,$totalTime, $stime, $etime, $comment);
		}

		if($stime > $today_00) {
			$date =date("Ymd",$today_00);
			$reconder_obj =	new \domain\Reconder($id,$user_id,$tag_id,$date,$totalTime, $stime, $etime, $comment);
		
		}
	

	        	
		//$mapper = $reconder_obj->Finder();

	

		//$mapper->insert($reconder_obj);
	
		\domain\ObjectWatcher::performOperations();
	
		$arr[1] = $reconder_obj;

		

		return $arr;	
	}

	function readone(array $array){
		$tag_obj = $array[0];
		$reconder_obj = $array[1];	

	

		//要获得的数据
		$tagName = $tag_obj->getName();	
		$totalTime =\util\Caltime :: numDiff2Time($reconder_obj->getTotalTime());
		$stime = date("Y-m-d H:i:s",$reconder_obj->getStime());
		$etime = date("Y-m-d H:i:s",$reconder_obj->getEtime());
		$comment = $reconder_obj->getComment(); 
	

		$arr = array("tagName"=>$tagName,"totalTime"=>$totalTime,"stime"=>$stime,"etime"=>$etime,"comment"=>$comment);

		return $arr;

	}


	function makeup($arr){
		$arr['success'] = 1;
		echo json_encode($arr);
	}



}
?>


