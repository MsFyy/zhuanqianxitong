<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Image;
class Huandengpian extends Base
{
    public function huandengpianlist()
    {   
    	$huandengpian=model('Huandengpian')->getdaohang();
    	$this->assign('huandengpian',$huandengpian);
        return $this->fetch();
    }  
    public function huandengpianadd()
    {  
      return $this->fetch();
    }  
    public function huandengpiansave()
    {  
       $data=input('post.');
       $validate = validate('Huandengpian');
       if(!$validate->scene('add')->check($data)){
       $this->error($validate->getError());
      }
       $res=model('Huandengpian')->allowField(['name','lianjie','zhuangtai','paixu','suoluetu'])->save($data);
       if($res){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
    }  
     public function huandengpianedit()
    { 
      $id=input('param.id'); 
      $huandengpian=model('Huandengpian')->get($id);
      //dump($gongneng);exit;
      $this->assign('huandengpian',$huandengpian);
      return $this->fetch();
    }  
    public function huandengpianeditsave()
    {   
      $id=input('post.id');
      //dump($id);exit;
      $res=model('Huandengpian')->save($_POST,['id' => $id]);
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }
    }  
    public function huandengpiandelete()
    {  
      $data=input('param.');
      $res=model('Huandengpian')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('删除成功');
      }else{
        $this->error('删除失败');
      }
    } 
    public function picture(Request $request) 
    {  
      $file=$request->file('image');
      if(true!==$this->validate(['image'=>$file],['image'=>'require|image'])){
        exit;
        }else{
        //读取图片信息
       $image=Image::open($file);
       //对图片进行缩略处理
       $image->thumb(1920,540,Image::THUMB_FIXED);
       //对图片进行命名
       $saveName=$request->time().'.png';
       //对图片进行保存
       $image->save(ROOT_PATH.'public/uploads/flash/'.$saveName);
        return json([
          'src'=>'/public/uploads/flash/'.$saveName,
          ]);
      }
    }     
}