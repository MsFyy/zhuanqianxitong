<?php
namespace app\index\model;
use think\Model;
class Daohang extends Model
{
    public function index()
    {   

    }
     public function getdaohang()
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
}
