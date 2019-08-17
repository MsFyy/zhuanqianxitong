<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Huiyuan extends Base
{
    public function huiyuanlist()
    {   
        $name=input('param.name');
    	  $a=model('Qq')->buildSql();
        $b=model('Weixin')->buildSql();
        $c=model('zhucehuiyuan')->union([$a,$b])->buildSql();
        if(!empty($name)){
         $map['username']=['like','%'.$name.'%'];
         $list=Db::table($c.'name')
              ->where($map)
              ->paginate(6,false,[
                   'query'=>[
                    'name'=>$name,
                   ]
                ]);
        }else{
           $list=Db::table($c.'name')
              ->paginate(6);
        }
          $this->assign('list',$list);
        return $this->fetch();
    }  
    public function dingdanlist()
    {   
       $dingdanlist=model('Dingdan')->getdingdanlist();
        $this->assign('dingdanlist',$dingdanlist);
        return $this->fetch();
    }  
     public function zhuangtai()
    {  
      $data=input('param.');
      $id=input('param.id');
      $leixing=input('param.leixing');
      if($leixing==1){
          $qq=model('Qq')->get($id);
          if($qq->zhuangtai==$data['zhuangtai']){
            $this->error('状态无需重复改变11');
          }else{
            $res=model('Qq')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$id]);  
          }
          if($data['zhuangtai']==1){
            $chadingdan=model('Dingdan')->getdingdan($id,$leixing);
            if($chadingdan){
              $id=model('Dingdan')->where(['xueyuanid'=>$id,'xueyuanleixing'=>$leixing])->delete();
            }
          }
          if($data['zhuangtai']==2){
            $chadingdan=model('Dingdan')->getdingdan($id,$leixing);
            if($chadingdan){
               $this->error('此订单无需重复添加');
            }else{
              $xueyuan=model('Qq')->get($id);
              $suijishu1=mt_rand(100, 1000000);
              $dailifeiyong=[
            'shouruzheid'=>$xueyuan->dailixueyuanid,
            'shouruzheleixing'=>$xueyuan->dailixueyuanleixing,
            'dingdanhao'=>$xueyuan->dailixueyuanleixing.$xueyuan->dailixueyuanid.$suijishu1.time(),
            'xueyuanid'=>$id,
            'dailixueyuanid'=>$xueyuan->dailixueyuanid,
            'zongdailixueyuanid'=>$xueyuan->zongdailixueyuanid,
            'xueyuanleixing'=>$leixing,
            'dailixueyuanleixing'=>$xueyuan->dailixueyuanleixing,
            'zongdailixueyuanleixing'=>$xueyuan->zongdailixueyuanleixing,
            'jiesuanzhuangtai'=>0,
            'shouruleixing'=>1,
            'shouru'=>18,
            'zhuangtai'=>1,
            'riqi'=>time(),
              ];
              $chadailifeiyong=model('Dingdan')->insert($dailifeiyong);
              if(!$chadailifeiyong){
               $this->error('添加直接收入错误');
              }
              $suijishu2=mt_rand(100, 1000000);
              $zongdailifeiyong=[
            'shouruzheid'=>$xueyuan->zongdailixueyuanid,
            'shouruzheleixing'=>$xueyuan->zongdailixueyuanleixing,
            'dingdanhao'=>$xueyuan->dailixueyuanleixing.$xueyuan->dailixueyuanid.$suijishu2.time(),
            'xueyuanid'=>$id,
            'dailixueyuanid'=>$xueyuan->dailixueyuanid,
            'zongdailixueyuanid'=>$xueyuan->zongdailixueyuanid,
            'xueyuanleixing'=>$leixing,
            'dailixueyuanleixing'=>$xueyuan->dailixueyuanleixing,
            'zongdailixueyuanleixing'=>$xueyuan->zongdailixueyuanleixing,
            'jiesuanzhuangtai'=>0,
            'shouruleixing'=>2,
            'shouru'=>8,
            'zhuangtai'=>1,
            'riqi'=>time(),
              ];
              $chazongdailifeiyong=model('Dingdan')->insert($zongdailifeiyong);
              if($chazongdailifeiyong){
                 $this->success('订单提交成功');
              }else{
                  $this->error('订单生成失败');
              }
            }
          }  
      }elseif($data['leixing']==2){
        $qq=model('Weixin')->get($id);
          if($qq->zhuangtai==$data['zhuangtai']){
            $this->error('状态无需重复改变');
          }else{
            $res=model('Weixin')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$id]);  
          }
          if($data['zhuangtai']==1){
            $chadingdan=model('Dingdan')->getdingdan($id,$leixing);
            if($chadingdan){
              $id=model('Dingdan')->where(['xueyuanid'=>$id,'xueyuanleixing'=>$leixing])->delete();
            }
          }
          if($data['zhuangtai']==2){
            $chadingdan=model('Dingdan')->getdingdan($id,$leixing);
            if($chadingdan){
               $this->error('此订单无需重复添加');
            }else{
              $xueyuan=model('Weixin')->get($id);
              $suijishu1=mt_rand(100, 1000000);
              $dailifeiyong=[
            'name'=>$xueyuan->dailixueyuanid,
            'dingdanhao'=>$xueyuan->dailixueyuanleixing.$xueyuan->dailixueyuanid.$suijishu1.time(),
            'xueyuanid'=>$id,
            'dailixueyuanid'=>$xueyuan->dailixueyuanid,
            'zongdailixueyuanid'=>$xueyuan->zongdailixueyuanid,
            'xueyuanleixing'=>$leixing,
            'dailixueyuanleixing'=>$xueyuan->dailixueyuanleixing,
            'zongdailixueyuanleixing'=>$xueyuan->zongdailixueyuanleixing,
            'jiesuanzhuangtai'=>0,
            'shouruleixing'=>1,
            'shouru'=>18,
            'zhuangtai'=>1,
            'riqi'=>time(),
              ];
              $chadailifeiyong=model('Dingdan')->insert($dailifeiyong);
              if(!$chadailifeiyong){
               $this->error('添加直接收入错误');
              }
              $suijishu2=mt_rand(100, 1000000);
              $zongdailifeiyong=[
            'name'=>$xueyuan->zongdailixueyuanid,
            'dingdanhao'=>$xueyuan->dailixueyuanleixing.$xueyuan->dailixueyuanid.$suijishu2.time(),
            'xueyuanid'=>$id,
            'dailixueyuanid'=>$xueyuan->dailixueyuanid,
            'zongdailixueyuanid'=>$xueyuan->zongdailixueyuanid,
            'xueyuanleixing'=>$leixing,
            'dailixueyuanleixing'=>$xueyuan->dailixueyuanleixing,
            'zongdailixueyuanleixing'=>$xueyuan->zongdailixueyuanleixing,
            'jiesuanzhuangtai'=>0,
            'shouruleixing'=>2,
            'shouru'=>8,
            'zhuangtai'=>1,
            'riqi'=>time(),
              ];
              $chazongdailifeiyong=model('Dingdan')->insert($zongdailifeiyong);
              if($chazongdailifeiyong){
                 $this->success('订单提交成功');
              }else{
                  $this->error('订单生成失败');
              }
            }
          }



      }elseif($data['leixing']==3){
        $qq=model('Zhucehuiyuan')->get($id);
          if($qq->zhuangtai==$data['zhuangtai']){
            $this->error('状态无需重复改变');
          }else{
            $res=model('Zhucehuiyuan')->save(['zhuangtai'=>$data['zhuangtai']],['id'=>$id]);  
          }
          if($data['zhuangtai']==1){
            $chadingdan=model('Dingdan')->getdingdan($id,$leixing);
            if($chadingdan){
              $id=model('Dingdan')->where(['xueyuanid'=>$id,'xueyuanleixing'=>$leixing])->delete();
            }
          }
          if($data['zhuangtai']==2){
            $chadingdan=model('Dingdan')->getdingdan($id,$leixing);
            if($chadingdan){
               $this->error('此订单无需重复添加');
            }else{
              $xueyuan=model('Zhucehuiyuan')->get($id);
              $suijishu1=mt_rand(100, 1000000);
              $dailifeiyong=[
            'name'=>$xueyuan->dailixueyuanid,
            'dingdanhao'=>$xueyuan->dailixueyuanleixing.$xueyuan->dailixueyuanid.$suijishu1.time(),
            'xueyuanid'=>$id,
            'dailixueyuanid'=>$xueyuan->dailixueyuanid,
            'zongdailixueyuanid'=>$xueyuan->zongdailixueyuanid,
            'xueyuanleixing'=>$leixing,
            'dailixueyuanleixing'=>$xueyuan->dailixueyuanleixing,
            'zongdailixueyuanleixing'=>$xueyuan->zongdailixueyuanleixing,
            'jiesuanzhuangtai'=>0,
            'shouruleixing'=>1,
            'shouru'=>18,
            'zhuangtai'=>1,
            'riqi'=>time(),
              ];
              $chadailifeiyong=model('Dingdan')->insert($dailifeiyong);
              if(!$chadailifeiyong){
               $this->error('添加直接收入错误');
              }
              $suijishu2=mt_rand(100, 1000000);
              $zongdailifeiyong=[
            'name'=>$xueyuan->zongdailixueyuanid,
            'dingdanhao'=>$xueyuan->dailixueyuanleixing.$xueyuan->dailixueyuanid.$suijishu2.time(),
            'xueyuanid'=>$id,
            'dailixueyuanid'=>$xueyuan->dailixueyuanid,
            'zongdailixueyuanid'=>$xueyuan->zongdailixueyuanid,
            'xueyuanleixing'=>$leixing,
            'dailixueyuanleixing'=>$xueyuan->dailixueyuanleixing,
            'zongdailixueyuanleixing'=>$xueyuan->zongdailixueyuanleixing,
            'jiesuanzhuangtai'=>0,
            'shouruleixing'=>2,
            'shouru'=>8,
            'zhuangtai'=>1,
            'riqi'=>time(),
              ];
              $chazongdailifeiyong=model('Dingdan')->insert($zongdailifeiyong);
              if($chazongdailifeiyong){
                 $this->success('订单提交成功');
              }else{
                  $this->error('订单生成失败');
              }
            }
          }  
    }
      if($res){
        $this->success('更新成功');
      }else{
        $this->error('更新失败');
      }
    } 
     public function excel(){
        //1.从数据库中取出数据
        $list = model('Dingdan')->select();
        //2.加载PHPExcle类库
        vendor('PHPExcel.PHPExcel');
        //3.实例化PHPExcel类
        $objPHPExcel = new \PHPExcel();
        //4.激活当前的sheet表
        $objPHPExcel->setActiveSheetIndex(0);
        //5.设置表格头（即excel表格的第一行）
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')                      
                ->setCellValue('B1', '账户')
                ->setCellValue('C1', '账号类型')
                ->setCellValue('D1', '收入')
                ->setCellValue('E1', '收入类型')
                ->setCellValue('F1', '收入日期')
                ->setCellValue('G1', '结算日期')
                ->setCellValue('H1', '结算状态');
        
        //6.循环刚取出来的数组，将数据逐一添加到excel表格。
        for($i=0;$i<count($list);$i++){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.($i+2),$list[$i]['id']);//添加ID
            $objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2),shouruzhe($list[$i]['shouruzheid'],$list[$i]['shouruzheleixing']));//账号
            $objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2),leixing($list[$i]['shouruzheleixing']));//账号类型
            $objPHPExcel->getActiveSheet()->setCellValue('D'.($i+2),$list[$i]['shouru']);//收入
            $objPHPExcel->getActiveSheet()->setCellValue('E'.($i+2),shouruzhe($list[$i]['shouruzheid'],$list[$i]['shouruzheleixing']));//收入类型
            $objPHPExcel->getActiveSheet()->setCellValue('F'.($i+2),date('Y-m-d H:i:s',$list[$i]['riqi']));//收入日期
             $objPHPExcel->getActiveSheet()->setCellValue('G'.($i+2),$list[$i]['update_time']);//结算日期
              $objPHPExcel->getActiveSheet()->setCellValue('H'.($i+2),jiesuanzhuangtai($list[$i]['jiesuanzhuangtai']));//结算状态
        }
        //7.设置保存的Excel表格名称
        $filename = '订单列表'.date('ymd',time()).'.xls';
        //8.设置当前激活的sheet表格名称；
        $objPHPExcel->getActiveSheet()->setTitle('订单列表');
        //9.设置浏览器窗口下载表格
        header("Content-Type: application/force-download");  
        header("Content-Type: application/octet-stream");  
        header("Content-Type: application/download");  
        header('Content-Disposition:inline;filename="'.$filename.'"');  
        //生成excel文件
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        //下载文件在浏览器窗口
        $objWriter->save('php://output');
        exit;
    }
     public function jiesuanzhuangtai()
    {  
      $data=input('param.');
      $res=model('Dingdan')->update(['jiesuanzhuangtai'=>$data['jiesuanzhuangtai']],['id'=>$data['id']]);
      //$xuesheng=model('Xuesheng')->get($id);
      ///$result=$xuesheng->delete();
      if($res){
        $this->success('成功');
      }else{
        $this->error('失败');
      }
    } 
}