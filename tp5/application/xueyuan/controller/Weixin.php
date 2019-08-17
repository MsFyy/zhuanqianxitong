<?php
namespace app\xueyuan\controller;
use think\Controller;
class Weixin extends Controller
{
    public function index()
    {   
        return $this->fetch();
    }  
    public function weixindenglu()
    {   
        $tuijianxueyuanid=input('param.tuijianxueyuanid');
        $tuijianxueyuanleixing=input('param.tuijianxueyuanleixing');
        session('tuijianxueyuanid',$tuijianxueyuanid);
        session('tuijianxueyuanleixing', $tuijianxueyuanleixing);
        //应用的APPid
        $appid = "wx9b4c1c349c406ea7";
       //回调地址
        $redirect_uri = urlencode("http://zhuanqian.dezhouyilian.com/public/index.php/xueyuan/weixin/weixinhuidiao");

        $url = "https://open.weixin.qq.com/connect/qrconnect?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
       // 第一步：获取 Code
        header("location:".$url);
    }  
    public function weixinhuidiao()
    {     
        $appid = "wx9b4c1c349c406ea7";
        $appsecret = "2023088f5411004538ae98a205e055ba"; 
        $code = $_GET["code"];
         //dump($code);exit;
        //第二步获取网页授权的access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";

        //请求 $url 返回一个json    json_decode不加 true 会将json转为对象，加true转为数组
        $res = json_decode(file_get_contents($url),true);
        //dump($res);exit;
        //获取access_token并赋值给变量
        $access_token = $res["access_token"];
        //dump($access_token);exit;
        //获取openid并赋值给变量
        $openid = $res["openid"];
        $urlyonghu = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $yonghu = json_decode(file_get_contents($urlyonghu),true);
        $uid=$yonghu["unionid"];
        //dump($yonghu);exit;
        session('uid',$uid);
        $re=model('Weixinxueyuan')->get(['uid'=>$uid]);
        if(!$re){
          $weixin=[
          'openid'=>$openid,
          'uid'=>$uid,
          'username'=>$yonghu["nickname"],
          'image'=>$yonghu["headimgurl"],
          'zhuangtai'=>1,
          'leixing'=>1,
          'tuijianxueyuanid' => session('tuijianxueyuanid'),
          'tuijianxueyuanleixing' => session('tuijianxueyuanleixing'), 
          ];
          $r=model('Weixinxueyuan')->save($weixin);
           if($r){
            $this->success('注册成功',url('weixinlogin'));
           }else{
            $this->error('注册失败');
           }
        }else{
          $this->redirect('weixinlogin');
        }
    }  
     public function weixinlogin()
    {   
        $res=model('Weixinxueyuan')->get(['uid'=>session('uid')]);
        if(!$res){
          $this->error('你不是本站的微信会员');
        }else{
          session('xueyuanname',$res->username);
          session('image',$res->image);
          session('id',$res->id);
          session('leixing',$res->leixing);
        }
        return $this->redirect('index/index/index');
    }  
    public function qianduanweixinlogin()
      { 
         $appid = "wx9b4c1c349c406ea7";
        //回调地址
        $redirect_uri = urlencode("http://zhuanqian.dezhouyilian.com/public/index.php/xueyuan/weixin/weixinqianduan");
         $url = "https://open.weixin.qq.com/connect/qrconnect?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
       // 第一步：获取 Code
       // echo '2';exit;
        header("location:".$url);
    }
     public function weixinqianduan()
      { 
        $appid = "wx9b4c1c349c406ea7";
        $appsecret = "2023088f5411004538ae98a205e055ba"; 
        $code = $_GET["code"];
         //dump($code);exit;
        //第二步获取网页授权的access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";

        //请求 $url 返回一个json    json_decode不加 true 会将json转为对象，加true转为数组
        $res = json_decode(file_get_contents($url),true);
        //dump($res);exit;
        //获取access_token并赋值给变量
        $access_token = $res["access_token"];
        //dump($access_token);exit;
        //获取openid并赋值给变量
        $openid = $res["openid"];
        $urlyonghu = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $yonghu = json_decode(file_get_contents($urlyonghu),true);
        $uid=$yonghu["unionid"];
        //dump($yonghu);exit;
        session('uid',$uid);
        $re=model('Weixinxueyuan')->get(['uid'=>$uid]);
        //dump($re);exit;
        if(!$re){
          $this->error('不是本站注册学员，不能进行登录',url('index/index/index'));
        }else{
          $this->redirect('weixinlogin');
        }
    }
}
