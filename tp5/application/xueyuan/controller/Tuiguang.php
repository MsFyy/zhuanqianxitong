<?php
namespace app\xueyuan\controller;
use think\Controller;
class Tuiguang extends Controller
{
    public function index()
    {   
      $leixing=input('param.leixing');
      $id=input('param.id');
       if($leixing==1){
          $xinxi=model('Weixinxueyuan')->get($id);
          $tuiguangxinxi=model('Fenxiang')->getfenxiang($id,$leixing);
        }elseif($leixing==2){
         $xinxi=model('Qqxueyuan')->get($id);
         $tuiguangxinxi=model('Fenxiang')->getfenxiang($id,$leixing);
        }elseif($leixing==3){
         $xinxi=model('Zhucexueyuan')->get($id);
         $tuiguangxinxi=model('Fenxiang')->getfenxiang($id,$leixing);
        }
      $this->assign('xinxi',$xinxi);
      $this->assign('tuiguangxinxi',$tuiguangxinxi);
      return $this->fetch();
    }  
}
