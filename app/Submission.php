<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function student()
    {
        return $this->belongsTo('App\User','student_id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Assignment','assignment_id');
    }
}
