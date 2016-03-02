<?php
class Ulwxanddata extends Base_Model {


    function __construct()
	{
      $this->db_tablepre = 't_sys_';
      $this->table_name = 'media';
		  parent::__construct();
	}

  function index($type,$media_id,$created_at,$media_name){

    $data = array('type' => $type,'media_id' => $media_id,'created_at' =>$created_at,'media_name' =>$media_name);
    $infodata=$this->insert($data);
    if($infodata){
      return True;
    }
  }

  function thumbid($id1,$id2,$id3){
    $data1=$this->get_one(array('medias_id' =>$id1));
    $data2=$this->get_one(array('medias_id' =>$id2));
    $data3=$this->get_one(array('medias_id' =>$id3));
    return $data1;
    return $data2;
    return $data3;
  }

// END role_model class

/* End of file role_model.php */
/* Location: ./role_model.php */
}
?>
