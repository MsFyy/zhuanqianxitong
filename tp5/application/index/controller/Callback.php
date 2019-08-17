<?php
namespace app\index\controller;
use think\Controller;
use think\Image;
use think\Request;
use think\Loader;
Loader::import('wxpay.lib.WxPay',EXTEND_PATH,'.Api.php');
Loader::import('wxpay.lib.WxPay',EXTEND_PATH,'.Notify.php');
Loader::import('wxpay.example.WxPay',EXTEND_PATH,'.Config.php');
class Callback extends Controller
{
    public function index()
    { 
       //实例化config
        $config = new \WxPayConfig();
        $xml=file_get_contents('php://input'); 
        $data=file_put_contents('temp/1.txt',$xml,FILE_APPEND);
       //把xml数据转化为数组
        $resultdata = new \WxPayNotifyResults();
        $result =$resultdata->Init($config, $xml);
         //dump($result);
         //获取设置的值GetValues
        $data = $result->GetValues();
        $out_trade_no=$data['out_trade_no'];
        $transaction_id=$data['transaction_id'];
        //dump($data);exit;
        //TODO 1、进行参数校验 
        if(!array_key_exists("return_code", $data) //array_key_exists函数作用是检查$data数据中是否含有return_code
            ||(array_key_exists("return_code", $data) && $data['return_code'] != "SUCCESS")) {
            //TODO失败,不是支付成功的通知
            //如果有需要可以做失败时候的一些清理处理，并且做一些监控
            $msg = "异常异常";
            return false;
        }
        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }

        //TODO 2、进行签名验证
        try {
            $checkResult = $result->CheckSign($config);
            if($checkResult == false){
                //签名错误
                Log::ERROR("签名错误...");
                return false;
            }
        } catch(Exception $e) {
            Log::ERROR(json_encode($e));
        }

        //TODO 3、处理业务逻辑
        $pay=model('Dingdan')->get(['trade_no'=>$out_trade_no]);
        if(!$pay||$pay->pay_status==2){
           $resultdata->SetData('return_code','SUCCESS');
           $resultdata->SetData('return_msg','OK');
           return $resultdata->ToXml(); 
        }
        try {
           $res=model('Dingdan')->updatepay($out_trade_no,$transaction_id);
        } catch(Exception $e) {
            return false;
        }
        
        
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }
        $resultdata->SetData('return_code','SUCCESS');
        $resultdata->SetData('return_msg','OK');
        return $resultdata->ToXml();
    }
    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);

        $config = new \WxPayConfig();
        $result = \WxPayApi::orderQuery($config, $input);
        // Log::DEBUG("query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["return_msg"] == "OK")
        {
            return true;
        }
        return false;
    }
}
