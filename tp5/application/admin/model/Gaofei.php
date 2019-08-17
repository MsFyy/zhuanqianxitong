<?php
namespace app\admin\model;
use think\Model;
class Gaofei extends Model
{   
    public function gaofeijiesuan()
    {   
      $data=[
       'zhuangtai'=>1,
       'jiesuanzhuangtai'=>0,
      ];
      $field='id,shouruzheid,shouruzheleixing,sum(shouru) as shourutongji,jiesuanzhuangtai,create_time';
      $order=[
        'id'=>'desc',
      ];
      return $this->where($data)
                  ->field($field)
                  ->group('shouruzheid,shouruzheleixing')
                  ->order($order)
                  ->paginate(6);
    }
    public function gaofeijiesuanfukuanjilu()
    {   
      $data=[
       'zhuangtai'=>1,
       'jiesuanzhuangtai'=>1,
      ];
      return $this->where($data)
                  ->select();
    }
    public function gaofeijiesuanxiangdan($shouruzheid,$shouruzheleixing)
    {   
      $data=[
       'zhuangtai'=>1,
       'jiesuanzhuangtai'=>0,
       'shouruzheid'=>$shouruzheid,
       'shouruzheleixing'=>$shouruzheleixing,
      ];
      $order=[
        'id'=>'desc',
      ];
      return $this->where($data)
                  ->order($order)
                  ->paginate(6);
    }
     
     public function gaofeidingdan($shouruzheid,$shouruzheleixing)
    {   
      $data=[
       'zhuangtai'=>1,
       'jiesuanzhuangtai'=>0,
       'shouruzheid'=>$shouruzheid,
       'shouruzheleixing'=>$shouruzheleixing,
      ];
      $order=[
        'id'=>'desc',
      ];
      return $this->where($data)
                  ->order($order)
                  ->select();
    }
    public function fukuangaofeijiesuanxiangdan($jiesuandanhao)
    {   
      $data=[
       'jiesuandanhao'=>$jiesuandanhao,
      ];
      $order=[
        'id'=>'desc',
      ];
      return $this->where($data)
                  ->order($order)
                  ->paginate(6);
    }
}
