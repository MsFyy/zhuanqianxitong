<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Student;
//use app\index\model\Student;
class Index extends Controller
{
   
    public function fy(){

    	//$student=new Student;
$list =model('Student')->select();

// 把分页数据赋值给模板变量list
$this->assign('list', $list);

// 渲染模板输出
return $this->fetch();
    }
public function save(){
	$validate = validate('Student');
	if(!$validate->check(input('post.'))){
    $this->error($validate->getError()); 
}
		//$data=['name'=>'王二小','banji'=>'六','chengji'=>59];
    	$result=model('Student')->insert(input('post.'));
    	if($result){
    		$this->success('新增成功','index/fy');
    	}else{
    		$this->error('新增失败','index/fy');
    	}
}

    public function add(){
    return $this->fetch();
    }

    public function delete($id){
        $Student=Student::get($id);
      $result= $Student->delete();
        if($result){
            $this->success('新增成功','index/fy');
        }else{
            $this->error('新增失败','index/fy');
        }
    }
}
