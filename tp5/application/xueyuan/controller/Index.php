<?php
namespace app\xueyuan\controller;
use think\Controller;
use think\Request;
class Index extends Controller
{
    public function index()
    {   
    //判断移动端然后进行跳转
        $request = Request::instance();
        if($this->request->isMobile()===true){
          $this->view->config('view_path',ROOT_PATH.'public/mobile/xueyuan/');
        }
        $xueyuanname=session('xueyuanname');
         $this->assign('xueyuanname',$xueyuanname);
        $xueyuanimage=session('image');
         $this->assign('xueyuanimage',$xueyuanimage);
         session('url1',$request->url(true));
        return $this->fetch();
    }  
    public function mlogin()
    {   
        //判断移动端然后进行跳转
        if($this->request->isMobile()===true){
          $this->view->config('view_path',ROOT_PATH.'public/mobile/xueyuan/');
        }
        // $this->redirect('mlogin')->remember();
        return $this->fetch();
    }  
    public function jieshao()
    {   
        return $this->fetch();
    }  
}
