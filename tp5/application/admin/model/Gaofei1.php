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
     $order=[
              'id'=>'desc',
            ];
       return $this->where($data)
                   ->field('id,shouruzheid,shouruzheleixing,sum(shouru) as shourutongji,jiesuanzhuangtai')
                   ->group('shouruzheid,shouruzheleixing,jiesuanzhuangtai')
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
       return $this->where($data)
                    ->select();
    }
}
