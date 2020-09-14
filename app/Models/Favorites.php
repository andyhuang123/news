<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogNavArticle;

class Favorites extends Model
{
     protected $table = 'favorites';
     
     protected $fillable = [
                'user_id',
                'article_id'
         ];
         
    public function article(){
         return $this->belongsTo(BlogNavArticle::class,'article_id','id');
    }         
}
