<?php
namespace App\Http\Controllers;
use App\Category;
class Common extends Controller{
    function getcateinfo($array,$pid=0,$level = 1){
    static $info = [];
    foreach($array as $key=>$value){
        if($value['pid'] == $pid){
            $info[] = $value;
            $value['level'] = $level;
            $this->getcateinfo($array,$value['cate_id'],$value['level']+1);
        }
    }
    return $info;
}
}

?>