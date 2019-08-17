<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;
use think\Loader;
Loader::import('wxpay.lib.WxPay',EXTEND_PATH,'.Api.php');
Loader::import('wxpay.example.WxPay',EXTEND_PATH,'.NativePay.php');
Loader::import('wxpay.example.phpqrcode.phpqrcode',EXTEND_PATH,'.php');
class Wxpay extends Base
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
        $id=model('Dingdan')->insertGetId($order);
        if(!$id){
            $this->erorr('订单失败');
        }
        $input = new \WxPayUnifiedOrder();
        $notify = new \NativePay();
        $input->SetBody($neirong->name);//物品名称
        $input->SetAttach("test");
        $input->SetOut_trade_no($shujishu.time());//系统订单号
        $input->SetTotal_fee($neirong->jiage*100);//金额
        $input->SetTime_start(date("YmdHis"));//订单时间
        $input->SetTime_expire(date("YmdHis", time() + 600));//有效时间
        $input->SetGoods_tag("test");//说明
        $input->SetNotify_url("http://zhuanqian.dezhouyilian.com/public/index.php/Index/Callback");//回调地址
        $input->SetTrade_type("NATIVE");//支付类型
        $input->SetProduct_id($neirong->id);//商品id号

        $result = $notify->GetPayUrl($input);//获取
        //dump($result);exit;
        $url2 = $result["code_url"];//二维码
        $this->assign('neirong',$neirong);
        $this->assign('url2',$url2);
        $this->assign('id',$id);
        return $this->fetch();   
       
    }   
       public function login()
           {  
            return $this->fetch(); 
         }
          //二维码
          public function erweima()
         {  
          $url = urldecode($_GET["data"]);
          if(substr($url, 0, 6) == "weixin"){
              \QRcode::png($url);
          }else{
               header('HTTP/1.1 404 Not Found');
          }
          }
          //判断支付状态，进行返回，分别写入相应的收入数据表
         public function paystatus($id)
           {  
            $res=model('Dingdan')->get($id);
            //dump($res);exit;
            if($res->pay_status==2){
               // 一、稿费写入
               $r1=model('Gaofei')->get(['dingdanhao'=>$res->trade_no]);
               if(!$r1){
                 $gaofei=[
                'dingdanhao'=>$res->trade_no,
                'wenzhangid'=>$res->wenzhangid,
                'shouruzheid'=>$res->zuozheid,
                'shouruzheleixing'=>$res->zuozheleixing,
                'xueyuanid'=>$res->xueyuanid,
                'xueyuanleixing'=>$res->xueyuanleixing,
                'shouru'=>($res->price)*0.6,
               ]; 
                $id1=model('Gaofei')->insert($gaofei);
               }
               //二、推广佣金               
               $r2=model('Tuiguangyongjin')->get(['dingdanhao'=>$res->trade_no]);
                if(!$r2){
                 //查询推广者
                    if($res->xueyuanleixing==1){
                        $xueyuan=model('Weixinxueyuan')->get($res->xueyuanid);
                        $shouruzheid=$xueyuan->tuijianxueyuanid;
                        $shouruzheleixing=$xueyuan->tuijianxueyuanleixing;

                    }elseif($res->xueyuanleixing==2){
                        $xueyuan=model('qqxueyuan')->get($res->xueyuanid);
                        $shouruzheid=$xueyuan->tuijianxueyuanid;
                        $shouruzheleixing=$xueyuan->tuijianxueyuanleixing;

                    }elseif($res->xueyuanleixing==3){
                        $xueyuan=model('zhucexueyuan')->get($res->xueyuanid);
                        $shouruzheid=$xueyuan->tuijianxueyuanid;
                        $shouruzheleixing=$xueyuan->tuijianxueyuanleixing;
                    }
                    
                     $tuiguangyongjin=[
                    'dingdanhao'=>$res->trade_no,
                    'wenzhangid'=>$res->wenzhangid,
                    'shouruzheid'=>$shouruzheid,
                    'shouruzheleixing'=>$shouruzheleixing,
                    'xueyuanid'=>$res->xueyuanid,
                    'xueyuanleixing'=>$res->xueyuanleixing,
                    'shouru'=>($res->price)*0.1,
                   ]; 
                   $id2=model('Tuiguangyongjin')->insert($tuiguangyongjin);
                 }
                //三、招聘佣金
               $r3=model('Zhaopinyongjin')->get(['dingdanhao'=>$res->trade_no]);
                   if(!$r3){
                     //查询招聘者
                    if($res->zuozheleixing==1){
                        $zuozhe=model('Weixinxueyuan')->get($res->zuozheid);
                        $shouruzheid=$zuozhe->tuijianxueyuanid;
                        $shouruzheleixing=$xueyuan->tuijianxueyuanleixing;

                    }elseif($res->zuozheleixing==2){
                        $zuozhe=model('qqxueyuan')->get($res->zuozheid);
                        $shouruzheid=$zuozhe->tuijianxueyuanid;
                        $shouruzheleixing=$zuozhe->tuijianxueyuanleixing;

                    }elseif($res->zuozheleixing==3){
                        $zuozhe=model('zhucexueyuan')->get($res->zuozheid);
                        $shouruzheid=$zuozhe->tuijianxueyuanid;
                        $shouruzheleixing=$zuozhe->tuijianxueyuanleixing;
                    }
                    
                     $zhaopinyongjin=[
                    'dingdanhao'=>$res->trade_no,
                    'wenzhangid'=>$res->wenzhangid,
                    'shouruzheid'=>$shouruzheid,
                    'shouruzheleixing'=>$shouruzheleixing,
                    'xueyuanid'=>$res->xueyuanid,
                    'xueyuanleixing'=>$res->xueyuanleixing,
                    'shouru'=>($res->price)*0.1,
                   ]; 
                   $id3=model('Zhaopinyongjin')->insert($zhaopinyongjin);
                  }
             $this->success();
             }else{
                $this->error();
             }
           }
           public function paysuccess()
           {  
             return $this->fetch();   
           }
 

}
