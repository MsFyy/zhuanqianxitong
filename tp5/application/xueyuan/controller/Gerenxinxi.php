<?php
namespace app\xueyuan\controller;
use think\Controller;
use think\Db;
class Gerenxinxi extends Base
{
    //基本信息
    public function index()
    {      
      //利用session获得登录的id,和类型信息
      $leixing=session('leixing');
      $id=session('id');
       if($leixing==1){
          $xinxi=model('Weixinxueyuan')->get($id);
        }elseif($leixing==2){
         $xinxi=model('Qqxueyuan')->get($id);
        }elseif($leixing==3){
         $xinxi=model('Zhucexueyuan')->get($id);
        }
        if(!$xinxi){
            return '信息不存在';
        }else{
            $this->assign('xinxi',$xinxi);
            return $this->fetch();
        }        
    } 
       //个人信息->密码修改的显示
     public function mima()
    {   
        //利用session获得登录的id信息
        $id=session('id');
        $admin=model('Zhucexueyuan')->get($id);
        if(!$admin){
            return '信息不存在';
        }else{
            $this->assign('admin',$admin);
            return $this->fetch();
        }      
    }  
     //个人信息->密码修改
     public function mimaupdate()
    {   
      $id=session('id');
      $admin=model('Zhucexueyuan')->get($id);  
      $data=input('post.');
      //判断旧密码是否正确
      if($admin->password!=md5($data['password'].$admin->code)) {
        $this->error('输入的旧密码不正确');
      }
      if($data['xinpassword']!=$data['cxinpassword']){
         $this->error('两次输入的密码不一致');
      }
      $xinmima=md5($data['xinpassword'].$admin->code);
      $res=model('Zhucexueyuan')->where('id',$id)->setField('password',$xinmima);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }    
    }  
    //联系信息的显示
     public function lianxi()
    {   
        //利用session获得登录的id信息
       $leixing=session('leixing');
       $id=session('id');
       if($leixing==1){
          $lianxi=model('Weixinxueyuan')->get($id);
        }elseif($leixing==2){
         $lianxi=model('Qqxueyuan')->get($id);
        }elseif($leixing==3){
         $lianxi=model('Zhucexueyuan')->get($id);
        }
        if(!$lianxi){
            return '信息不存在';
        }else{
            $this->assign('lianxi',$lianxi);
            return $this->fetch();
        }      
    }  
    //联系信息的更新
     public function lianxiupdate()
    {   
        //利用session获得登录的id信息
       $leixing=session('leixing');
       $id=session('id');
       if($leixing==1){
          $res=model('Weixinxueyuan')->save($_POST,['id' => $id]);
        }elseif($leixing==2){
         $res=model('Qqxueyuan')->save($_POST,['id' => $id]);
        }elseif($leixing==3){
          $res=model('Zhucexueyuan')->save($_POST,['id' => $id]);
        }
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }    
    }  
    //银行信息的显示
    public function yinhang()
    {   
        //利用session获得登录的id信息
       $leixing=session('leixing');
       $id=session('id');
       if($leixing==1){
          $yinhang=model('Weixinxueyuan')->get($id);
        }elseif($leixing==2){
         $yinhang=model('Qqxueyuan')->get($id);
        }elseif($leixing==3){
         $yinhang=model('Zhucexueyuan')->get($id);
        }
        if(!$yinhang){
            return '信息不存在';
        }else{
            $this->assign('yinhang',$yinhang);
            return $this->fetch();
        }      
    } 
    //银行信息的更新 
     public function yinhangupdate()
    {   
        //利用session获得登录的id信息
       $leixing=session('leixing');
       $id=session('id');
       if($leixing==1){
          $res=model('Weixinxueyuan')->save($_POST,['id' => $id]);
        }elseif($leixing==2){
         $res=model('Qqxueyuan')->save($_POST,['id' => $id]);
        }elseif($leixing==3){
          $res=model('Zhucexueyuan')->save($_POST,['id' => $id]);
        }
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }    
    }  
}