<?php
namespace app\index\model;
use think\Model;
class Tuiguangyongjin extends Model
{
    public function tuiguangyongjin($id,$leixing)
    {   
     $map['zhuangtai']  = ['<>',-1];
      $map['shouruzheid']  =$id;
      $map['shouruzheleixing']  = $leixing;
      $order=[
              'create_time'=>'asc',
            ];
       return $this->where($map)
                   ->order($order)
                   ->paginate(6);
    }
}
