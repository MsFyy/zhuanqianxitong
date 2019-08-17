<?php
namespace app\index\model;
use think\Model;
class Huandengpian extends Model
{
    public function index()
    {   

    }
     public function gethuandengpian()
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
