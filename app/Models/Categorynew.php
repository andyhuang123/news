<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Categorynew extends Model
{
    use ModelTree, AdminBuilder;

    protected $table= "categorynew";

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
