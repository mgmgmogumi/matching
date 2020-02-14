<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function from_user()
    {
        return $this->belongsTo('App\User', 'from_user_id', 'id');
    }

    public function to_user()
    {
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }
}
