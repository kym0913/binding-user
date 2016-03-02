<?php
$config['wechat'] = array(
  'token'=>'akyayz', //填写你设定的key
  'appid'=>'wx7cf2f38dcfb28d91', //填写高级调用功能的app id
  'appsecret'=>'3b67147276b813bf88a711e00fc17a57', //

  'partnerid'=>'', //财付通商户身份标识
  'partnerkey'=>'', //财付通商户权限密钥Key
  'paysignkey'=>'', //商户签名密钥Key
  'debug'=>true
);

$config['wechat_menu'] = array(
 "button"=>array(
   array(
    "type"=>"pic_photo_or_album",
    "name"=>"我卖",
    "key"=>"upload_pics"
     ),
     array(
    "type"=>"view",
    "name"=>"逛逛",
    "url"=>"http://www.baidu.com/"
     ),
     array(
      "name"=>"我的",
      "sub_button"=>array(
     array(
        "type"=>"view",
        "name"=>"正在出售",
        "url"=>"http://www.baidu.com/"
     ),
     array(
        "type"=>"view",
        "name"=>"个人中心",
        "url"=>"http://www.baidu.com/"
     ),
     array(
        "type"=>"view",
        "name"=>"帮助",
        "url"=>"http://www.baidu.com/"
     )
    )
      )
  )
);
//上传图文消息，自行修改；

$config['articles'] = array(
  "articles"=>array(
      "title"=>"明天也由于",
     "thumb_media_id"=> "_XpB5wxUcy-0x8o1XWYCsownPznAItMypOGIH4Br3y4JndAAoQXQ-_tPh2QVgiTG",
     "author"=>"阿杜",
     "digest"=>"你特码在逗我吗",
     "show_cover_pic"=>'1',
     "content"=>'<p>近日，赵雅芝到敬老院慰问照片被曝出.</p>
     <p>网友表示感叹，同样都是60多岁的老人，如果你不努力，老了之后就会像两代人，
     这简直是老人慰问老人嘛。事实上，赵雅芝看望的老人看上去远大于60岁。</p>
     <img src="http://mmbiz.qpic.cn/mmbiz/vveSJA7L34fWrnMpYNWFMF5WEEkeGGjKVpIjibFYvgqecaeBLmPcbABUwBbWDvFVx7275wIrJDcYSPybQld9G4w/0"  alt="上海鲜花港 - 郁金香" />',
     "content_source_url"=>'www.baidu.com',
   )
  );































?>
