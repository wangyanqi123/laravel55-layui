<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ArticleObserver
{
    public function saving(Article $article)
    {
        //Log::info('即将保存用户到数据库[' . $article->id . ']' . $article->name);
    }

    public function creating(Article $article)
    {
        //Log::info('即将插入用户到数据库[' . $article->id . ']' . $article->name);
    }

    public function updating(Article $article)
    {
        //Log::info('即将更新用户到数据库[' . $article->id . ']' . $article->name);
    }

    public function updated(Article $article)
    {
        //Log::info('已经更新用户到数据库[' . $article->id . ']' . $article->name);
    }

    public function created(Article $article)
    {
        Redis::set("article_".$article->id, json_encode($article));
        //Log::info('已经插入用户到数据库[' . $article->id . ']' . $article->name);
    }

    public function saved(Article $article)
    {
        Redis::set("article_".$article->id, json_encode($article));
        //Log::info('已经保存用户到数据库[' . $article->content . ']' . $article->title);
    }

    public function deleted(Article $article)
    {
        Redis::set("article_".$article->id, "");
        //Log::info('已经保存用户到数据库[' . $article->content . ']' . $article->title);
    }

}