<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Proposal;
use App\Mail\ProposalReviewed;

class ProposalController extends Controller
{
    function index() {
        return view('proposal');
    }
}
