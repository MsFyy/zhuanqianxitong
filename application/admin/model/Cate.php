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

	public  function getlist(){
	    $data=[
	        'state'=>1,
        ];
	    $order=[
	        'stor'=>'asc'
        ];
	    $cate= $this->field('id,name,parent_id')->where($data)->order($order)->select();
	    return $this->tree($cate);
    }
    public function tree($cate,$name='child',$parent_id= 0){

	    $arr=array();
	    foreach ($cate as $key=>$value ){
	        if ($value['parent_id']==$parent_id){
	            $arr[]=$value;
	            $value[$name]=$this->tree($cate,$name,$value['id']);
            }
        }
	    return $arr;

    }
    public  function savedatas($id){

	   $this->isUpdate(false)->save([
            'state'=>'0'
        ],['id'=>$id]);
    }
}