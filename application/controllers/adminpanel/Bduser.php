<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bduser extends Admin_Controller {

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
				$this->Memberbp_model->page_size,'',$this->Memberbp_model->page_size,page_list_url('adminpanel/user/index',true));

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

			$password = isset($_POST["password"])?trim(safe_replace($_POST["password"])):exit(json_encode(array('status'=>false,'tips'=>'密码不能为空')));
			if($password=='')exit(json_encode(array('status'=>false,'tips'=>'密码不能为空')));

			$repassword = isset($_POST["repassword"])?trim(safe_replace($_POST["repassword"])):exit(json_encode(array('status'=>false,'tips'=>'密码不能为空')));
			if($repassword=='')exit(json_encode(array('status'=>false,'tips'=>'重复密码不能为空')));
			if($repassword!=$password)exit(json_encode(array('status'=>false,'tips'=>'密码输入不一样')));
			$encrypt = random_string('alnum',5);
			$password = md5(md5($password.$encrypt));


			$email = isset($_POST["email"])?trim(safe_replace($_POST["email"])):exit(json_encode(array('status'=>false,'tips'=>'EMAIL不能为空')));
			if($email=='')exit(json_encode(array('status'=>false,'tips'=>'EMAIL不能为空')));
			if(!is_email($email))
			{
				exit(json_encode(array('status'=>false,'tips'=>'EMAIL格式不正确')));
			}

			$group_id= isset($_POST["group_id"])?intval($_POST["group_id"]):exit(json_encode(array('status'=>false,'tips'=>'用户组不能为空')));
			if($group_id==0)
			{
				exit(json_encode(array('status'=>false,'tips'=>'用户组不能为空')));
			}


			$mobile= isset($_POST["mobile"])?trim(safe_replace($_POST["mobile"])):exit(json_encode(array('status'=>false,'tips'=>'手机号不能为空')));
			if(!is_mobile($mobile)){
				exit(json_encode(array('status'=>false,'tips'=>'手机号格式不正确')));
			}

			$fullname= isset($_POST["fullname"])?trim(safe_replace($_POST["fullname"])):exit(json_encode(array('status'=>false,'tips'=>'全名不能为空')));
			$thumb= isset($_POST["thumb"])?trim(safe_replace($_POST["thumb"])):exit(json_encode(array('status'=>false,'tips'=>'成员图像不能为空')));
			$is_lock= isset($_POST["is_lock"])?intval($_POST["is_lock"]):exit(json_encode(array('status'=>false,'tips'=>'是否锁定登录不能为空')));

			if($this->check_username($username))exit(json_encode(array('status'=>false,'tips'=>'用户名已经存在')));
						$new_id = $this->Member_model->insert(
												array(
													'username'=>$username,
													'password'=>$password,
													'group_id'=>$group_id,
													'email'=>$email,
													'mobile'=>$mobile,
													'fullname'=>$fullname,
													'is_lock'=>$is_lock,
													'avatar'=>$thumb,
													'reg_time'=>date('Y-m-d H:i:s'),
													'encrypt'=>$encrypt,
													'reg_ip'=>$this->input->ip_address(),
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
