<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 
 */
class Common extends Controller
{
	
	function _initialize()
	{
		$gongneng=model('Cate')->getlist();
		$this->assign('gongneng',$gongneng);
	}
}