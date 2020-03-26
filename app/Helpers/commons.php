<?php
    // 文件上传
     function uploads($img){
        $file = request()->$img;
        if($file->isValid()){
         $store_result = $file->store('uploads');
         return $store_result;
        }
        exit('上传失败');
    }


    // 多文件上传
     function Moreuploads($img){
        $file = request()->$img;

    foreach($file as $k=>$v){
        if($v->isValid()){
            $store_result[$k] = $v->store('uploads');
           }else{
            $store_result[$k] = '上传失败';
           }
        }
        return $store_result;
    }



?>