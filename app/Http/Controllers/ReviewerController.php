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
use App\Models\User;

class ReviewerController extends Controller
{
    
    function index() {

        $tags = Tag::groupBy('name')->get();

        $talkproposal = TalkProposal::select('talkproposals.id', 'talkproposals.created_at', 'tags.name as tagname', 'revisions.changes as filepath', 'users.name as speaker_name', 'tags.id as tagid')
                        ->join('tags', 'tags.id', '=', 'talkproposals.tag_id')
                        ->join('revisions', 'revisions.talk_proposal_id', '=', 'talkproposals.id')
                        ->join('users', 'users.id', '=', 'revisions.user_id')
                        ->get();

        $users = User::select('id', 'name')->where('role', 'speaker')->get();

        return view('reviewer_dashboard', compact('tags', 'talkproposal', 'users'));
    }


    public function addReview() {
        $id = $_GET['id'];
        return view('review_comment', compact('id'));
    }

    public function submitreview(Request $request) {
        $user = Auth::id();
        $review = Review::create([
            'reviewer_id'       => $user,
            'talk_proposal_id'  => $request->proposal_id,
            'rating'            => $request->rating,
            'comments'          => $request->comment,
        ]);
   
        return redirect()->route('dashboard')->with('success', 'Review submitted successfully!');
    }

    public function filter() {
        $user_id = $_GET['user'];
        $tag = $_GET['tag'];
        
        $date = $_GET['date_submitted'];
        $tags = DB::table('tags')
            ->groupBy('name')
            ->get();
        $talkproposal = TalkProposal::select('talkproposals.id', 'talkproposals.created_at', 'tags.name as tagname', 'revisions.changes as filepath', 'users.name as speaker_name')
            ->join('tags', 'tags.id', '=', 'talkproposals.tag_id')
            ->join('revisions', 'revisions.talk_proposal_id', '=', 'talkproposals.id')
            ->join('users', 'users.id', '=', 'revisions.user_id')
            ->when(!empty($user_id), function ($q) {
                $q->where('revisions.user_id', $_GET['user']);
            })
            ->when(!empty($tag), function ($q) {
                $q->where('talkproposals.tag_id', $_GET['tag']);
            })
            ->when(!empty($date), function ($q) {
                $date = $_GET['date_submitted'];
                $q->where('talkproposals.created_at', 'LIKE', "$date%");
            })
            ->get();

        $users = User::select('id', 'name')
            ->where('role', 'speaker')
            ->get();
        return view('reviewer_dashboard', compact('tags', 'talkproposal', 'users'));
    }
    
    public function list() {
        $reviewers = Review::select('users.name as Reviewer Name', 'tags.name as Tag Name', 'reviews.comments as Comments', 'reviews.rating as Rating')
                    ->join('talkproposals', 'talkproposals.id', '=', 'reviews.talk_proposal_id')
                    ->join('tags', 'tags.id', '=', 'talkproposals.tag_id')
                    ->join('users', 'users.id', '=', 'reviews.reviewer_id')
                    ->get();
        
        return response()->json($reviewers);
    }

    public function fetch_by_talk_proposal(Request $request) {
        $reviewers = Review::select('users.name as Reviewer Name', 'tags.name as Tag Name', 'reviews.comments as Comments', 'reviews.rating as Rating')
                    ->join('talkproposals', 'talkproposals.id', '=', 'reviews.talk_proposal_id')
                    ->join('tags', 'tags.id', '=', 'talkproposals.tag_id')
                    ->join('users', 'users.id', '=', 'reviews.reviewer_id')
                    ->where('tags.name', $request->input('name'))
                    ->get();
        
        return response()->json($reviewers);
    }

}
