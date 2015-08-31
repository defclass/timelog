$(function(){
    // 设置导航的背景
    var url= window.location.href;
    var patten = /main|edittag|timestatistic|userset/;;
    var result = url.match(patten);
    if (result){
	var classname = '.'+result[0]+'_page';
	$(classname).css({'backgroundColor':'hsl(0,0%,25%)' });
    }
	//
  //  if ($('.cols')) $('.cols').equalHeights();
    
});//end of all
