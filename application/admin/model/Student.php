<?php
namespace app\admin\model;
use think\Model;
class Student extends Model{
	public function index(){
		//初始化调用Model的initialize的方法；
		 parent::initialize();

	}
}