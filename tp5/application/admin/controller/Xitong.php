<?php
namespace app\admin\controller;
use think\Controller;
class Xitong extends Base
{
    public function index()
    {   
      $xitong=model('xitong')->get(1);
      //dump($xitong);exit;
      $this->assign('xitong',$xitong);
      return $this->fetch();
    }  
    public function editsave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $res=model('Xitong')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功','index');
      }else{
        $this->error('更新失败','index');
      }
    }  
    public function youhua()
    {   
      $youhua=model('youhua')->get(1);
      //dump($xitong);exit;
      $this->assign('youhua',$youhua);
      return $this->fetch();
    }  
    public function edityouhuasave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $res=model('Youhua')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功','xitong/youhua');
      }else{
        $this->error('更新失败','xitong/youhua');
      }
    }  
    public function gongnengadd()
    {  
       $dalei=model('Gongneng')->getdalei();
       $this->assign('dalei',$dalei);
      return $this->fetch();
    }  
     public function gongnengsave()
    {  
       $data=input('post.');
       $validate = validate('Xitong');
      if(!$validate->scene('gongneng')->check($data)){
       $this->error($validate->getError());
      }
       $res=model('Gongneng')->save($data);
       if($res){
        $this->success('添加成功','xitong/gongnenglist');
      }else{
        $this->error('添加失败');
      }
    }  
     public function gongnenglist()
    {  
       
      return $this->fetch();
    }  
     public function gongnengedit()
    { 
      $id=input('param.id'); 
      $gongneng=model('Gongneng')->get($id);
      //dump($gongneng);exit;
      $this->assign('gongneng',$gongneng);
      return $this->fetch();
    }  
    public function gongnengeditb()
    { 
      $id=input('param.id'); 
      $gongneng=model('Gongneng')->get($id);
      //dump($gongneng);exit;
      $this->assign('gongneng',$gongneng);
      return $this->fetch();
    }  
    public function gongnengeditsave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $res=model('Gongneng')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功','xitong/gongnenglist');
      }else{
        $this->error('更新失败');
      }
    }  
    public function gongnengdelete()
    {  
      $data=input('param.');
      $jiancha=model('Gongneng')->zileijiancha($data['id']);
      if($jiancha){
        $this->error('请先删除子类');
      }
      //dump($data);exit;
      $res=model('Gongneng')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功','xitong/gongnenglist');
      }else{
        $this->error('删除失败');
      }
    }  
}
