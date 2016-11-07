<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralContent extends Model {

    protected $fillable = ['contenet'];
    protected $hidden = ['created_at', 'updated_at'];

}
