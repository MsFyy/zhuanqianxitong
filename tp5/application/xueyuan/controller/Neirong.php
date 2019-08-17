<?php
namespace app\xueyuan\controller;
use think\Controller;
use think\Request;
use think\Image;
class Neirong extends Base
{
    //课程目录的输出
    public function kechenglist()
    {   
      //获得学员的身份信息
      $id=session('id');
      $leixing=session('leixing');
      $neirong=model('Neirong')->getmulu($id,$leixing);
    	$this->assign('neirong',$neirong);
        return $this->fetch();
    }  
    public function kechenglistadd()
    {  
      $dalei=model('Lanmu')->getdalei();
       $this->assign('dalei',$dalei);
      return $this->fetch();
    }  
    public function getzilei() 
    {  
     $pid=input('daleidi');
     $a['parent_id']=$pid;
     $a['zhuangtai']=1;
     $zilei=model('Lanmu')->where($a)
                          ->select();
          return json($zilei);
    }
    public function kechengsave()
    {  
       $data=input('post.');
       $validate = validate('Neirong');
      if(!$validate->scene('kechengadd')->check($data)){
       $this->error($validate->getError());
      }
      if($data['jiage']==1){
        $jiage=0;
      }elseif ($data['jiage']==2) {
        $jiage=$data['feiyong'];
      }
      $neirong = [
        'leibie' => $data['dalei'],
        'leibieer' => $data['zilei'],
        'name' => $data['name'],
        'zuozheleixing' => $data['xueyuanleixing'],
        'zuozheid' => $data['xueyuanid'],
        'jiage' => $jiage,
        'zhuangtai' => 0,
        'content' => $data['content'], 
         ];
       $res=model('neirong')->save($neirong);
       if($res){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
    } 
     public function kechengedit()
    { 
      $id=input('param.id'); 
      //dump($id);exit;
      $dalei=model('Lanmu')->getdalei();
       $this->assign('dalei',$dalei);
      $xiaolei=model('Lanmu')->getxiaolei();
      $this->assign('xiaolei',$xiaolei);
      $neirong=model('Neirong')->get($id);
      //dump($neirong);exit;
      $this->assign('neirong',$neirong);
      return $this->fetch();
    }  
    public function kechengupdate()
    {   
      $id=input('post.id');
      $data=input('post.');
       $validate = validate('Neirong');
      if(!$validate->scene('kechengadd')->check($data)){
       $this->error($validate->getError());
      }
     if($data['jiage']==1){
        $jiage=0;
      }elseif ($data['jiage']==2) {
        $jiage=$data['feiyong'];
      }
       $neirong = [
              'leibie' => $data['dalei'],
              'leibieer' => $data['zilei'],
              'name' => $data['name'],
              'zuozheleixing' => $data['xueyuanleixing'],
              'zuozheid' => $data['xueyuanid'],
              'jiage' => $jiage,
              'zhuangtai' => 0,
              'content' => $data['content'], 
               ];
      $res=model('Neirong')->save($neirong,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }
    }  
    public function kechengdelete()
    {  
      $data=input('param.');
      $res=model('Neirong')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功');
      }else{
        $this->error('删除失败');
      }
    }   
    //课程内容目录 
    public function neirongmulu()
    {   
      $id=input('param.id');
      $neirong=model('neirong')->get($id);
      $neirongmulu=model('neirongmulu')->getneirongmulu($id);
      $this->assign('neirong',$neirong);
      $this->assign('neirongmulu',$neirongmulu);
        return $this->fetch();
    }  
    public function neirongmuluadd()
    {   
      $id=input('param.id');
      //dump($wenzhangid);exit;
      $jiaocheng=model('neirong')->get($id);
      $this->assign('jiaocheng',$jiaocheng);
        return $this->fetch();
    }  
    public function neirongmuluaddsave()
    {   
      $data=input('param.');
      $wenzhangid=input('param.wenzhangid');
      $validate = validate('Neirong');
      if(!$validate->scene('jieadd')->check($data)){
       $this->error($validate->getError());
      }
      $mulu=[
        'name'=>$data['name'],
        'paixu'=>$data['paixu'],
        'wenzhangid'=>$data['wenzhangid'],
        'gaishu'=>$data['gaishu']
      ];
      $res=model('Neirongmulu')->field('name,paixu,wenzhangid,gaishu')->insert($mulu);
       if($res){
          $this->redirect('Neirong/neirongmulu', ['id' => $wenzhangid]);
          }else{
          $this->error('添加失败');
          }  
    }  
    public function zhangjieadd()
    {   
      $id=input('param.parent_id');
      $wenzhangid=input('param.wenzhangid');
      $jiaocheng=model('neirong')->getjiaocheng($wenzhangid);
      $neirong=model('neirongmulu')->get($id);
      $muludalei=model('neirongmulu')->muludalei($wenzhangid);
      $this->assign('jiaocheng',$jiaocheng);
      $this->assign('neirong',$neirong);
      $this->assign('muludalei',$muludalei);
        return $this->fetch();
    }  
    public function neirongzhangjiesave()
    {   
      $data=input('param.');
      $wenzhangid=input('param.wenzhangid');
      $validate = validate('Neirong');
      if(!$validate->scene('jieadd')->check($data)){
       $this->error($validate->getError());
      }
      $zhangjieneirong=[
        'parent_id'=>$data['parent_id'],
        'name'=>$data['name'],
        'paixu'=>$data['paixu'],
        'wenzhangid'=>$data['wenzhangid'],
        'gaishu'=>$data['gaishu'],
        'content'=>$data['content'],
      ];
      $res=model('Neirongmulu')->save($zhangjieneirong);
       if($res){
          $this->redirect('Neirong/neirongmulu', ['id' => $wenzhangid]);
          }else{
          $this->error('添加失败');
          }  
    }  
     public function zhangjiebianji()
    {   
      $id=input('param.id');
      $wenzhangid=input('param.wenzhangid');
      $jiaocheng=model('neirong')->getjiaocheng($wenzhangid);
      //dump($jiaocheng);exit;
      $neirong=model('neirongmulu')->get($id);
      $muludalei=model('neirongmulu')->muludalei($id);
      $this->assign('jiaocheng',$jiaocheng);
      $this->assign('neirong',$neirong);
      $this->assign('muludalei',$muludalei);
        return $this->fetch();
    }  
    public function neirongmulupaixu($id,$paixu)
     {   
        $res=model('Neirongmulu')->save(['paixu'=>$paixu],['id'=>$id]);
         if($res){
         $this->success('操作成功');
         }else{
         $this->error('操作失败');
        }
    }  
    
}