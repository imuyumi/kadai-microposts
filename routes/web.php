<?php

Route::get('/', 'MicropostsController@index');
Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');
Route::group(['middleware'=>['auth']],function(){
        Route::resource('users', 'UsersController',['only'=>['index','show']]);
        Route::group(['prefix'=>'users/{id}'],function(){
                Route::post('follow','UserFollowController@store')->name('user.follow');
                //POST /users/{id}/follow=>idが{id}番目のuserをfollowする
                Route::delete('unfollow','UserFollowController@destroy')->name('user.unfollow');
                //DELETE /users/{id}/unfollow=>idが{id}番目のuserのfollowをやめる
                Route::get('followings','UsersController@followings')->name('users.followings');
                //GET /users/{id}/followings=>idが{id}番目のuserがフォローしているユーザーを表示
                Route::get('followers','UsersController@followers')->name('users.followers');
                //GET /users/{id}/followers=>idが{id}番目のuserをフォローしているユーザーを表示
                
                Route::post('favorite','MicropostFavController@store')->name('micropost.fav'); //favする
                Route::delete('unfavorite','MicropostFavController@destroy')->name('micropost.unfav'); //favを外す
                Route::get('favorites','UsersController@favorites')->name('users.favorites'); //fav一覧を取得する
                Route::get('favoriters','UsersController@favoriters')->name('users.favoriters'); //favしているuser一覧を取得する
        });
        Route::resource('microposts', 'MicropostsController',['only'=>['store','destroy']]);
});