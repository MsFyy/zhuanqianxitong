<?php
namespace app\admin\model;
use think\Model;
class Jiesuan extends Model
{
    public function index()
    {   

    }
     public function gaofeijiesuanjilu()
    {   
        $data=[
            'shouruleixing'=>1,
      ];
       return $this->where($data)
                    ->paginate(6);
    }
    public function tuiguangjiesuanjilu()
    {   
        $data=[
            'shouruleixing'=>2,
      ];
       return $this->where($data)
                    ->paginate(6);
    }
    public function zhaopinjiesuanjilu()
    {   
        $data=[
            'shouruleixing'=>3,
      ];
       return $this->where($data)
                    ->paginate(6);
    }
    public function fukuanzhangdan()
    {   
       return $this->paginate(6);
    }
}
