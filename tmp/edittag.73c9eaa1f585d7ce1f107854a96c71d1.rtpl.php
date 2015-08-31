<?php if(!class_exists('raintpl')){exit;}?><div class="edittag_container">
  <form class="add_tag_form"> <!-- 添加标签 -->
    <input type="text" class="add_tagName" name ="tagName">
    <button value="确定" class="select_tag_zone_enter">添加标签</button>
  </form>
  <?php $counter1=-1; if( isset($edittag) && is_array($edittag) && sizeof($edittag) ) foreach( $edittag as $key1 => $value1 ){ $counter1++; ?>
  <div class = 'edit_a_tag'>
    <div class = "edittag_tagName" ><?php echo $value1["name"];?></div>
    <div class='edit_option'> <!-- start edit_option -->
      <input type='text' class='edittag_input' value='' />
      <span class = "edittag_rename">重命名</span>
      <?php if( $value1["visible"] == 1 ){ ?>
      <span class ="edittag_visible"> 显示</span>
      <?php }else{ ?>
      <span class= "edittag_visible">不显示</span>
      <?php } ?>
      <span class ='edittag_delete'>删除</span>
     
      <div class = "edittag_delete_zone"> <!-- 确认删除区域 -->
	<div class='delete_dialog'>
	  <div class='delete_dialog_info'>该标签下的所有记录都会被删除，是否继续？</div>
	  <span class='continue_delete'>删除</span>
	  <span class='cancle_delete'>取消</span>
	</div> 

      </div><!-- 确认删除结束 -->

    </div> <!-- end of edit_option -->
  </div> <!-- end of edit_a_tag -->
  <?php } ?>

</div> <!-- end of edittag_container -->
