<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Xitong extends Controller
{
   
    public function index(){
		$System=model('System')->get(1);
		$this->assign('system', $System);
        return $this->fetch();
    }
    public function jieshao(){

        return $this->fetch();
    }

}
