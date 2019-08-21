<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Common
{
   
    public function index(){

        return $this->fetch();
    }
    public function systems(){
      $data=  input('post.id');
      
      $Xitong=model('system');
    $rust=  $Xitong->allowField(true)->save($_POST,['id'=>$data]);
  
        //return $this->fetch();
    }
     public function jieshao(){

        return $this->fetch();
    }


}
