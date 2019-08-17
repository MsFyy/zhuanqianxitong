<?php
namespace app\xueyuan\controller;
use think\Controller;
class Base extends Controller
{
	public function _initialize()
    {   
    	//判断移动端然后进行跳转
        if($this->request->isMobile()===true){
          $this->view->config('view_path',ROOT_PATH.'public/mobile/xueyuan/');
          if(!session('xueyuanname')){
            $this->error('你尚未登录，请进行登录','index/mlogin');
         }
        }else{
         if(!session('xueyuanname')){
    	 	$this->error('你尚未登录，请进行登录','index/index/index');
    	  }
         }
        $xueyuanname=session('xueyuanname');
         $this->assign('xueyuanname',$xueyuanname);
        $xueyuanimage=session('image');
         $this->assign('image',$xueyuanimage);
    	$id=input('param.id');
        $dalei=model('Gongneng')->get($id);
        $this->assign('dalei',$dalei);
        $id1=input('param.id1');
        $xiaolei=model('Gongneng')->get($id1);
        $this->assign('xiaolei',$xiaolei);
        $gongnenglist=model('Gongneng')->getlist();
        $this->assign('gongnenglist',$gongnenglist);
    }        
}
