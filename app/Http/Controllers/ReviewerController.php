<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\TalkProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewerController extends Controller
{
    
    function index() {

        $tags = Tag::all();
        $talkproposal = DB::table('talkproposals')
            ->select('talkproposals.id', 'talkproposals.created_at', 'tags.name as tagname', 'revisions.changes as filepath')
            ->join('tags', 'tags.id', '=', 'talkproposals.tag_id')
            ->join('revisions', 'revisions.talk_proposal_id', '=', 'talkproposals.id')
            ->get();

        return view('reviewer_dashboard', compact('tags', 'talkproposal'));
    }


public function addReview()
     {
        $id = $_GET['id'];
        return view('review_comment', compact('id'));
     }

     public function submitreview(Request $request) {
        $user = Auth::id();
        
       $review = new Review();
        $review->reviewer_id = $user;
        $review->talk_proposal_id = $request->proposal_id;
        $review->rating = $request->rating;
        $review->comments = $request->comment;
        $review->save();
   
       return redirect()->route('dashboard')->with('success', 'Review submitted successfully!');
     }


}
