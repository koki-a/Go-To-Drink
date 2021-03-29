<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Situation;
use App\Genre;

class Shop extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class,'genre_id');
    }

    public function situations()
    {
        return $this->belongsToMany(Situation::class)->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class,'likes')->withTimestamps();
    }

    //いいね済み確認
    public function isLikedBy(?User $user)
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    //いいね数をカウントするアクセサ
    public function getCountLikesAttribute()
    {
        return $this->likes->count();
    }

}
