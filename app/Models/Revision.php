<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    //
    protected $fillable = [
        'changes',
        'user_id',
        'talk_proposal_id',
    ];
}
