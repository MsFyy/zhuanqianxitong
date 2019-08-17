<?php
namespace app\index\model;
use think\Model;
class Dingdan extends Model
{
    public function updatepay($out_trade_no,$transaction_id) {
        if(!empty($transaction_id)){
        	$data['transaction_id']=$transaction_id;
        	$data['pay_status']=2;
        }
        return $this->allowField(true)
                    ->save($data,['trade_no'=>$out_trade_no]);

    }
     

}
