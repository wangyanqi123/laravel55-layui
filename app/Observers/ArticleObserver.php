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
        $monolog = Log::getMonolog();
        $monolog->popHandler();
        Log::useFiles(storage_path('logs/job/article_observer.log'));
        Log::info('即将插入ID：$article->id到数据库[' . $article->content . ']');
        Redis::set("article_".$article->id, json_encode($article));
        //Log::info('已经插入用户到数据库[' . $article->id . ']' . $article->name);
    }

    public function saved(Article $article)
    {
        //按照日期计算的，一天一个 laravel.log 也会记录
        //Log::useDailyFiles(storage_path('logs/zabbix/error.log'));
        //指定一个日志 这两行不会再laravel.log记录
        $monolog = Log::getMonolog();
        $monolog->popHandler();
        Log::useFiles(storage_path('logs/job/article_observer.log'));
        Log::info('已经保存ID：'.$article->id.'到数据库[' . $article->content . ']');
        Redis::set("article_".$article->id, json_encode($article));
    }

    public function deleted(Article $article)
    {
        Redis::set("article_".$article->id, "");
        //Log::info('已经保存用户到数据库[' . $article->content . ']' . $article->title);
    }

}