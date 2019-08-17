<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status)
{
    if($status==-2){
         $str='<span class="label">未通过审核</span>';
      }elseif($status==-1){
         $str='<span class="label label-danger arrowed-in">删除</span>';
      }elseif($status==0){
          $str='<span class="label label-lg label-purple arrowed">审核中</span>';
      }elseif($status==1){
         $str='<span class="label label-success arrowed">通过审核</span>';
      }elseif($status==2){
         $str='<span class="label label-warning">推荐</span>';
      }elseif($status==3){
        $str='<span class="label label-sm label-primary arrowed arrowed-right">置顶</span>';
      }
    return $str;
}

function jiesuanzhuangtai($status)
{
    if($status==0){
        $str='<span class="label label-danger arrowed-in">未结算</span>';
      }else{
        $str='<span class="label label-success arrowed">已结算</span>';
      }
    return $str;
}
function get_leibie($id,$field)
{
    $leibie=db("Lanmu");
    $map['id']=$id;
    $info=$leibie->where($map)->field($field)->find();
    return $info[$field];
}

function jibie($jiebie)
{
    if($jiebie==1){
        $str='<span class="label label-success arrowed">正常</span>';
      }elseif($jiebie==2){
         $str='<span class="label label-success arrowed">最高</span>';
      }elseif($jiebie==-1){
         $str='<span class="label label-inverse">拉黑</span>';
      }
    return $str;
}
function fukuanzhuangtai($fukuanzhuangtai)
{
    if($fukuanzhuangtai==0){
        $str='<span class="label label-danger arrowed-in">未付款</span>';
      }elseif($fukuanzhuangtai==1){
       $str='<span class="label label-success arrowed">已付款</span>';
      }
    return $str;
}
function leixing($leixing)
{
    if($leixing==1){
        $str='微信学员';
      }elseif($leixing==2){
         $str='QQ学员';
      }elseif($leixing==3){
        $str='注册学员';
      }
    return $str;
}
function shouruleixing($shouruleixing)
{
    if($shouruleixing==1){
        $str='稿费';
      }elseif($shouruleixing==2){
         $str='推广佣金';
      }elseif($shouruleixing==3){
        $str='招聘佣金';
      }
    return $str;
}
function get_biaoti($id,$field)
{
    $leibie=db("Neirong");
    $map['id']=$id;
    $info=$leibie->where($map)->field($field)->find();
    return $info[$field];
}
function zuozhe($id,$field)
{
    $leibie=db("Neirong");
    $map['id']=$id;
    $info=$leibie->where($map)->field($field)->find();
    return $info[$field];
}
function mingchengzhuanhuan($id,$leixing)
{
    if($leixing==1){
       $leibie=db("Weixinxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['username'];
    }elseif($leixing==2){
      $leibie=db("Qqxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['username'];

    }elseif($leixing==3){
      $leibie=db("Zhucexueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['username'];
    }
}
function zhenshixingming($id,$leixing)
{
    if($leixing==1){
       $leibie=db("Weixinxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['xingming'];
    }elseif($leixing==2){
      $leibie=db("Qqxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['xingming'];

    }elseif($leixing==3){
      $leibie=db("Zhucexueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['xingming'];
    }
}

function yinhang($id,$leixing)
{
    if($leixing==1){
       $leibie=db("Weixinxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['yinhang'];
    }elseif($leixing==2){
      $leibie=db("Qqxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['yinhang'];

    }elseif($leixing==3){
      $leibie=db("Zhucexueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['yinhang'];
    }
}

function kaihuhang($id,$leixing)
{
    if($leixing==1){
       $leibie=db("Weixinxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['kaihuhang'];
    }elseif($leixing==2){
      $leibie=db("Qqxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['kaihuhang'];

    }elseif($leixing==3){
      $leibie=db("Zhucexueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['kaihuhang'];
    }
}

function yinhangzhanghao($id,$leixing)
{
    if($leixing==1){
       $leibie=db("Weixinxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['yinhangzhanghao'];
    }elseif($leixing==2){
      $leibie=db("Qqxueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['yinhangzhanghao'];

    }elseif($leixing==3){
      $leibie=db("Zhucexueyuan");
       $map['id']=$id;
       $info=$leibie->where($map)->find();
       return $info['yinhangzhanghao'];
    }
}
function get_client_ip()
{
    $cip="unknown";
    if($_SERVER['REMOTE_ADDR'])
    {
      $cip=$_SERVER['REMOTE_ADDR'];
    }elseif(getenv("REMOTE_ADDR")){
       $cip=getenv("REMOTE_ADDR");
    }
    return $cip;
}



