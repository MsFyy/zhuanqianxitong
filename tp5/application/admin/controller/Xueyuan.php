<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Xueyuan extends Base
{
     //注册学员的输出
    public function zhucexueyuan()
    {   
       //接收提交的查询数据
       $name=input('param.name');
       //判断查询name是存在
       if(!empty($name)){
         $list=model('Zhucexueyuan')->getchaxunlist($name);
        }else{
           $list=model('Zhucexueyuan')->getlist();
        }  
        $this->assign('list',$list);
        return $this->fetch();
    }  

    //微信学员列表的输出
    public function weixinxueyuan()
    {   
      //获取查询数据$name
       $name=input('param.name');
       //对$name进行判断
       if(!empty($name)){
         $list=model('Weixinxueyuan')->getchaxunlist($name);
        }else{
           $list=model('Weixinxueyuan')->getlist();
        }  
        $this->assign('list',$list);
        return $this->fetch();
    }  

    //QQ学员列表的输出
    public function qqxueyuan()
    {    
       //获取查询数据$name
       $name=input('param.name');
       //对$name进行判断
       if(!empty($name)){
         $list=model('Qqxueyuan')->getchaxunlist($name);
        }else{
           $list=model('Qqxueyuan')->getlist();
        }  
        $this->assign('list',$list);
        return $this->fetch();
       
    }

     //注册学员状态的改变  
    public function zhucexueyuanzhuangtai()
    {  
     
      //获取提交过来的数据
      $data=input('param.');
      $res=model('Zhucexueyuan')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //判断是否提交成功
      if($res){
        $this->success('操作成功');
      }else{
        $this->error('操作失败');
      }
    } 

    //微信学员状态的改变
    public function weixinxueyuanzhuangtai()
    {  
      //获取连接提交过来的数据
      $data=input('param.');
      $res=model('Weixinxueyuan')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //判断是否提交成功
      if($res){
        $this->success('操作成功');
      }else{
        $this->error('操作失败');
      }
    } 


    //微信学员状态的改变
    public function qqxueyuanzhuangtai()
    {  
      //获取连接提交过来的数据
      $data=input('param.');
      $res=model('Qqxueyuan')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //判断是否提交成功
      if($res){
        $this->success('操作成功');
      }else{
        $this->error('操作失败');
      }
    } 
    public function xueyuanxiangqing()
    {   
      //获取学员的id和类型
      $id=input('param.id');
      $leixing=input('param.leixing');
      //判断学员所在的数据表，然后获取学员数据
      if($leixing==1){
          $xueyuan=model('Weixinxueyuan')->get($id);
        }elseif($leixing==2){
         $xueyuan=model('qqxueyuan')->get($id);	
        }elseif($leixing==3){
         $xueyuan=model('Zhucexueyuan')->get($id);	
        }
      //推荐学员的输出，三表合并查询输出
    	$a=model('Qqxueyuan')->field('id,leixing,username,image,tuijianxueyuanid,tuijianxueyuanleixing,create_time')->buildSql();
      $b=model('Weixinxueyuan')->field('id,leixing,username,image,tuijianxueyuanid,tuijianxueyuanleixing,create_time')->buildSql();
      $c=model('Zhucexueyuan')->field('id,leixing,username,image,tuijianxueyuanid,tuijianxueyuanleixing,create_time')->union([$a,$b])->buildSql();
      //查看学员所推荐学员
         $map['tuijianxueyuanid']=$id;
         $map['tuijianxueyuanleixing']=$leixing;
         $tuijianxueyuan=Db::table($c.'name')
                        ->where($map)
                        ->paginate(6);
        //推荐学员的数量统计
        $tuijianxueyuanshuliang=Db::table($c.'name')
                               ->where($map)
                               ->count();
       //文稿的数量统计
       $wengaoshuliang=model('Neirong')->xueyuangonggaoshuliang($id,$leixing);
        return $this->fetch('', [
            'xueyuan' => $xueyuan,
            'tuijianxueyuan' => $tuijianxueyuan,
            'tuijianxueyuanshuliang' => $tuijianxueyuanshuliang,
            'wengaoshuliang' => $wengaoshuliang,
        ]);		    
    }  
}