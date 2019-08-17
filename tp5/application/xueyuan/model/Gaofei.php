<?php
namespace app\xueyuan\model;
use think\Model;
class Gaofei extends Model
{
    public function gaofei($id,$leixing)
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
