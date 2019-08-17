<?php
namespace app\admin\model;
use think\Model;
class Dingdan extends Model
{
    public function add($data) {
        
        //$data['create_time'] = time();
        $this->save($data);
        return $this->id;

    }
     public function getdingdanlist()
    {   
      $data=[
           'zhuangtai'=>1,
      ];
      $order=[
              'riqi'=>'asc',
            ];
       return $this->where($data)
                   ->order($order)
                   ->paginate(6);
    }
    public function getdingdan($id,$leixing) {
      $field='xueyuanid,xueyuanleixing';
      $map['xueyuanid']=$id;
      $map['xueyuanleixing']=$leixing;
      $list=$this->field($field)
                  ->where($map)
                  ->select();
       return $list;            
    }
}
