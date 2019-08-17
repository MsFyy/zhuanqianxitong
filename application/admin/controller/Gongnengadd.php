<?php
namespace app\admin\controller;
use think\Controller;

class Gongnengadd extends Controller
{
   
    public function index(){
    	$cate=model('Cate')->gerallfist();
    	$this->assign('cate',$cate);

        return $this->fetch();
    }
    public function datasave(){
    	$data=input('post.');
    	if($data){
    		$validate = validate('Cate');
    		if(!$validate->check($data)){
    $this->error($validate->getError());
}else{
		$rest=model('Cate')->allowField(true)->save($data);
    	if($rest){
    		$this->success('成功','index');
    	}else{    		
    // 验证失败 输出错误信息
   				 dump($model('Cate')->getError());
    	}
}
    	
    	}

    }
}