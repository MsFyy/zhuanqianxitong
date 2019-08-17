<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;
//use app\index\model\Xuesheng;
class Index extends Base
{
    public function index()
    { 
      $request = Request::instance();
      $xianshiid=input('$xianshiid');
      session('$xianshiid', $xianshiid); 
      session('url1',$request->url(true)); 
      $tuijianzhiding=model('Neirong')->tuijianzhiding();
      $tuijian=model('Neirong')->tuijian();
      $zuixinfabu=model('Neirong')->zuixinfabu();
      $huandengpian=model('huandengpian')->gethuandengpian();
       $this->assign('tuijianzhiding',$tuijianzhiding);
       $this->assign('huandengpian',$huandengpian); 
       $this->assign('zuixinfabu',$zuixinfabu); 
      $this->assign('tuijian',$tuijian);
        return $this->fetch();
    }  
    public function tuijian()
    {    
      $xianshiid=input('$xianshiid');
      session('$xianshiid', $xianshiid); 
      $tuijian=model('Neirong')->tuijian();
      $this->assign('tuijian',$tuijian);
        return $this->fetch();
    }  
    //章节
    public function chapter()
    {  
      $wenzhangid=input('param.id');
      session('wenzhangid', $wenzhangid);
      $neirong=model('neirong')->get($wenzhangid);
      $neirongmulu=model('neirongmulu')->getneirongmulu($wenzhangid);
      $this->assign('neirong',$neirong);
      $this->assign('neirongmulu',$neirongmulu);
        return $this->fetch();
    }  
    //简介
    public function jianjie()
    {  
        $id=session('wenzhangid');
        //dump($id);
        $neirong=model('neirong')->get($id);
        $this->assign('neirong',$neirong);
        return $this->fetch();
    }  
     //课程目录
    public function mulu()
    {  
        $wenzhangid=session('wenzhangid');
        $neirong=model('neirong')->get($wenzhangid);
        $this->assign('neirong',$neirong);
        $neirongmulu=model('neirongmulu')->getneirongmulu($wenzhangid);
        $this->assign('neirongmulu',$neirongmulu);
        return $this->fetch();
    }  
    //内容
     public function content()
    {  
        $wenzhangid=session('wenzhangid');
        $contentid=input('id');
        $xueyuanid=session('id');
        $xueyuanleixing=session('leixing');
        //dump($id);
        //特级学员
        if(!empty($xueyuanid)){
         //查询学员状态
              if($xueyuanleixing==1){
                  $tejixueyuan=model('Weixinxueyuan')->getstatus($xueyuanid);
              }elseif($xueyuanleixing==2){
                  $tejixueyuan=model('qqxueyuan')->getstatus($xueyuanid);
              }elseif($xueyuanleixing==3){
                  $tejixueyuan=model('zhucexueyuan')->getstatus($xueyuanid);
              }
            }else{
            $tejixueyuan=false;
            }
        //首先，判断是否已付费
        if(!empty($xueyuanid)){
        $lookbook=model('Gaofei')->lookbook($xueyuanid,$xueyuanleixing,$wenzhangid);
        }else{
          $lookbook=false;
        }
        //其次，判断是否免费课程
        $lookfree=model('Neirong')->lookfree($wenzhangid);
        //判断是否是免费试读章节
        $contentfree=model('Neirongmulu')->contentfree($contentid);
        if($tejixueyuan||$lookbook||$lookfree||$contentfree){
          $neirong=model('Neirongmulu')->get($contentid);
          }else{
             $this->redirect('charge',['wenzhangid'=>$wenzhangid])->remember();
        }
        $this->assign('neirong',$neirong);
        return $this->fetch();
    } 
    //收费 
      public function charge()
      {  
          $wenzhangid=input('wenzhangid');
           $neirong=model('neirong')->get($wenzhangid);
          $this->assign('neirong',$neirong);
          return $this->fetch();
      }  
    public function zhuce()
    {   
      return $this->fetch();
    }  
    public function save()
    {  
      $data=input('post.');
      $validate = validate('Xuesheng');
      if(!$validate->check($data)){
       $this->error($validate->getError());
      }
       //dump($data);exit;
      // $data = [
      // 'name' => '赵六', 
      // 'chengji' => '90',
      // 'banji' => '5',
      // ];
       $result=model('Xuesheng')->save($data);
       $userId = model('Xuesheng')->getLastInsID();
       dump($userId);
    }  
    public function delete()
    {  
      $data=input('param.');
      //dump($data);exit;
      $res=model('Xuesheng')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功','index');
      }else{
        $this->error('删除失败','index');
      }
    }  
     public function edit()
    {  
      $id=input('param.id');
      //dump($id);exit;
      $xueshengs=model('Xuesheng')->get($id);
      $this->assign('xueshengs',$xueshengs);
      return $this->fetch();
    }  
    public function editsave()
    {  
      $id=input('post.id');
      //dump($id);exit;
      $name=input('post.name');
      $nameid=model('Xuesheng')->get(['name'=>$name]);
      if($nameid){
        $this->error('姓名没做修改或者已有此姓名不能重复','index');
      }
      $res=model('Xuesheng')->allowField(['name'])->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功','index');
      }else{
        $this->error('更新失败','index');
      }
    }  
    public function chaxun()
    {  
      $name=input('param.name');
      $xueshengs=model('Xuesheng')->chaxun($name);
       $this->assign('xueshengs',$xueshengs);
      return $this->fetch();
    }  
    public function category()
    {  
       $lanmulist=model('Lanmu')->getlist();
       $this->assign('lanmulist',$lanmulist);
      return $this->fetch();
    }  
    public function categorys()
    {  
       $categorysid=input('id');
       $leimu=model('Lanmu')->get($categorysid);
       $categorys=model('Neirong')->getcategorys($categorysid);
       $this->assign('categorys',$categorys);
       $this->assign('leimu',$leimu);
      return $this->fetch();
    }  
    public function search()
    {  
       
      return $this->fetch();
    }  
    public function me()
    {  
       
      return $this->fetch();
    }  
     public function pay()
    {  
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) 
           {
             $shebei=1;
            }else{
            $shebei=2;
            }
       $wenzhangid=input('id');
       $neirong=model('neirong')->get($wenzhangid);
      $this->assign('neirong',$neirong);
      $this->assign('shebei',$shebei);
      return $this->fetch();
  
    }  
     //注册学员的输出
    public function searchlist()
    {   
       //接收提交的查询数据
       $name=input('name');
       //判断查询name是存在
       if(!empty($name)){
         $list=model('Neirong')->getchaxunlist($name);
        }else{
           $list=model('Neirong')->getlist();
        }  
        $this->assign('list',$list);
        $this->assign('name',$name);
        return $this->fetch();
    }  
    public function selectpay()
    {   
       $data=input('post.');
       // dump($name);exit;
       $pay=$data['radio1'];
       $kechengid=$data['kechengid'];
       //判断查询name是存在
       if($pay==1){
        $this->redirect('Zfbpaym/index', ['wenzhangid' => $kechengid]);
        }else{
         $this->redirect('Wxpaym/index', ['wenzhangid' => $kechengid]);
         }  
      }


}
