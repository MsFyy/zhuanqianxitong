<?php
namespace app\index\model;
use think\Model;
class Zhucexueyuan extends Model
{
    public function getstatus($xueyuanid)
    {   
       $map['id']=$xueyuanid;
       $map['zhuangtai']=2;
       return $this->where($map)
                   ->find();
    }
}
