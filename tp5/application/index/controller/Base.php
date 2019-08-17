<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
	public function _initialize()
    {   
        //判断移动端然后进行跳转
        if($this->request->isMobile()===true){
          $this->view->config('view_path',ROOT_PATH.'public/mobile/');
        }
        $youhua=model('Youhua')->get(1);
        $this->assign('youhua',$youhua); 
        $daohang=model('Daohang')->getdaohang();
         $this->assign('daohang',$daohang); 
        $huandengpian=model('huandengpian')->gethuandengpian();
       $this->assign('huandengpian',$huandengpian); 
    }  
    public function index()
    {   
       
    }  
    
}
