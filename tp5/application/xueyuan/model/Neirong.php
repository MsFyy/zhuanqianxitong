<?php
namespace app\xueyuan\model;
use think\Model;
class Neirong extends Model
{
    public function index()
    {   

    }
     public function getmulu($id,$leixing)
    {   
      $map['zhuangtai']  = ['<>',-1];
      $map['zuozheid']  =$id;
      $map['zuozheleixing']  = $leixing;
      $order=[
              'paixu'=>'asc',
            ];
       return $this->where($map)
                   ->order($order)
                   ->select();
    }
    public function getjiaocheng($wenzhangid)
    {   
      $map['id']  =$wenzhangid;     
      return $this->where($map)
                   ->find();
    }
}
