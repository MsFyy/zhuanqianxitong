<?php
namespace app\xueyuan\controller;
use think\Controller;
class Shouru extends Base
{
    public function gaofei()
    {   
    	$id=session('id');
        $leixing=session('leixing');
        $gaofei=model('gaofei')->gaofei($id,$leixing);
        $this->assign('gaofei',$gaofei);
        return $this->fetch();
    }   
    public function tuiguangyongjin()
    {    
    	$id=session('id');
        $leixing=session('leixing');
        $yongjin=model('tuiguangyongjin')->tuiguangyongjin($id,$leixing);
        $this->assign('yongjin',$yongjin);
        return $this->fetch();
    }  
    public function zhaoshangyongjin()
    {   
    	$id=session('id');
        $leixing=session('leixing');
        $yongjin=model('zhaopinyongjin')->zhaoshangyongjin($id,$leixing);
        $this->assign('yongjin',$yongjin);
        return $this->fetch();
    } 
}
