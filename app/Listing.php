<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    public function user(){
        return $this->BelongsTo('App\user');
    }

    public function comment(){
        return $this->HasMany('App\Comment');
    }
}
