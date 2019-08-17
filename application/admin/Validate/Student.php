<?php
namespace app\admin\validate;
use think\Validate;
class Student extends Validate{

	 protected $rule = [
        'name'  =>  'require|max:25',
        'banji' =>  'require',
    ];
	}