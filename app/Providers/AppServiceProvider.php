<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        //左侧菜单
        view()->composer('admin.layout',function($view){
            $menus = \App\Models\Permission::with([
                'childs'=>function($query){$query->with('icon');}
                ,'icon'])->where('parent_id',0)->orderBy('sort','desc')->get();
            //添加
            if (auth()->user()){
                $unreadMessage = \App\Models\Message::where('read',1)->where('accept_uuid',auth()->user()->uuid)->count();
                $view->with('unreadMessage',$unreadMessage);
            }
            $cate = \App\Models\Category::with([
                'articles','icon'
            ])->get();
            $view->with('menus',$menus);
            $view->with('cate',$cate);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
