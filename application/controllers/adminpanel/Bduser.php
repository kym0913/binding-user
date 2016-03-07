<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bduser extends Admin_Controller{

	var $method_config;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Memberbp_model'));
//		$this->load->model(array('Times_model'));
	//	$this->load->helper(array('member','auto_codeIgniter','string'));

	//	$this->method_config['upload'] = array(
//										'thumb'=>array('upload_size'=>1024,'upload_file_type'=>'jpg|png|gif','upload_path'=>'uploadfile/user','upload_url'=>SITE_URL.'uploadfile/user/'),
	//									);
	}

	function index($page_no=1)
	{

	//	$page_no = max(intval($page_no),1);

        $where_arr = array();
				$orderby = $keyword= "";
       if (isset($_GET['dosubmit'])) {
					$keyword =isset($_GET['keyword'])?safe_replace(trim($_GET['keyword'])):'';
				if($keyword!="") $where_arr[] = "concat(mems_name,mems_company,mems_phone,mems_openid) like '%{$keyword}%'";

       }
        $where = implode(" and ",$where_arr);
        $data_list = $this->Memberbp_model->listinfo($where,'*',$orderby, $page_no,
				$this->Memberbp_model->page_size,'',$this->Memberbp_model->page_size,page_list_url('adminpanel/bduser/index',true));

		$this->view('index',array('data_list'=>$data_list,'pages'=>$this->Memberbp_model->pages,'keyword'=>$keyword,'require_js'=>true));
	}


	function add()
	{

		//如果是AJAX请求

			if($this->input->is_ajax_request())
		{
					//接收POST参数
			$username = isset($_POST["username"])?trim(safe_replace($_POST["username"])):exit(json_encode(array('status'=>false,'tips'=>'用户名不能为空')));
			if($username=='')exit(json_encode(array('status'=>false,'tips'=>'用户名不能为空')));

			$company = isset($_POST["company"])?trim(safe_replace($_POST["company"])):exit(json_encode(array('status'=>false,'tips'=>'公司名不能为空')));
			if($company =='')exit(json_encode(array('status'=>false,'tips'=>'公司名不能为空')));

			$openid = isset($_POST["openid"])?trim(safe_replace($_POST["openid"])):exit(json_encode(array('status'=>false,'tips'=>'openid不能为空')));
			if($openid =='')exit(json_encode(array('status'=>false,'tips'=>'openid不能为空')));

			$totaltime = isset($_POST["totaltime"])?trim(safe_replace($_POST["totaltime"])):exit(json_encode(array('status'=>false,'tips'=>'总时长不能为空')));
			if($totaltime =='')exit(json_encode(array('status'=>false,'tips'=>'总时长不能为空')));

			$mobile= isset($_POST["mobile"])?trim(safe_replace($_POST["mobile"])):exit(json_encode(array('status'=>false,'tips'=>'手机号不能为空')));
			if(!is_mobile($mobile)){
				exit(json_encode(array('status'=>false,'tips'=>'手机号格式不正确')));
			}


		//	if($this->check_username($username))exit(json_encode(array('status'=>false,'tips'=>'用户名已经存在')));
						$new_id = $this->Memberbp_model->insert(
												array(
													'mems_name'=>$username,
													'mems_company'=>$company,
													'mems_phone'=>$mobile,
													'mems_openid'=>$openid,
													'mems_totaltime'=>$totaltime,
											));
						if($new_id)
						{
							exit(json_encode(array('status'=>true,'tips'=>'新增成功','new_id'=>$new_id)));
						}else
						{
							exit(json_encode(array('status'=>false,'tips'=>'新增失败','new_id'=>0)));
						}
				}else
				{
					$this->view('edit',array('is_edit'=>false,'require_js'=>true,'data_info'=>$this->Memberbp_model->default_info()));
				}
	}



}



























//end
