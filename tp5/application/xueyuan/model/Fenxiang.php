<?php
namespace app\xueyuan\model;
use think\Model;
class Fenxiang extends Model
{
    public function getfenxiang($id,$leixing)
    {    
      $map['xueyuanid']  =$id;
      $map['xueyuanleixing']  = $leixing;
       return $this->where($map)    
                   ->find();
     
    }     
}
