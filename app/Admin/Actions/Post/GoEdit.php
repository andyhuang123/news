<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class GoEdit extends RowAction
{
    public $name = '编辑文档';

    /**
     * @return string
     */
    public function href()
    {
        $href = "/admin/wiki/edit/" . $this->getKey();
       
        return  $href;
    }

}