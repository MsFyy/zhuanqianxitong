<?php
namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:20',
        'link'   => 'require|max:25',
       
    ];
    
    protected $message  =   [
        'name.require' => '栏目名称必须',
        'name.max'     => '名称最多不能超过20个字符',
        'link.require'   => '链接必须',
        
    ];
    
}
