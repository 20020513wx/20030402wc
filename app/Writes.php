<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writes extends Model
{
    //指定的表名
    protected $table='writes';
    //指定的主键
    protected $primaryKey='p_id';
    //关闭时间戳
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
