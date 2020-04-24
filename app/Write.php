<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Write extends Model
{
    //指定的表名
    protected $table='write';
    //指定的主键
    protected $primaryKey='write_id';
    //关闭时间戳
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
