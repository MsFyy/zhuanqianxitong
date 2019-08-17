<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;
use think\Loader;
 Loader::import('wxpay.lib.WxPay', EXTEND_PATH,'.Api.php');
 Loader::import('wxpay.example.log', EXTEND_PATH,'.php');
 Loader::import('wxpay.example.WxPay', EXTEND_PATH,'.Config.php');
class Wxpaymh extends Base
{
       public function index()
       {
        //判断学员是否登录
        if(!session('xueyuanname')){
          $this->error('你尚未登录，请进行登录','wxpay/login');
        }
        $wenzhangid=input('wenzhangid');
        $neirong=model('neirong')->get($wenzhangid); 
        $shujishu=mt_rand(100,1000000);
        $order=[
           'trade_no'=>$shujishu.time(),//订单号
           'wenzhangid'=>$neirong->id,
           'zuozheid'=>$neirong->zuozheid,
           'zuozheleixing'=>$neirong->zuozheleixing,
           'xueyuanid'=>session('id'),
           'xueyuanleixing'=>session('leixing'),
           'price'=>$neirong->jiage,
           'pay_status'=>1,
           'create_time'=>time(),
        ];
        // dump($order);
        $id=model('Dingdan')->insertGetId($order);
        if(!$id){
            $this->erorr('订单失败');
        }
        // $tools = new \JsApiPay();
        //  //dump($tools);exit;
        //  $openId = $tools->GetOpenid();

         //②、统一下单
         $input = new \WxPayUnifiedOrder();
          // dump($openId);exit;
        $input->SetBody($neirong->name);//物品名称
        $input->SetAttach("test");
        $input->SetOut_trade_no($shujishu.time());//系统订单号
        $input->SetTotal_fee($neirong->jiage*100);//金额
        $input->SetTime_start(date("YmdHis"));//订单时间
        $input->SetTime_expire(date("YmdHis", time() + 600));//有效时间
        $input->SetGoods_tag("test");//说明
        $input->SetNotify_url("http://zhuanqian.dezhouyilian.com/public/index.php/Index/Callback");//回调地址
        $input->SetProduct_id($neirong->id);//商品id号
        $input->SetTrade_type("MWEB");
        // $input->SetOpenid($openId);
        $config = new \WxPayConfig();
        $order = \WxPayApi::unifiedOrder($config, $input);
        $url=$order['mweb_url'];
        // dump($url);exit;
        $this->assign('neirong',$neirong);
        $this->assign('url',$url);
        $this->assign('id',$id);
        return $this->fetch();  
       
    }   
   public function login()
       {  
        return $this->fetch(); 
     }
}
