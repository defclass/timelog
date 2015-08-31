<?php
namespace util;

class Caltime{

	static public function numDiff2Time($count) { //这是将数字固定化输出的函数，输出字符串，格式2012-0-0 13:00:00
		// $count=5005537;
		$year = 0;
		$month = 0;
		$day = 0;
		$hour = 0;
		$minu = 0;
		$second = 0;

		$year_0 = 3600 * 24 * 30 * 12;
		$month_0 = 3600 * 24 * 30;
		$day_0 = 3600 * 24;
		$hour_0 = 3600;
		$minu_0 = 60;
		//	if($count <0)  alert("请输入大于0的整数"); 	
		//求年
		if ($count >= $year_0) {
			$year = floor($count / (3600 * 24 * 30 * 12));
			$count = $count % (3600 * 24 * 30 * 12);
		}

		//求月
		if ($count >= $month_0) {
			$month = floor($count / (3600 * 24 * 30));
			$count = $count % (3600 * 24 * 30);
		}

		//求天数
		if ($count >= $day_0) {
			$day = floor($count / (3600 * 24));
			$count = $count % (3600 * 24);
		}

		//求小时数
		if ($count >= $hour_0) {
			$hour = floor($count / 3600);
			$count = $count % 3600;
		}

		//求分钟数
		if ($count >= $minu_0) {
			$minu = floor($count / 60);
			$count = $count % 60;
		}
		//求秒数
		$second = $count;

		//时，分，秒如果小于10则自动在前面添加0.	
		$hour = ($hour < 10) ? '0' . $hour: $hour;
		$minu = ($minu < 10) ? '0' . $minu: $minu;
		$second = ($second < 10) ? '0' . $second: $second;

		//返回固定格式的天数，时间，如2000-00-00 00:00:01
		if ($year !== 0) return $year . "-" . $month . "-" . $day . " " . $hour . ":" . $minu . ":" . $second;

		if ($month !== 0) return $month . "-" . $day . " " . $hour . ":" . $minu . ":" . $second;

		if ($day !== 0) return $day . " " . $hour . ":" . $minu . ":" . $second;

		if ($hour !== 0 && $hour !== "00") return $hour . ":" . $minu . ":" . $second;

		if ($minu !== 0) return $minu . ":" . $second;

		if ($second !== 0) return $minu . ":" . $second;
	}//numDiff2Time函数结束



}





?>
