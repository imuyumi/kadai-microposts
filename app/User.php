<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function microposts(){
        return $this->hasMany(Micropost::class);
    }
    // $user->followings で $user がフォローしている User 達を取得
    public function followings(){
        return $this->belongsToMany(User::class,'user_follow','user_id','follow_id')->withTimestamps();
    }
    // $user->followings で $user をフォローしている User 達を取得
    public function followers(){
        return $this->belongsToMany(User::class,'user_follow','follow_id','user_id')->withTimestamps();
    }
    // belongsToMany() では、
    // 第一引数にModel クラスを指定、
    // 第二引数に中間テーブル (user_follow) を指定、
    // 第三引数にuser_follow上の自分の id を示すカラム名 (user_id) を指定、
    // 第四引数にuser_follow上に保存されている関係先の id を示すカラム名 (follow_id) を指定。
    // withTimestamps() はuser_followにもcreated_at と updated_at を保存するためのメソッド
    
    //$userIdはfollowしたい人のID
    public function follow($userId){
        $exist=$this->is_following($userId);
        $its_me=$this->id==$userId;  //$userIDが自分のIDだった場合
        
        //すでにfollowしている場合または、$userIdが自分自身である場合
        if($exist || $its_me){
            return false;
        }else{
            $this->followings()->attach($userId);
            return true;
        }
    }
    public function unfollow($userId){
        $exist=$this->is_following($userId);
        $its_me=$this->id==$userId;
        //すでにfollowしている場合かつ、$userIdが自分自身では無い場合
        if($exist &&! $its_me){
            $this->followings()->detach($userId);
            return true;
        }else{
            return false;
        }
    }
        
        public function is_following($userId){
            return $this->followings()->where('follow_id',$userId)->exists();
            //渡された$userIdがuser_followテーブルのfollow_idに存在するかどうか
            //(既にフォローしているユーザーかどうか)確認
        }
    }
