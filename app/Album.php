<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function user(){
      return  $this->BelongsTo('App\user');
    }

    public function photos(){
      return $this->HasMany('App\photo');
    }
}
