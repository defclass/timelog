//这里是加载完就要显示图表的JS
$.post("ajax.php?action=GetChart",
       {"time":"today"},
       function(json){
	   if(json){
	       var data = [];
	       var obj = {};
	       for(var p in json){
		   obj.name = p;
		   obj.value = json[p];
		   obj.color = getColor(6);
		   data.push(obj);
		   obj ={};
	       }


	       new iChart.Pie2D({
		   render : 'chart1',
		   data: data,
		   //title : '今日时间统计',
		   tip:{
		       enable : true,
		       listeners:{
			   //tip:提示框对象、name:数据名称、value:数据值、text:当前文本、i:数据点的索引
			   parseText:function(tip,name,value,text,i){
			       return "<span style='color:#005268;font-size:11px;font-weight:600;'>"+ "</span> <span style='color:#005268;font-size:20px;font-weight:600;'>"+numDiff2Time(value)+"</span>";
			   }
		       }
		   }, 
		   legend : {
		       enable : true
		   },
		   showpercent:true,
		   border:false,
		   width : 800,
		   height : 400,
		   radius:140
	       }).draw();
	   }//end of if
       },
       "json"
      );

$.post("ajax.php?action=GetChart",
       {"time":"alldays"},
       function(json){
	   if(json){
	       var data = [];
	       var obj = {};
	       var labels = [];
	       for(var p in json){
		   labels.push(p);
		   obj.name = p;
		   obj.value = json[p];
		   obj.color = getColor(6);
		   data.push(obj);
		   obj ={};
	       }


	       new iChart.Pie2D({
		   render : 'chart2',
		   data: data,
		   decimalsnum:2,
		   border:false,
		   //title : '全部时间统计',
		   tip:{
		       enable : true,
		       listeners:{
			   //tip:提示框对象、name:数据名称、value:数据值、text:当前文本、i:数据点的索引
			   parseText:function(tip,name,value,text,i){
			       return "<span style='color:#005268;font-size:11px;font-weight:600;'>"+ "</span> <span style='color:#005268;font-size:20px;font-weight:600;'>"+numDiff2Time(value)+"</span>";
			   }
		       }
		   }, 
		   legend : {
		       enable : true
		   },
		   showpercent:true,
		   decimalsnum:2,
		   width : 800,
		   height : 600,
		   radius:140
	       }).draw();
	   }; //end of if 
	       },
       "json"
      );




//随机选择一个颜色
function getColor(num){
    var str='ABCDEF0123456789';
    var l = parseInt(num)||Math.ceil(Math.random() * 5);
    var ret = '#'+'';
    for(var i=0;i<l;i++){
	ret += str.charAt(Math.ceil(Math.random()*(str.length-1)));
    }
    return ret;
}

function numDiff2Time(count) { 
    
    var year = 0;
    var month = 0;
    var day = 0;
    var hour = 0;
    var minu = 0;
    var second = 0;

    var year_0 = 3600 * 24 * 30 * 12;
    var month_0 = 3600 * 24 * 30;
    var day_0 = 3600 * 24;
    var hour_0 = 3600;
    var minu_0 = 60;
    
    
    if (count >= year_0) {
	year = Math.floor(count / (3600 * 24 * 30 * 12));
	count = count % (3600 * 24 * 30 * 12);
    }

    
    if (count >= month) {
	month = Math.floor(count / (3600 * 24 * 30));
	count = count % (3600 * 24 * 30);
    }

    
    if (count >= day_0) {
	day = Math.floor(count / (3600 * 24));
	count = count % (3600 * 24);
    }

    
    if (count >= hour_0) {
	hour = Math.floor(count / 3600);
	count = count % 3600;
    }

    
    if (count >= minu_0) {
	minu = Math.floor(count / 60);
	count = count % 60;
    }
    
    second = count;

    
    hour = (hour < 10) ? '0' + hour: hour;
    minu = (minu < 10) ? '0' + minu: minu;
    second = (second < 10) ? '0' + second: second;

    
    if (year !== 0) return year + "-" + month + "-" + day + " " + hour + ":" + minu + ":" + second;

    if (month !== 0) return month + "-" + day + " " + hour + ":" + minu + ":" + second;

    if (day !== 0) return day + " " + hour + ":" + minu + ":" + second;

    if (hour !== 0 && hour !== "00") return hour + ":" + minu + ":" + second;

    if (minu !== 0) return minu + ":" + second;

    if (second !== 0) return minu + ":" + second;
} 
