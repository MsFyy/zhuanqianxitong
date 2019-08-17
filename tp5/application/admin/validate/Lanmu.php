<?php
namespace app\admin\validate;
use think\Validate;
class Lanmu extends Validate
{
    protected $rule = [
     ['name','require|max:125','名称不能为空|名称最多不能超过25个字符'],
     ['lianjie','require|max:125','链接不能为空|链接最多不能超过25个字符'],
    ];
   protected $scene = [
     'gongneng'=>['name'],
    ];
}
