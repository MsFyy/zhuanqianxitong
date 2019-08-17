<?php
namespace app\xueyuan\controller;
use think\Db;
use think\Controller;
use think\Request;
class Login extends Controller
{
    public function index()
    {   
         $data=input('post.');
         //dump($data);exit;
         $res=model('Zhucexueyuan')->get(['username'=>$data['username']]);
         if(!$res || $res->zhuangtai!=1){
          $this->error('用户名不存在，或者用户未通过审核');
         }
         if($res->password!=md5($data['password'].$res->code)){
          $this->error('密码错误');
         }
         session('xueyuanname', $res->username);
         session('id', $res->id);
         session('leixing', $res->leixing);
         $url1=session('url1');
         //dump($url1);exit;
         // $this->redirect('$url1');
         $this->redirect($url1,302);
    }  
    public function tuichu()
    { 
      session(null);
      $this->success('退出成功',url('/Index/index/index'));
    }
    public function mtuichu()
    { 
      $url1=session('url1');
      session(null);
      $this->redirect($url1,302);
    }
}
