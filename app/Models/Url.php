<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    //
    protected $fillable = ['original_url', 'short_code', 'user_id', 'click_count'];

    protected $hidden = [];


    // Define the relationship with the User model
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
