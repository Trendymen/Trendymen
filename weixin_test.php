<?php

/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/10/16 0016
 * Time: 20:59
 */
class weixin
{
    public $appID;
    public $appsecret;

    function __construct($appID, $appsecret)
    {
        $this->appID = $appID;
        $this->appsecret = $appsecret;
    }

    function request($curl, $https = true, $method = 'GET', $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;

    }

    function getAcessToken()
    {
     $file='./accesstoken';
        if(file_exists($file)){
            $content=json_decode(file_get_contents($file));
            if(time()-filemtime($file)<$content->expires_in)
                return $content->access_token;
        }
        else
        {
            $curl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appID . '&secret=' . $this->appsecret;
            $content=$this->request($curl);
            file_put_contents($file,$content);
            $content = json_decode($content);

            return $content->access_token;
        }
    }
    function getTicket($secneid,$type='temp',$second=604800)
    {
        if($type=="temp")
        {
            $data='{"expire_seconds": %s, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": %s}}}';
            $data=sprintf($data,$second,$secneid);
        }
        else
        {
            $data='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": %s}}';
            $data=sprintf($data,$secneid);
        }
        $curl="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->getAcessToken();
        $content=json_decode($this->request($curl,true,'POST',$data));
        return $content->ticket;
    }
    function getqrcode($secneid,$type='temp',$second=604800)
    {
     $ticket=$this->getTicket($secneid,$type,$second);
     return $curl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket);
    }
}

$weixin = new weixin('wx799eea84f378e9a0', '805ba596dd599ffad749ea974ebe5d2f');
echo $weixin->getTicket(1)."<br>";
?>
<img src="<?php echo $weixin->getqrcode(1)?>">


