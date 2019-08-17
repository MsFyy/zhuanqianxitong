<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Jiesuanzhongxin extends Base
{
   //稿费结算的输出
    public function gaofeijiesuan()
    {   
        $gaofei=model('Gaofei')->gaofeijiesuan();
        $this->assign('gaofei',$gaofei);
        return $this->fetch();
    }  
    //稿费结算的详单
    public function gaofeijiesuanxiangdan()
    {   
        $shouruzheid=input('param.shouruzheid');
        $shouruzheleixing=input('param.shouruzheleixing');
        $gaofei=model('Gaofei')->gaofeijiesuanxiangdan($shouruzheid,$shouruzheleixing);
        $this->assign('gaofei',$gaofei);
        return $this->fetch();
    }  
    public function excel(){
        //1.从数据库中取出数据
        $list = model('Gaofei')->gaofeijiesuan();
        //2.加载PHPExcle类库
        vendor('PHPExcel.PHPExcel');
        //3.实例化PHPExcel类
        $objPHPExcel = new \PHPExcel();
        //4.激活当前的sheet表
        $objPHPExcel->setActiveSheetIndex(0);
        //5.设置表格头（即excel表格的第一行）
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '序号')                      
                ->setCellValue('B1', '收入者')
                ->setCellValue('C1', '稿费')
                ->setCellValue('D1', '结算状态');      
        //6.循环取出来的数组，将数据逐一添加到excel表格。
        for($i=0;$i<count($list);$i++){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.($i+2),$i+1);//序号
            $objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2),mingchengzhuanhuan($list[$i]['shouruzheid'],$list[$i]['shouruzheleixing']));//收入者
            $objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2),$list[$i]['shourutongji']);//收入
            $objPHPExcel->getActiveSheet()->setCellValue('D'.($i+2),$list[$i]['jiesuanzhuangtai']);//收入类型
           
        }
        //7.设置保存的Excel表格名称
        $filename = '稿费结算'.date('ymd',time()).'.xls';
        //8.设置当前激活的sheet表格名称；
        $objPHPExcel->getActiveSheet()->setTitle('稿费结算');
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
    public function gaofeijiesuandingdan()    
    {   
      $shouruzheid=input('param.shouruzheid');
      $shouruzheleixing=input('param.shouruzheleixing');
      $jiesuan=model('Gaofei')->gaofeidingdan($shouruzheid,$shouruzheleixing);
      $jiesuandanhao=mt_rand(100,1000000).time();
      $zongshouru=0.00;
      foreach ($jiesuan as $key=>$val){
       $zongshouru+=$val['shouru'];
       db('Gaofei')->update(['jiesuanzhuangtai'=>1,'jiesuandanhao'=>$jiesuandanhao,'id'=>$val['id']]); 
      }
      $pay['jiesuandanhao']=$jiesuandanhao;
      $pay['shouruzheid']=$shouruzheid;
      $pay['shouruzheleixing']=$shouruzheleixing;
      $pay['fukuanzhuangtai']=0;
      $pay['shouruleixing']=1;
      $pay['shouru']=$zongshouru;
      $res=model('jiesuan')->save($pay);
      if($res){
        $this->success('预结算成功');
      }else{
        $this->error('预结算失败');
      }
    }  

    public function gaofeijiesuanjilu()
    {   
        $gaofeijiesuanjilu=model('jiesuan')->gaofeijiesuanjilu();
        $this->assign('gaofeijiesuanjilu',$gaofeijiesuanjilu);
        return $this->fetch();
    }  
    public function tuiguangjiesuan()
    {   
       $tuiguangyongjin=model('Tuiguangyongjin')->tuiguangjiesuan();
        $this->assign('tuiguangyongjin',$tuiguangyongjin);
        return $this->fetch();
    }  
    //稿费结算的详单
    public function tuiguangjiesuanxiangdan()
    {   
        $shouruzheid=input('param.shouruzheid');
        $shouruzheleixing=input('param.shouruzheleixing');
        $tuiguangjiesuanxiangdan=model('Tuiguangyongjin')->tuiguangjiesuanxiangdan($shouruzheid,$shouruzheleixing);
        $this->assign('tuiguangjiesuanxiangdan',$tuiguangjiesuanxiangdan);
        return $this->fetch();
    }  
    public function tuiguangjiesuandingdan()    
    {   
        //$gaofei=model('Gaofei')->getgaofei();
      $shouruzheid=input('param.shouruzheid');
      $jiesuandanhao=mt_rand(100, 1000000).time();
      $shouruzheleixing=input('param.shouruzheleixing');
      $jiesuan=model('Tuiguangyongjin')->tuiguangdingdan($shouruzheid,$shouruzheleixing);
      $zongshouru = 0.00;
       foreach ($jiesuan as $key=>$val) { 
        $zongshouru += $val['shouru'];
        db("Tuiguangyongjin")->update(['jiesuanzhuangtai' => 1,'jiesuandanhao'=> $jiesuandanhao,'id'=>$val['id']]); 
           }
         $pay['jiesuandanhao']=$jiesuandanhao;
         $pay['shouruzheid']=$shouruzheid; 
         $pay['shouruzheleixing']=$shouruzheleixing;
         $pay['shouruleixing']=2;
         $pay['shouru']= $zongshouru;
         $res=model('jiesuan')->save($pay);
         if($res){
          $this->success('预结算成功');
          }else{
          $this->error('预结算失败');
          }  
    }  
    public function tuiguangjiesuanjilu()
    {   
        $tuiguangjiesuanjilu=model('jiesuan')->tuiguangjiesuanjilu();
        $this->assign('tuiguangjiesuanjilu',$tuiguangjiesuanjilu);
        return $this->fetch();
    }  
    public function zhaopinjiesuan()
    {   
       $zhaopinyongjin=model('Zhaopinyongjin')->zhaopinjiesuan();
        $this->assign('zhaopinyongjin',$zhaopinyongjin);
        return $this->fetch();
    }  
    public function zhaopinjiesuandingdan()    
    {   
        //$gaofei=model('Gaofei')->getgaofei();
      $shouruzheid=input('param.shouruzheid');
      $jiesuandanhao=mt_rand(100, 1000000).time();
      $shouruzheleixing=input('param.shouruzheleixing');
      $jiesuan=model('Zhaopinyongjin')->zhaopindingdan($shouruzheid,$shouruzheleixing);
      $zongshouru = 0.00;
       foreach ($jiesuan as $key=>$val) { 
        $zongshouru += $val['shouru'];
        db("Zhaopinyongjin")->update(['jiesuanzhuangtai' => 1,'jiesuandanhao'=> $jiesuandanhao,'id'=>$val['id']]); 
           }
         $pay['jiesuandanhao']=$jiesuandanhao;
         $pay['shouruzheid']=$shouruzheid; 
         $pay['shouruzheleixing']=$shouruzheleixing;
         $pay['shouruleixing']=3;
         $pay['shouru']= $zongshouru;
         $res=model('jiesuan')->save($pay);  
         if($res){
          $this->success('预结算成功');
          }else{
          $this->error('预结算失败');
          }  
    }  
    public function zhaopinjiesuanjilu()
    {    
        $zhaopinjiesuanjilu=model('jiesuan')->zhaopinjiesuanjilu();
        $this->assign('zhaopinjiesuanjilu',$zhaopinjiesuanjilu);
        return $this->fetch();
    }  
     public function fukuanzhangdan()
    {   
        $fukuanzhangdan=model('jiesuan')->fukuanzhangdan();
        $this->assign('fukuanzhangdan',$fukuanzhangdan);
        return $this->fetch();
    }  
    public function fukuanwancheng()
    {   
        $id=input('param.id');
        $shouruleixing=input('param.shouruleixing');
        $jiesuandanhao=input('param.jiesuandanhao');
        //dump($jiesuandanhao);exit;
        $fukuanwancheng=model('jiesuan')->update(['fukuanzhuangtai' => 1,'id'=>$id]);
        if($shouruleixing==1){
          $gaofei=model('Gaofei')->gaofeijiesuanfukuanjilu();
          //dump($gaofei);exit;
            foreach ($gaofei as $key=>$val) { 
             db('Gaofei')->where('jiesuandanhao', $jiesuandanhao)->update(['jiesuanzhuangtai' => 2]); 
             }
             $this->redirect('fukuanzhangdan');
        }elseif($shouruleixing==2){
          $tuiguangyongjin=model('Tuiguangyongjin')->tuiguangjiesuanfukuanjilu();
            foreach ($tuiguangyongjin as $key=>$val) { 
             db('Tuiguangyongjin')->where('jiesuandanhao', $jiesuandanhao)->update(['jiesuanzhuangtai' => 2]); 
            }
            $this->redirect('fukuanzhangdan');
        }elseif($shouruleixing==3){
           $zhaopinyongjin=model('Zhaopinyongjin')->zhaopinjiesuanfukuanjilu();
             foreach ($zhaopinyongjin as $key=>$val) { 
             db('Zhaopinyongjin')->where('jiesuandanhao', $jiesuandanhao)->update(['jiesuanzhuangtai' => 2]); 
             }
             $this->redirect('fukuanzhangdan');
        }
    }  
    public function fukuangaofeijiesuanxiangdan()
    {   
        $jiesuandanhao=input('param.jiesuandanhao');
        $gaofei=model('Gaofei')->fukuangaofeijiesuanxiangdan($jiesuandanhao);
        $this->assign('gaofei',$gaofei);
        return $this->fetch();
    }  
    public function fukuantuiguangjiesuanxiangdan()
    {   
        $jiesuandanhao=input('param.jiesuandanhao');
        $fukuantuiguangjiesuanxiangdan=model('Tuiguangyongjin')->fukuantuiguangjiesuanxiangdan($jiesuandanhao);
        $this->assign('fukuantuiguangjiesuanxiangdan',$fukuantuiguangjiesuanxiangdan);
        return $this->fetch();
    }  
    public function fukuanzhaopinjiesuanxiangdan()
    {   
        $jiesuandanhao=input('param.jiesuandanhao');
        $fukuanzhaopinjiesuanxiangdan=model('Zhaopinyongjin')->fukuanzhaopinjiesuanxiangdan($jiesuandanhao);
        $this->assign('fukuanzhaopinjiesuanxiangdan',$fukuanzhaopinjiesuanxiangdan);
        return $this->fetch();
    }  
}