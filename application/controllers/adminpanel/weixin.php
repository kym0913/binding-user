<?php
class Weixin extends MY_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model(array('ulwxanddata'));
    $this->config->load('wechat');
    $options = $this->config->item('wechat');
    $options['logcallback'] = 'logdebug';
    $this->load->library('mywechat', $options);
  }
  public function api()
  {
    $this->mywechat->run();
  }
  public function menu()
  {

    $menus = $this->config->item('wechat_menu');
    $flag = $this->mywechat->createMenu($menus);
    echo $flag;
  }
  public function deletemenu()
  {
    $flag = $this->mywechat->deleteMenu();
    echo $flag;
  }
  public function getMenu()
  {

    $flag = $this->mywechat->getMenu();
    echo var_dump($flag);
  }

  public function uploadImg(){
    $picaddress='C:\Users\LKY\Desktop\CIandACI\aci\uploadfile\pic_id\five.jpg';
    $flag = $this-> mywechat->uploadImg($picaddress);
    echo $flag;
  }

  public function ulartcles(){

    $data = $this->config->item('articles');
    $flag = $this->mywechat->uploadForeverArticles($data);
    echo $flag;
    /*
    $media_name='yangcheng628';
    $type=$flag['type'];
    $media_id=$type=='thumb'?$flag['thumb_media_id']:$flag['media_id'];
    $created_at=$flag['created_at'];
    $result_updata=$this->ulwxanddata->index($type,$media_id,$created_at,$media_name);
    echo !$result_updata?"重复？".$media_id:'success!';
    */
  }
  //上传多媒体素材
  public function tpaulsend(){
    $media_name='beisuzhen';//自行修改
    $filepath='C:\Users\LKY\Desktop\CIandACI\aci\uploadfile\pic_id\twot.jpg'; //  自行修改
    $type="thumb";                    //自行修改
    $this->ulwxanduldata_con($type,$filepath,$media_name);
  }


//上传多媒体素材
  public function ulwxanduldata_con($type,$filepath,$media_name)
  {
  $flag = $this->mywechat->uploadMedia($filepath,$type);
  $type=$flag['type'];
  $media_id=$type=='thumb'?$flag['thumb_media_id']:$flag['media_id'];
  $created_at=$flag['created_at'];
  $result_updata=$this->ulwxanddata->index($type,$media_id,$created_at,$media_name);
  echo !$result_updata?"重复？".$media_id:'success!';
    //echo !$flag?'FALSE':'success';
  }
//get多媒体文件
  public function getmedia()
  {
    //C:\Users\LKY\Desktop\CIandACI\aci\uploadfile\pic_id\download   瞎子啊文件存放路径
    $filename='C:\Users\LKY\Desktop\CIandACI\aci\uploadfile\pic_id\download\down_image1.jpg';
    $media_id="_XpB5wxUcy-0x8o1XWYCsownPznAItMypOGIH4Br3y4JndAAoQXQ-_tPh2QVgiTG";//自行填写
    $flag = $this->mywechat->getMedia($media_id);
    $return=$this->savewxfile($filename,$flag);
    echo $return;

  }
//下载临时素材
  public function savewxfile($filename,$flag)
  {
    $opfile=fopen($filename,'w');
    if($opfile!==false)
    {
      if(fwrite($opfile,$flag)!==false)
      {
        fclose($opfile);
        return $filename;
      }
    }
  }

  function logdebug($text)
  {
    file_put_contents('./upload/log.txt',$text."\n",FILE_APPEND);
  }


}
?>
