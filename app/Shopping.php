<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $table="Shopping";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
