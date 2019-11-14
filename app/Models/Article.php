<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Searchable;
    protected $fillable = ['category_id','title','keywords','description','content','thumb','click'];


    public function searchableAs()
    {
        return 'posts_index';
    }


    public function toSearchableArray()
    {
        $array = $this->toArray();
        // Customize array...
        return array_only($this->toArray(),['id','title']);
        //return $array;
    }

    //文章所属分类
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //与标签多对多关联
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','article_tag','article_id','tag_id');
    }


}
