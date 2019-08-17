<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
	public function _initialize()
    {   
    	if(!session('username')){
    		$this->error('你尚未登录，请进行登录','Admin/login');
    	}
        $id=input('param.id');
        $dalei=model('Gongneng')->get($id);
        $this->assign('dalei',$dalei);
        $id1=input('param.id1');
        $xiaolei=model('Gongneng')->get($id1);
        $this->assign('xiaolei',$xiaolei);
        $gongnenglist=model('Gongneng')->getlist();
        $this->assign('gongnenglist',$gongnenglist);
    }  
    public function index()
    {   
       
    }  
    
}
