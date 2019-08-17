<?php
namespace app\admin\model;
use think\Model;
class Zhaopinyongjin extends Model
{   
    public function zhaopinjiesuan()
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
      public function zhaopinjiesuanfukuanjilu()
    {   
      $data=[
       'zhuangtai'=>1,
       'jiesuanzhuangtai'=>1,
      ];
      return $this->where($data)
                  ->select();
    }
     public function zhaopindingdan($shouruzheid,$shouruzheleixing)
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
    public function fukuanzhaopinjiesuanxiangdan($jiesuandanhao)
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
