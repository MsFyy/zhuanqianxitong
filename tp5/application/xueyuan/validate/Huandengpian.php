<?php
namespace app\admin\validate;
use think\Validate;
class Huandengpian extends Validate
{
    protected $rule = [
     ['name','require|max:25','名称不能为空|名称最多不能超过25个字符'],
     ['lianjie','require|max:25','链接不能为空|名称最多不能超过25个字符'],
     ['banji','require|max:25','班级必须|名称最多不能超过25个字符'],
    ];
   protected $scene = [
     'add'=>['name','lianjie'],
    ];
}
