<?php
class defineTimeLine{
	//开始日期
	protected $startDate = null;
	protected $overDate = null;

	//界定时间戳,从开始到现在；
	function defineTimestamp($day_num = ""){

		if(is_int($day) && $day_num > 0  ){
			//$today 计算今天晚上凌晨的时间戳；
			$today = strtotime('today +1 day');

			//front 计算一段时间前凌晨的时间戳；
			$front = strtotime("today -$day_num days  ");

			return Array(0 => $front, 1 => $today);


		}elseif(is_null($day_num)){

			return null;

		}else{
			throw new Exception("defineTimestamp():请输入一个正整数")
		}

	}

	//给一个跨天的stime ,etime 。从中截断，分两段计算；
	function crossMidnight($stime,$etime,$date){

		$midtime =strtotime($date); 
		$arr['yesterday_number'] = $midtime - $stime ;
		$arr['tormorrom_number'] = $etime - $midtime;

		return $arr;
	}

	//给出数据库中的stime,etime记录（数组），计算出这段记录从开始到结束分别是哪天，
	function BeginAndOver(Chart $cha){
		//对stime 数组反排序；
		rsort($cha->stime);

		//对etime 数组排序；
		sort($cha->etime);

		//取最后一个元素,得到最小值和最大值；
		$begin_timestamp = end($cha->stime);
		$over_timestamp = end($cha->etime);

		$this->startDate = date('Y/m/d',$begin_timestamp);
		$this->overDate = date('Y/m/d',$over_timestamp);

		return "true";
	}



	//给出数据库中的stime,etime记录（数组），计算出这段记录从开始到结束分别是哪天，
	//并生成从开始到结束，以日期为索引的数组；
	function BeginToOver(chart $cha){
		//获取开始和结束的两个日期
		if($this->startDate == null &&$this->overDate == null) $this->BeginAndOver;

		$date1 = $this->startDate;
		$date2 = $this->overDate;

		$arr[$date1] = 0;

		while($date1<$date2){
			$date1=date('Y/m/d',strtotime($date1.'+1 days'))	;
			$arr[$date1] = 0 
		}

		return $arr;
	}

}


?>
