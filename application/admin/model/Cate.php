<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model{
	public function index(){
		//初始化调用Model的initialize的方法；
		 parent::initialize();

	}


	//一级栏目

	public function gerallfist(){
		$data=[
			'parent_id'=>'0',
			'state'=>1,
		];
	return	$this->where($data)->order(['stor'=>'desc'])->select();
	}
}