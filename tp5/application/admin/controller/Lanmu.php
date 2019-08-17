<?php
namespace app\admin\controller;
use think\Controller;
class Lanmu extends Base
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
    public function lanmuadd()
    {  
       $dalei=model('Lanmu')->getdalei();
       $this->assign('dalei',$dalei);
      return $this->fetch();
    }  
     public function lanmusave()
    {  
       $data=input('post.');
       $validate = validate('Lanmu');
      if(!$validate->scene('gongneng')->check($data)){
       $this->error($validate->getError());
      }
       $res=model('Lanmu')->save($data);
       if($res){
        $this->success('添加成功','lanmu/lanmulist');
      }else{
        $this->error('添加失败');
      }
    }  
     public function lanmulist()
    {   
      $lanmulist=model('Lanmu')->getlist();
       $this->assign('lanmulist',$lanmulist);
      return $this->fetch();
    }  
     public function lanmuedit()
    { 

      $id=input('param.id'); 
      $lanmulist=model('Lanmu')->getlist();
       $this->assign('lanmulist',$lanmulist);
      $lanmu=model('Lanmu')->get($id);
      //dump($gongneng);exit;
      $this->assign('lanmu',$lanmu);
      return $this->fetch();
    }  
    public function lanmueditb()
    { 
      $id=input('param.id'); 
      $lanmu=model('Lanmu')->get($id);
      //dump($gongneng);exit;
      $this->assign('lanmu',$lanmu);
      return $this->fetch();
    }  
    public function lanmueditsave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $res=model('Lanmu')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功','lanmu/lanmulist');
      }else{
        $this->error('更新失败');
      }
    }  
    public function lanmudelete()
    {  
      $data=input('param.');
      $jiancha=model('Lanmu')->zileijiancha($data['id']);
      if($jiancha){
        $this->error('请先删除子类');
      }
      //dump($data);exit;
      $res=model('Lanmu')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功','lanmu/lanmulist');
      }else{
        $this->error('删除失败');
      }
    }  
}
