<?php
namespace app\xueyuan\validate;
use think\Validate;
class Xueyuan extends Validate
{
    protected $rule = [
     ['username','require|max:25','名称不能为空|名称最多不能超过25个字符'],
     ['password','require','密码不能为空'],
     ['banji','require|max:25','班级必须|名称最多不能超过25个字符'],
    ];
   protected $scene = [
     'add'=>['username','password'],
    ];
}
