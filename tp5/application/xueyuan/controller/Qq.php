<?php
namespace app\xueyuan\controller;
use think\Controller;
class Qq extends Controller
{
    public function qq()
    { 
      return $this->fetch();
    }
    public function qqdenglu()
    { 
        $tuijianxueyuanid=input('param.tuijianxueyuanid');
        $tuijianxueyuanleixing=input('param.tuijianxueyuanleixing');
        session('tuijianxueyuanid',$tuijianxueyuanid);
        session('tuijianxueyuanleixing', $tuijianxueyuanleixing);
        $appid = "101521407";
       //回调地址
        $redirect_uri = urlencode("http://zhuanqian.dezhouyilian.com/public/index.php/xueyuan/qq/token");
     
        $url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$appid."&redirect_uri=".$redirect_uri."&scope=snsapi_userinfo&state=text";
        //跳转到 $url
       // Step1：获取Authorization Code
        header("location:".$url);
    }
    public function token()
    { 
       
      // $code = $_GET["code"];
      // dump($code);exit;
       //应用的APPID
      $app_id = "101521407";
      //应用的APPKEY
      $app_secret = "caa9644b9fcfd78942549edbe977ef8e";
      //成功授权后的回调地址
      $my_url = "http://zhuanqian.dezhouyilian.com/public/index.php/index/xueyuan/token";
      //获取code
         $code = $_GET["code"];
         //dump($code);exit;
         //Step2：获取access_token
         $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=".$app_id."&redirect_uri=" . urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."";
         $response = file_get_contents($token_url);
         //dump($response);exit;
         //Step3：使用Access Token来获取用户的OpenID
         $params = array();
         parse_str($response, $params);
         //dump($params);exit;
         $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token']."";
        $str  = file_get_contents($graph_url);
        //dump($str);exit;
         if (strpos($str, "callback") !== false)
         {
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
         }
         $user = json_decode($str); 
          //dump($user);exit;
          //dump($user->openid);exit;
         $kehu = "https://graph.qq.com/user/get_user_info?access_token=".$params['access_token']."&oauth_consumer_key=" . $app_id . "&openid=" . $user->openid."";
           session('openid',$user->openid);
           $res = json_decode(file_get_contents($kehu),true);
           //dump($res);exit;
           $re=model('Qqxueyuan')->get(['openid'=>$user->openid]);
           if(!$re){
                $qq=[
                  'openid'=>$user->openid,
                  'username'=>$res['nickname'],
                  'image'=>$res['figureurl_qq_2'],
                  'zhuangtai'=>1,
                  'leixing'=>2,
                  'tuijianxueyuanid' => session('tuijianxueyuanid'),
                'tuijianxueyuanleixing' => session('tuijianxueyuanleixing'), 
                ];
                $r=model('Qqxueyuan')->save($qq);
                if($r){
                  $this->success('注册成功',url('qqlogin'));
                }else{
                  $this->error('注册失败');
                }

           }else{
            $this->redirect('qqlogin');
           }
    }
     public function qqlogin()
      { 
        $res=model('Qqxueyuan')->get(['openid'=>session('openid')]);
        if(!$res){
          $this->error('不是本站会员');
        }else{
          session('xueyuanname',$res->username);
          session('id',$res->id);
          session('leixing',$res->leixing);
          session('image',$res->image);
        }
        return $this->redirect('index/index/index');
    }
    public function qianduanqqlogin()
      { 
         $appid = "101521407";
         $redirect_uri = urlencode("http://zhuanqian.dezhouyilian.com/public/index.php/xueyuan/qq/callback");
     
        $url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$appid."&redirect_uri=".$redirect_uri."&scope=snsapi_userinfo&state=text";
        //跳转到 $url
       // Step1：获取Authorization Code
        header("location:".$url);
    }
    public function callback()
    { 
       
      // $code = $_GET["code"];
      // dump($code);exit;
       //应用的APPID
      $app_id = "101521407";
      //应用的APPKEY
      $app_secret = "caa9644b9fcfd78942549edbe977ef8e";
      //成功授权后的回调地址
      $my_url = "http://zhuanqian.dezhouyilian.com/public/index.php/xueyuan/qq/callback";
      //获取code
         $code = $_GET["code"];
         //dump($code);exit;
         //Step2：获取access_token
         $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=".$app_id."&redirect_uri=" . urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."";
         $response = file_get_contents($token_url);
         //dump($response);exit;
         //Step3：使用Access Token来获取用户的OpenID
         $params = array();
         parse_str($response, $params);
         //dump($params);exit;
         $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token']."";
        $str  = file_get_contents($graph_url);
        //dump($str);exit;
         if (strpos($str, "callback") !== false)
         {
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
         }
         $user = json_decode($str); 
          //dump($user);exit;
          //dump($user->openid);exit;
         $kehu = "https://graph.qq.com/user/get_user_info?access_token=".$params['access_token']."&oauth_consumer_key=" . $app_id . "&openid=" . $user->openid."";
           session('openid',$user->openid);
           $res = json_decode(file_get_contents($kehu),true);
           //dump($res);exit;
           $re=model('Qqxueyuan')->get(['openid'=>$user->openid]);
           if(!$re){      
             $this->error('不是本站注册学员，不能进行登录',url('index/index'));
           }else{
            $this->redirect('qqlogin');
           }
    }

}
