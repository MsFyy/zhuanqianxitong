<?php
namespace app\admin\controller;
use think\Controller;
use think\Exception;


class Gongnenglist extends Common
{
   
    public function index(){
    	

        return $this->fetch();
    }
    public function eidt(){
        if(request()->isGet()){
            $id=input('param.id');
            $gongneng=model('Cate')->get($id);
            $this->assign('gneng',$gongneng);
            return $this->fetch();
        }
        if(request()->isPost()){
            $id=input('post.id');
            $rust=model('Cate')->allowField(true)->save($_POST,['id'=>$id]);
            if($rust){
                $this->success('修改成功',url('index'));
            }else{
                $this->error('修改失败',url('index'));
            }
        }


    }
    public function delete(){
        $data=input('param.');
        $cate=model('Cate');
        $gongneng=$cate->get($data['id']);
        if($gongneng['parent_id']==0){
           $child= $cate->where('parent_id = '.$gongneng['id'])->select();
           foreach ($child as $k=>$v){
          if($v['state']==1){
              $this->error('请先删除子栏目','index');
          }
           }
            $res=$cate->save(['state'=>'0'], ['id' => $data['id']]);
        }else{
            $res=$cate->save(['state'=>'0'], ['id' => $data['id']]);
        }
      //
      if($res){
            $this->success('删除成功' , url('index'));
        }else{
            $this->error('删除失败' , url('index'));
        }


    }
}