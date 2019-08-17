<?php
namespace app\xueyuan\controller;
use think\Controller;
use think\Request;
use think\Image;
class Fenxiang extends Base
{
    //课程目录的输出
    public function fenxiang()
    {   
      $id=session('id');
      $leixing=session('leixing');
      $fenxiang=model('Fenxiang')->getfenxiang($id,$leixing);
    	$this->assign('fenxiang',$fenxiang);
        return $this->fetch();
    }  
    public function fenxiangupdate()
    {   
      $id=input('post.id');
      $data=input('post.');
      $xueyuanid=session('id');
      $xueyuanleixing=session('leixing');
      $fenxiang = [
              'xueyuanleixing' =>$xueyuanleixing,
              'xueyuanid' => $xueyuanid,
              'content' => $data['content'], 
               ];
      $res=model('Fenxiang')->save($fenxiang,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }
    }  
   
}