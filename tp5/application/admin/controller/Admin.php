<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
class Admin extends Controller
{
    public function index()
    {   
        return $this->fetch();
    }  
    public function login()
    {   
        return $this->fetch();
    }  
    public function loginsave()
    {   
    	 //$data=input('post.');
    	 //dump($data);
    	//判断是否post传送
        if(request()->isPost()){
        //验证码验证	
         $data=input('post.');
         if(!captcha_check($data['code'])){
           $this->error('验证码错误');
         };
         $res=model('Admin')->get(['username'=>$data['username']]);
         if(!$res || $res->zhuangtai!=1){
         	$this->error('用户名不存在，或者用户未通过审核');
         }
         if($res->password!=md5($data['password'].$res->code)){
         	$this->error('密码错误');
         }
         session('username', $res->username);
         session('id', $res->id);
         //dump(session('username'));exit;
         if(isset($data['baomi'])){
            cookie('id',$res->id,3600);
            cookie('username',$res->username,3600);
            cookie('password',$data['password'],3600);
         }else{
            cookie('username', null);
            cookie('password', null);
         }
         return $this->success('登陆成功',url('Index/index'));
        }
    }  
    public function loginout()
    {   
        session(null);
        $this->error('你成功退出登录','Admin/login');
    }  
    public function adminlist()
    {   
        $id=input('param.id');
        $dalei=model('Gongneng')->get($id);
        $this->assign('dalei',$dalei);
        $id1=input('param.id1');
        $xiaolei=model('Gongneng')->get($id1);
        $this->assign('xiaolei',$xiaolei);
        $admin=model('Admin')->getadmin();
        $this->assign('admin',$admin);
        return $this->fetch();
    }  
    public function adminadd()
    {   
        $id=input('param.id');
        $dalei=model('Gongneng')->get($id);
        $this->assign('dalei',$dalei);
        $id1=input('param.id1');
        $xiaolei=model('Gongneng')->get($id1);
        $this->assign('xiaolei',$xiaolei);
        return $this->fetch();
    }  
    public function adminsave(){ 
           $data = input('post.');
           //严格校验 tp5 validate
            $validate = validate('Admin');
            if(!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
            }
             // 判定提交的用户是否存在
            $adminid = model('Admin')->get(['username'=>$data['username']]);
           //echo model('BisAccount')->getLastSql();exit;
             if($adminid) {
                $this->error('该用户存在，请重新填写登录名');
              } 
           if($data['password'] != $data['cpassword']) {
                $this->error('两次输入的密码不一致');
           }    
            $data['code'] = mt_rand(100, 10000);
            $admins = [
               'username' => $data['username'],
               'paixu' => $data['paixu'],
               'zhuangtai' => $data['zhuangtai'],
               'code' => $data['code'],
               'password' => md5($data['password'].$data['code']),
               'mobile' => $data['mobile'],
               'email' => $data['email'],
               ];
            $res = model('Admin')->save($admins);  
           
           if($res) {
               $this->success('添加成功');
           }else{
               $this->error('添加失败');
           }   
      } 
      public function adminedit()
    { 
      $id=input('param.id'); 
      $admin=model('Admin')->get($id);
      //dump($gongneng);exit;
      $this->assign('admin',$admin);
      return $this->fetch();
    }  
    public function admineditsave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $data = input('post.');
      $data['code'] = mt_rand(100, 10000);
      $admins = [
         'username' => $data['username'],
         'paixu' => $data['paixu'],
         'zhuangtai' => $data['zhuangtai'],
         'code' => $data['code'],
         'password' => md5($data['password'].$data['code']),
         'mobile' => $data['mobile'],
         'email' => $data['email'],
         ];
      $res=model('Admin')->save($admins,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }
    }  
    public function admindelete()
    {  
      $data=input('param.');
      $res=model('Admin')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功');
      }else{
        $this->error('删除失败');
      }
    }     

    //个人信息-》基本信息
     public function gerenindex()
    {   
        //利用session获得登录的id信息
        $id=session('id');
        //dump($id);exit;
        $admins=model('Admin')->get($id);
        if(!$admins){
            return '信息不存在';
        }else{
            $this->assign('admins',$admins);
            return $this->fetch();
        }      
    }  
    //个人信息-》基本信息修改
     public function gerenxiugai()
    {   
        //利用session获得登录的id信息
        $id=session('id');
        //dump($id);exit;
        $admin=model('Admin')->get($id);
        if(!$admin){
            return '信息不存在';
        }else{
            $this->assign('admin',$admin);
            return $this->fetch();
        }      
    }  
    //个人信息-》基本信息修改保存
     public function gerenupdate()
    {   
        //利用session获得登录的id信息
      $id=session('id');
      //dump($id);exit;
      $res=model('Admin')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }    
    }  
    //个人信息-》用户名修改修改
     public function yonghumingxiugai()
    {   
        //利用session获得登录的id信息
        $id=session('id');
        //dump($id);exit;
        $admin=model('Admin')->get($id);
        if(!$admin){
            return '信息不存在';
        }else{
            $this->assign('admin',$admin);
            return $this->fetch();
        }      
    }  
        //个人信息-》用户名修改修改
     public function mimaxiugai()
    {   
        //利用session获得登录的id信息
        $id=session('id');
        //dump($id);exit;
        $admin=model('Admin')->get($id);
        if(!$admin){
            return '信息不存在';
        }else{
            $this->assign('admin',$admin);
            return $this->fetch();
        }      
    }  
     //个人信息-》基本信息修改保存
     public function mimaupdate()
    {   
      $id=session('id');
      $admin=model('Admin')->get($id);  
      $data=input('post.');
      //判断旧密码是否正确
      if($admin->password!=md5($data['password'].$admin->code)) {
        $this->error('输入的旧密码不正确');
      }
      if($data['xinpassword']!=$data['cxinpassword']){
         $this->error('两次输入的密码不一致');
      }
      // $xinmima=[
      //     'password'=>md5($data['xinpassword'].$admin->code),
      // ];
      // $res=model('Admin')->save($xinmima,['id'=>$id]);
      // 只更新密码字段
      $xinmima=md5($data['xinpassword'].$admin->code);
      $res=model('Admin')->where('id',$id)->setField('password',$xinmima);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }    
    }  
    //个人信息-》基本信息修改保存
     public function yonghumingupdate()
    {   
        //利用session获得登录的id信息
      $id=session('id');
      //dump($id);exit;
      $admin=input('param.username');
      $admin = model('Admin')->get(['username'=>$admin]);
           //echo model('BisAccount')->getLastSql();exit;
             if($admin) {
                $this->error('该用户存在，请重新填写登录名');
              } 
      $res=model('Admin')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }    
    }  
}
