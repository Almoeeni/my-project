<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body'];

    public function user(){
        return $this->BelongsTo('App\User');
    }

    public function listing(){
        return $this->BelongsTo('App\Listing');
    }
}
