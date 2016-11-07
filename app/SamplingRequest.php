<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SamplingRequest extends Model {

    protected $fillable = ['user_id', 'sampling_id', 'no_of_samples', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

}
