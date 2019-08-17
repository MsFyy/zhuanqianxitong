<?php
namespace app\admin\model;
use think\Model;
class Neirong extends Model
{
     public function getneirong()
    {   
      $order=[
              'paixu'=>'desc',
              'id'=>'desc',
            ];
       return $this->order($order)
                   ->select();
    }
    public function gengxinpaixu($id,$paixu)
    {   
      $map['id']=$id;
      $setField['paixu']=$paixu;
       return $this->where($map)
                   ->setField($setField);
    }
    public function xueyuangonggaoshuliang($id,$leixing)
    {   
       $map['zuozheid']=$id;
       $map['zuozheleixing']=$leixing;
       return $this->where($map)
                   ->count();
    }
}