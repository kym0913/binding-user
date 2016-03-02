<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_token extends Base_Model {


    function __construct()
	{
		  parent::__construct();
	}

    /**
     * 安装SQL表
     * @return void
     */
    function getcachetoken()
    {
      $data=$this->db->get('t_sys_token');
    }
    function updatecachetoken($value,$expired)
    {
      $data=array(
        'token_value'=>'$value',
        'token_expire'=>'$expired',
      );
      $this->db->update('t_sys_token',$data,array('token_id'=>'0001'));
    }
}

// END role_model class

/* End of file role_model.php */
/* Location: ./role_model.php */
?>
