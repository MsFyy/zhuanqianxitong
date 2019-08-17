<?php
namespace app\admin\model;
use think\Model;
class Zhucexueyuan extends Model
{
    public function getlist()
    {   
      $order=[
              'id'=>'desc',
            ];
       return $this->order($order)
                   ->paginate(6);
    }
    public function getchaxunlist($name)
    {   
      $map['username']=['like','%'.$name.'%'];
      $order=[
              'id'=>'desc',
            ];
       return $this->where($map)
                   ->order($order)
                   ->paginate(6);
    }
}
