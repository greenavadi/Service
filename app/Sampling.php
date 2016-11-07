<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sampling extends Model {
    protected $fillable  = ['name', 'description', 'status'];
    protected $hidden = ['status', 'created_at', 'updated_at'];

}
