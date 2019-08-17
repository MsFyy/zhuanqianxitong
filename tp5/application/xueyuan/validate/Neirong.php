<?php
namespace app\xueyuan\validate;
use think\Validate;
class Neirong extends Validate
{
    protected $rule = [
     ['name','require|max:25|chsDash|token','名称不能为空|名称最多不能超过25个字符|汉字、字母、数字和下划线_及破折号-'],
     ['dalei','require','类别不能为空'],
     ['zilei','require','子类为数字'],
     ['paixu','require|number','排序不能为空|必须为数字'],
     ['banji','require|max:25','班级必须|名称最多不能超过25个字符'],
    ];
   protected $scene = [
     'add'=>['name'],
     'kechengadd'=>['name','dalei','zilei'],
     'jieadd'=>['name','paixu'],
    ];
}
