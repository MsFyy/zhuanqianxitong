<?php
namespace app\xueyuan\controller;
use think\Db;
use think\Controller;
use think\Request;
//use app\index\model\Xuesheng;
class Zhuce extends Controller
{
    public function index()
    {   
       $data = input('post.');
       //严格校验 tp5 validate
       if(!captcha_check($data['yanzhengma'])){
           $this->error('验证码错误');
         };
        $validate = validate('Xueyuan');
        if(!$validate->scene('add')->check($data)) {
        $this->error($validate->getError());
        }
         // 判定提交的用户是否存在
        $res = model('Zhucexueyuan')->get(['username'=>$data['username']]);
       //echo model('BisAccount')->getLastSql();exit;
         if($res) {
            $this->error('该用户存在，请重新填写账号');
          } 
       if($data['password'] != $data['cpassword']) {
            $this->error('两次输入的密码不一致');
       }    
        $data['code'] = mt_rand(100, 10000);
        $xueyuan = [
           'username' => $data['username'],
           'zhuangtai' => 1,
           'code' => $data['code'],
           'password' => md5($data['password'].$data['code']),
           'tuijianxueyuanid' => $data['tuijianxueyuanid'],
           'tuijianxueyuanleixing' => $data['tuijianxueyuanid'],
           ];
           $xieru=model('Zhucexueyuan')->save($xueyuan);
           $id = model('Zhucexueyuan')->getLastInsID();
       if($id) {
            $res=model('Zhucexueyuan')->get($id);
            session('xueyuanname', $res->username);
            session('id', $res->id);
            session('leixing', $res->leixing);
           return $this->success('注册成功',url('index/index/index'));
       }else{
           $this->error('添加失败');
       }   
    }      
}
