<?php
namespace app\index\model;
use think\Model;
class Gaofei extends Model
{
    public function lookbook($xueyuanid,$xueyuanleixing,$wenzhangid)
    {   
      $map['zhuangtai']  = ['<>',-1];
      $map['xueyuanid']  =$xueyuanid;
      $map['xueyuanleixing']  = $xueyuanleixing;
      $map['wenzhangid']  = $wenzhangid;
      
       return $this->where($map)
                   ->find();
    }
}
