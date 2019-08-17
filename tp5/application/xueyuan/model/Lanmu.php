<?php
namespace app\xueyuan\model;
use think\Model;
class Lanmu extends Model
{
    public function index()
    {   

    }
    public function getdalei()
    {   
      $data=[
           'zhuangtai'=>1,
           'parent_id'=>0,
      ];
      $order=[
              'paixu'=>'asc',
            ];
       return $this->where($data)
                   ->order($order)
                   ->select();
    }
    public function getxiaolei()
    {   
      $data=[
           'zhuangtai'=>1,
      ];
      $order=[
              'paixu'=>'asc',
            ];
       return $this->where($data)
                   ->order($order)
                   ->select();
    }
    public function getlist()
    {   
      $field='id,parent_id,name,lianjie';
      $map['zhuangtai']=1;
      $order=[
              'paixu'=>'asc',
            ];
       $cate=$this->field($field)
                   ->where($map)
                   ->order($order)
                   ->select();
       $list=$this->tree($cate);
       return $list;            
    }
    public function tree($cate,$name='child',$parent_id=0)
    { 
        $arr=array();
        foreach ($cate as $key => $v) {
          if($v['parent_id']==$parent_id)
          {
            $arr[]=$v;
            $v[$name]=$this->tree($cate,$name,$v['id']);
          }# code...
        }
        return $arr;
    }
    public function zileijiancha($id=0)
    {   
      $field='id,parent_id';
      $map['zhuangtai']=1;
      $map['parent_id']=$id;
      $cate=$this->field($field)
                  ->where($map)
                   ->select();
       return $cate;            
    }
}
