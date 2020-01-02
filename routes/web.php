<?php
//文件上传接口，前后台共用
Route::post('uploadImg', 'PublicController@uploadImg')->name('uploadImg');
Route::post('uploadImg_parse', 'PublicController@uploadImg_parse')->name('uploadImg_parse');
Route::post('uploadImg_cs', 'PublicController@uploadImg_cs')->name('uploadImg_cs');
//发送短信
Route::post('/sendMsg', 'PublicController@sendMsg')->name('sendMsg');

//Route::get('/','Home\IndexController@index')->name('home');

//支付
Route::group(['namespace' => 'Home'], function () {
    //微信支付
    Route::get('/wechatPay', 'PayController@wechatPay')->name('wechatPay');
    //微信支付回调
    Route::post('/wechatNotify', 'PayController@wechatNotify')->name('wechatNofity');

    Route::get('/alipay', 'PayController@aliPayScan');
    Route::get('/alipaynotify', 'PayController@aliPayNotify');
});

//会员-不需要认证
Route::group(['namespace'=>'Home','prefix'=>'member'],function (){
    //注册
    Route::get('register', 'MemberController@showRegisterForm')->name('home.member.showRegisterForm');
    Route::post('register', 'MemberController@register')->name('home.member.register');
    //登录
    Route::get('login', 'MemberController@showLoginForm')->name('home.member.showLoginForm');
    Route::post('login', 'MemberController@login')->name('home.member.login');
});
//会员-需要认证
Route::group(['namespace'=>'Home','prefix'=>'member','middleware'=>'member'],function (){
    //个人中心
    Route::get('/','MemberController@index')->name('home.member');
    //退出
    Route::get('logout', 'MemberController@logout')->name('home.member.logout');
});

//自己做的功能
Route::group(['namespace' => 'Home'], function () {
    //微信登录
    Route::get('/all', 'AllController@index')->name('all.index');
    //微信支付回调

});
