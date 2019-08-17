<?php
namespace app\index\model;
use think\Model;
class Neirong extends Model
{
    public function index()
    {   

    }
     public function tuijianzhiding()
    {   
      $data=[
           'zhuangtai'=>3,
      ];
      $order=[
              'paixu'=>'asc',
               'id'=>'asc',
            ];
       return $this->where($data)
                   ->order($order)
                   ->select();
    }
     public function tuijian()
    {   
      $data=[
           'zhuangtai'=>2,
      ];
      $order=[
              'paixu'=>'asc',
               'id'=>'asc',
            ];
       return $this->where($data)
                   ->order($order)
                   ->select();
    }
    public function zuixinfabu()
    {   
      $data['zhuangtai']=['in','1,2,3'];
      $order=[
              'create_time'=>'desc',
               'id'=>'desc',
            ];
       return $this->where($data)
                   ->order($order)
                   ->select();
    }
    public function lookfree($wenzhangid)
    {   
      $map['id']=$wenzhangid;
      $map['jiage']=0;
       return $this->where($map)
                   ->find();
    }
    public function getcategorys($categorysid)
    {   
      $map['leibieer']=$categorysid;
      $map['zhuangtai']=['in','1,2,3'];
       return $this->where($map)
                    ->select();
    }
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
      $map['name']=['like','%'.$name.'%'];
      $map['zhuangtai']=['in','1,2,3'];
      $order=[
              'id'=>'desc',
            ];
       return $this->where($map)
                   ->order($order)
                   ->paginate(6);
    }
}
