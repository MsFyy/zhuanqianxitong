<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;
use think\Loader;
Loader::import('malipay.wappay.service.AlipayTradeService');
Loader::import('malipay.wappay.buildermodel.AlipayTradeWapPayContentBuilder');
class Zfbpaym extends Base
{
       public function index()
       {
        //判断学员是否登录
        include EXTEND_PATH.'malipay/config.php';
        if(!session('xueyuanname')){
          $this->error('你尚未登录，请进行登录','wxpay/login');
        }
         
        $wenzhangid=input('wenzhangid');
        // dump($wenzhangid);exit;
        $neirong=model('neirong')->get($wenzhangid); 
        $shujishu=mt_rand(100,1000000);
        $trade_no=$shujishu.time();
        $order=[
           'trade_no'=>$trade_no,//订单号
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

    // //商户订单号，商户网站订单系统中唯一订单号，必填
    // $out_trade_no = trim($_POST['WIDout_trade_no']);

    // //订单名称，必填
    // $subject = trim($_POST['WIDsubject']);

    // //付款金额，必填
    // $total_amount = trim($_POST['WIDtotal_amount']);

    // //商品描述，可空
    // $body = trim($_POST['WIDbody']);

  //构造参数
      $body = $neirong->name;
      $subject=$neirong->name;
      $total_amount=$neirong->jiage;
      $out_trade_no=$trade_no;
      $timeout_express="1m";
      $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
      $payRequestBuilder->setBody($body);
      $payRequestBuilder->setSubject($subject);
      $payRequestBuilder->setTotalAmount($total_amount);
      $payRequestBuilder->setOutTradeNo($out_trade_no);
      $payRequestBuilder->setTimeExpress($timeout_express);
      $payResponse = new \AlipayTradeService($config);
      $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        return ;   
    }  

   public function login()
     {  
      return $this->fetch(); 
     }
   public function notify()
    { 
        
        include EXTEND_PATH.'malipay/config.php';
        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config); 
        $alipaySevice->writeLog(var_export($_POST,true));
        
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代


        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

        //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

        //商户订单号

        $out_trade_no = $_POST['out_trade_no'];

        //支付宝交易号

        $transaction_id = $_POST['trade_no'];

        //交易状态
        $trade_status = $_POST['trade_status'];
       //交易金额
        $total_amount = $_POST['total_amount'];

        $pay=model('Dingdan')->get(['trade_no'=>$out_trade_no]);
        
        if($_POST['trade_status'] == 'TRADE_FINISHED') {
             
             if(!$pay||$pay->pay_status==2){
                 echo "success"; 
             }
             if(!$pay->price==$total_amount){
                 echo "fail";
             }
            try{
                $res=model('Dingdan')->updatepay($out_trade_no,$transaction_id);
            }catch(Exception $E){
                echo "fail";
            }
            //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                    
            //注意：
            //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
        }
        else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
             if(!$pay||$pay->pay_status==2){
                 echo "success"; 
             }
             if(!$pay->price==$total_amount){
                 echo "fail";
             }
            try{
                $res=model('Dingdan')->updatepay($out_trade_no,$transaction_id);
            }catch(Exception $E){
                echo "fail";
            }
            //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序            
            //注意：
            //付款完成后，支付宝系统发送该交易状态通知
        }
        //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        echo "success"; //请不要修改或删除
        }else {
        //验证失败
        echo "fail";

        }
}
          //判断支付状态，进行返回，分别写入相应的收入数据表
         public function return()
           {  
            include EXTEND_PATH.'alipay/config.php';
            //商户订单号
             $out_trade_no = $_GET['out_trade_no'];

               //支付宝交易号
            $trade_no = $_GET['trade_no'];
            $res=model('Dingdan')->get(['trade_no'=>$out_trade_no]);
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
               $this->success('成功', 'Index/index');
             }else{
                $this->error('失败', 'Index/index');
             }
           }
           public function paysuccess()
           {  
             return $this->fetch();   
           }
 

}
