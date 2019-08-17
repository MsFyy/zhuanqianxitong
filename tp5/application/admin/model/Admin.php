<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
    public function index()
    {   

    }
    public function getadmin()  
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
