<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Youhua extends Controller
{
   
    public function index(){
    	$youhua=model('Youhua')->get(1);
    	$this->assign('youhua', $youhua);
		
        return $this->fetch();
    }
   public function dataadd(){
    	$data=input('post.id');
    	$rust=model('Youhua')->allowField(true)->save($_POST,['id'=>$data]);
    	if($rust){
    		$this->success('修改成功',url('index'));
    	}else{
    		$this->eeor('修改失败',url('index'));
    	}

		
    }

}
