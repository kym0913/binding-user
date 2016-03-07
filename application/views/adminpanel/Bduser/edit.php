<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?php echo current_url()?>" >
<div class='panel panel-default'>
	<div class='panel-heading'>
		<i class='icon-edit icon-large'></i>
		<?php echo $is_edit?"修改":"新增"?>用户资料
		<div class='panel-tools'>

			<div class='btn-group'>
				<?php aci_ui_a($folder_name,'bduser','index','',' class="btn  btn-sm "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
			</div>
		</div>
	</div>
	<div class='panel-body'>
		<fieldset>
				<legend>基本信息</legend>
<?php if(!$is_edit):?>
					<div class="form-group">
						<label class="col-sm-2 control-label">姓名</label>
						<div class="col-sm-4">
							<input type="text" name="username"  id="username"  class="form-control validate[required]"  placeholder="请输入用户名" >
						</div>
					</div>
<?php else:?>
					<div class="form-group">
						<label class="col-sm-2 control-label">姓名</label>
						<div class="col-sm-4"> <?php echo $data_info['username']?>
						</div>
					</div>
<?php endif;?>
					<div class="form-group">
						<label class="col-sm-2 control-label">公司</label>
						<div class="col-sm-4">
							<input type="text" name="company"  id="company"  class="form-control"  placeholder="请输入公司名称" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">手机号</label>
						<div class="col-sm-4">
							<input name="mobile" type="text" class="form-control  validate[required,custom[mobile]]" value="<?php echo $data_info['mobile']?>" id="mobile" placeholder="请输入手机号" size="45" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">openid</label>
						<div class="col-sm-4">
							<input type="text" name="openid"  id="openid"  class="form-control"  placeholder="请输入openid" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">时长</label>
						<div class="col-sm-4">
							<input type="text" name="totaltime"  id="totaltime"  class="form-control"  placeholder="请输入时长" >
						</div>
					</div>

			</fieldset>



		<div class='form-actions'>
			<?php aci_ui_button($folder_name,'bduser','edit',' type="submit" id="dosubmit" class="btn btn-primary " ','保存')?>
		</div>
     </div>

</form>
<script language="javascript" type="text/javascript">

	var id = <?php echo $data_info['user_id']?>;
	var edit= <?php echo $is_edit?"true":"false"?>;
	var folder_name = "<?php echo $folder_name?>";
	function getThumb(v,s,w,h){
		$("#thumb").val(v);
		$("#thumb_SRC").attr("src","<?php echo $this->method_config['upload']['thumb']['upload_url']?>"+v);
		$("#dialog" ).dialog("close");
	}

	require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
		require(['<?php echo SITE_URL?>scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/edit.js']);
	});
</script>
