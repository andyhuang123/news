<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
use Laravel\Scout\Searchable;

class BlogNavArticle extends Model
{
    use Searchable;
    
    protected $table = 'blog_nav_article';
 
    /**
     * Desc:关联导航
     * Date:2019/9/4/004
     */
    public function nav_name()
    {
        return $this->belongsTo(BlogNav::class, 'nav_id');
    }
    
     /**
     * 一篇文章有多个评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(BlogMessage::class,'foreign_id','id');
    } 
    
     /**
     * 获取这篇文章的评论以parent_id来分组
     * @return static
     */
    public function getComments()
    {
        return $this->comments()->with('owner')->get()->groupBy('parent_id');
    }
    
    public function toSearchableArray()
    { 
        return [
            'id' => $this->id,
            'article_title' => $this->article_title,
            'article_content' => strip_tags($this->article_content),
        ];
    }
   
}
