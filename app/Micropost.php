<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable=['content','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // $micropost->favoriters で $micropostをfavしている User 達を取得
    public function favoriters(){
        return $this->belongsToMany(User::class,'fav_micropost','micropost_id','user_id')->withTimestamps();
    }
    
}
