<?php
namespace app\admin\controller;
use think\Controller;
class Daohang extends Base
{
    public function daohanglist()
    {   
    	$daohang=model('Daohang')->getdaohang();
    	$this->assign('daohang',$daohang);
        return $this->fetch();
    }  
    public function daohangadd()
    {  
      return $this->fetch();
    }  
    public function daohangsave()
    {  
       $data=input('post.');
       $validate = validate('Daohang');
      if(!$validate->scene('add')->check($data)){
       $this->error($validate->getError());
      }
       $res=model('Daohang')->save($data);
       if($res){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
    }  
     public function daohangedit()
    { 
      $id=input('param.id'); 
      $daohang=model('Daohang')->get($id);
      //dump($gongneng);exit;
      $this->assign('daohang',$daohang);
      return $this->fetch();
    }  
    public function daohangeditsave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $res=model('Daohang')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }
    }  
    public function daohangdelete()
    {  
      $data=input('param.');
      $res=model('Daohang')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功');
      }else{
        $this->error('删除失败');
      }
    }  
    
}
