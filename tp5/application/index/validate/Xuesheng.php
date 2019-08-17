<?php
namespace app\index\validate;
use think\Validate;
class Xuesheng extends Validate
{
    protected $rule = [
     ['name','require|max:25','姓名必须|名称最多不能超过25个字符'],
     ['chengji','require|max:25','成绩必须|名称最多不能超过25个字符'],
     ['banji','require|max:25','班级必须|名称最多不能超过25个字符'],
    ];

}
