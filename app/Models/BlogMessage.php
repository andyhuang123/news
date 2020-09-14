<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class BlogMessage extends Model
{
    protected $table = 'blog_message';
     
     /**
     * 这个评论的所属用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    /**
     * 这个评论的子评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(BlogMessage::class, 'parent_id');
    } 
    
    public function getColumnNameAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setColumnNameAttribute($value)
    {
         
        $this->attributes['column_name'] = json_encode(array_values($value));
    }
    
    
}
