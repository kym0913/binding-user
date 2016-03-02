define(function (require) {
	var $ = require('jquery');
	var aci = require('aci');
	require('bootstrap');
	require('jquery-ui-dialog-extend');
	require('bootstrapValidator');
	require('message');

	$(".uploadThumb_a").click(function(){
		$.extDialogFrame(SITE_URL+folder_name+"/user/upload/thumb/thumb/1",{model:true,width:600,height:250,title:'请上传...',buttons:null});
	});


	var validator_config = {
		message: '输入框不能为空',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			username: {
				message: '用户名不能为空',
				validators: {
					notEmpty: {
						message: '用户名不能为空'
					},
					stringLength: {
						min: 2,
						max: 10,
						message: '用户名请为2到10个字符之间'
					},
					remote: {
						url: SITE_URL+folder_name+'/user/check_username',
						message: '用户名已经存在，请更换用户名'
					},
					different: {
						field: 'password',
						message: '用户名不能和密码一样'
					}
				}
			},
			company: {
				message: '单位不能为空',
				validators: {
					notEmpty: {
						message: '单位不能为空'
					},
				}
			},
			mobile:{
				validators: {
					notEmpty: {
						message: '请输入手机号'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: '手机号只能全为数字'
					}
				}
			},
			group_id: {
				validators: {
					notEmpty: {
						message: '请选择用户组'
					}
				}
			},
		}
	};

	if(edit){
		var validator_config = {
			message: '输入框不能为空',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				email: {
					validators: {
						notEmpty: {
							message: '请输入Email'
						}
					}
				},
				mobile: {
					validators: {
						notEmpty: {
							message: '请输入手机号'
						}
					}
				},
				group_id: {
					validators: {
						notEmpty: {
							message: '请选择用户组'
						}
					}
				},
				mobile:{
					validators: {
						notEmpty: {
							message: '请输入手机号'
						},
						regexp: {
							regexp: /^[0-9\.]+$/,
							message: '手机号只能全为数字'
						}
					}
				},
			}
		};
	}
	$('#validateform').bootstrapValidator(validator_config).on('success.form.bv', function(e) {
		e.preventDefault();

		$("#dosubmit").attr("disabled","disabled");


		$.scojs_message('请稍候...', $.scojs_message.TYPE_WAIT);
		$.ajax({
			type: "POST",
			url: edit?SITE_URL+folder_name+"/Bduser/edit/"+id:SITE_URL+folder_name+"/Bduser/add/",
			data:  $("#validateform").serialize(),
			success:function(response){
				var dataObj=jQuery.parseJSON(response);
				if(dataObj.status)
				{
					$.scojs_message('操作成功,3秒后将返回列表页...', $.scojs_message.TYPE_OK);
					aci.GoUrl(SITE_URL+folder_name+'/Bduser/add/',1);
				}else
				{
					$.scojs_message(dataObj.tips, $.scojs_message.TYPE_ERROR);
					$("#dosubmit").removeAttr("disabled");
				}
			},
			error: function (request, status, error) {
				$.scojs_message(request.responseText, $.scojs_message.TYPE_ERROR);
				$("#dosubmit").removeAttr("disabled");
			}
		});

	}).on('error.form.bv',function(e){ $.scojs_message('所有填写信息不能为空', $.scojs_message.TYPE_ERROR);$("#dosubmit").removeAttr("disabled");});

});
