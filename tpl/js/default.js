$(function(){
    

    //********************************这里是登陆的ajax*****************
    $(".load_submit").live('click',function(e){

	//防止浏览器默认行为
	e.preventDefault();
	$.post("ajax.php?action=Load&flag=login",
	       {"email":$(".load_email").val(),"password":$(".load_password").val()},
	       function(json){
		   //登陆成功
		   if(json.success) {
		       self.location='main';
		   }

		   //登陆不成功
		   if(!json.success) {
		       $.sticky(json.msg);
		   }
	       },"json");//end of $.post



    });// end of .load_submit


    //注销的js
    $('.logout').live('click',function(){
	$.post('ajax.php?action=Load&flag=logout', function(){ self.location='index.php';});
    });


    //这里是注册的ajax
    $(".register_submit").live('click',function(e){

	//防止浏览器默认行为
	e.preventDefault();
	$.post("ajax.php?action=UserRigister",
	       {"username":$(".register_username").val(),
		"email":$(".register_email").val(),
		"password":$(".register_password").val(),
		"repeat_password":$(".register_repeat_password").val()},
	       function(json){
		   //注册成功
		   if(json.success) { 
		       $.sticky(json.msg); 
		       $('input').not($("input[type='submit']")).val('');
		   }
		   //注册不成功
		   if(!json.success) { $.sticky(json.msg); };

	       },"json");//end of register 
    });// end of .load_submit


    //******************************************登陆页面结束**************


    //******************************************edittag页面***************
    // 添加标签 edittag 页面
    $(".select_tag_zone_enter").live('click',function(e){
	e.preventDefault();
	var selt = this;
	$.post( "ajax.php?action=Addtag",
		{"tagName": $(".add_tagName").val() },
		function(json){
		    if (json.success){
			var url= window.location.href;
			var patten = /main|edittag|timestatistic|userset/;;
			var result = url.match(patten);
			
			if( result[0] == 'main' ){ // 根据URL判断在哪个页面 ，采取不同的方法
			    var div=" <span class='tagList_tagname'>"+json.tagName+"</span>";
			    $(".click_tag_info").after(div);
			}
			if( result[0] == 'edittag' ){
			    var target = '.edit_a_tag:first'; 
			    $(target).clone().insertBefore(target); //clone第一个元素，并插入到自身的前面。
			    $(target+' .edittag_tagName ').text(json.tagName); //修改该元素的一个值。
			}
		    }
		    if (!json.success){
			$.sticky(json.msg);
		    }
		},
		"json"
	      ); 
    });	//end of add tag	
    // 添加标签




    //start of edittag
    //调整visible
    $(".edittag_visible").live('click',function(){

	var  click_point=$(this);
	var  tagName = click_point.parent().prev();
	$.post("ajax.php?action=Edittag",{"tagName":$(tagName).text(),"visible":"change"},function(json){

	    if (json.success) { 
		if (json.visible) click_point.text("显示");
		if (!json.visible) click_point.text("不显示"); 
	    }
	},
	       'json');

    })//end of visible

    //编辑标签

    $(".edittag_rename").live('click',function(){
	var rename = $(this);
	var tagName = $(this).parent().prev();
	var newName =$(this).prev();
	if (! newName.val() == ""){
	    $.post("ajax.php?action=Edittag",{"newName":newName.val(),"tagName":tagName.text()},function(json){
		if (json.success) { 
		    $(tagName).text(json.Name);
		    $(newName).val("");
		}else{
		    $.sticky(json.msg);

		}
	    },"json");
	}

    });
    
    
    //点击岀除标签按纽，调出确认，取消对话框
    $('.edittag_delete').live('click',function(){
	$(this).next().fadeIn();
    });

    //点击取消
    $('.cancle_delete').live('click',function(){

	$(this).parent().parent().fadeOut();
    });

    //点击确认删除
    $('.continue_delete').live('click',function(){
	var click_piont = $(this);
    	var aline = $(this).parent().parent().parent().parent();
    	var tagname = aline.children().first().text();
    	$.post("ajax.php?action=Edittag",{"delete":"delete","tagName":tagname},function(json){
    	    if (json.success) { 
    		$(aline).remove();
    	    }

    	},"json");

    });  
    
 
    // end of editta
    //********************************edittag 页面结束***************** 



    // ************************ userset 页面**************************
    $('.userset_update').click(function(e){
	e.preventDefault();
	$.post('ajax.php?action=userSetUpdate',
	       {'username':$('.change_username').val(),
		'origin_password':$('.origin_password').val(),
		'change_password' :$('.change_password').val(),
		'repeat_change_password' : $('.repeat_change_password').val()
	       },
	       function(json){
		   $.sticky(json.msg);

	       },"json"
	      );
    }); // end of clidck

    // ************************ userset 页面结束**************************





})//end of load
