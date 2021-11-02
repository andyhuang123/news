<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activity";
     
    public function getImageAttribute($image)
    {
        return 'https://www.seedblog.cn/uploads/'.$image;
    }


}
