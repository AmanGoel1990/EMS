<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        'reviewer_id',
        'comments',
        'rating',
        'talk_proposal_id',
    ];
}
