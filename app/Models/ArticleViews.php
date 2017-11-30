<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleViews extends Model
{
	protected $table = 'article_views';
    protected $fillable = ['article_id','created_by'];
}
