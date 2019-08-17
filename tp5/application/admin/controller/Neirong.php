<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Image;
class neirong extends Base
{
    public function neironglist()
    {   
    	$neirong=model('Neirong')->getneirong();
    	$this->assign('neirong',$neirong);
        return $this->fetch();
    }  
    public function neirongzhuangtai()
    {  
      $data=input('param.');
      $res=model('Neirong')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('操作成功');
      }else{
        $this->error('操作失败');
      }
    } 
     
    public function neirongpaixu()
    { 
      $id=input('param.id'); 
      $neirong=model('Neirong')->get($id);
      //dump($neirong);exit;
      $this->assign('neirong',$neirong);
      return $this->fetch();
    }  
    public function neirongpaixuupdate()
    { 
      $id=input('param.id'); 
      $paixu=input('param.paixu'); 
      $res=model('Neirong')->gengxinpaixu($id,$paixu);
       if($res){
        $this->success('操作成功',url('neironglist'));
        }else{
        $this->error('操作失败',url('neironglist'));
        }
    }  
}