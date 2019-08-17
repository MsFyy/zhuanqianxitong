<?php
namespace app\admin\model;
use think\Model;
class Tuiguangyongjin extends Model
{   
    public function tuiguangjiesuan()
    {   
      $data=[
           'zhuangtai'=>1,
           'jiesuanzhuangtai'=>0,
      ];
     $order=[
              'id'=>'desc',
            ];
       return $this->where($data)
                   ->field('id,shouruzheid,shouruzheleixing,sum(shouru) as shourutongji,jiesuanzhuangtai')
                   ->group('shouruzheid,shouruzheleixing,jiesuanzhuangtai')
                   ->order($order)
                   ->paginate(6);
    }
     public function tuiguangjiesuanfukuanjilu()
    {   
      $data=[
       'zhuangtai'=>1,
       'jiesuanzhuangtai'=>1,
      ];
      return $this->where($data)
                  ->select();
    }
      public function tuiguangjiesuanxiangdan($shouruzheid,$shouruzheleixing)
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
     public function tuiguangdingdan($shouruzheid,$shouruzheleixing)
    {   
      $data=[
            'zhuangtai'=>1,
            'jiesuanzhuangtai'=>0,
            'shouruzheid'=>$shouruzheid,
            'shouruzheleixing'=>$shouruzheleixing,
      ];
       return $this->where($data)
                    ->select();
    }
    public function fukuantuiguangjiesuanxiangdan($jiesuandanhao)
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
