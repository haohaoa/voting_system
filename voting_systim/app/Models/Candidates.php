<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name', 'program', 'vote_count', 'start_time', 'end_time'];
}
