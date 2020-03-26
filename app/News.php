<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     //指定表面
    protected $table = 'news';
    protected $primaryKey = 'new_id';
    public $timestamps = false;

    //黑名单
    protected $guarded = [];
}