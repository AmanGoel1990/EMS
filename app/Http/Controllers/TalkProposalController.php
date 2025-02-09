<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Talkproposal;
use App\Models\Revision;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class TalkProposalController extends Controller
{
    public function store(Request $request)
    {
        $filePath = $request->file('file')->store('presentation','public');

        $tag = Tag::create([
            'name' => $request->name,
        ]);

        $talkproposal = Talkproposal::create([
            'tag_id' => $tag->id,
        ]);

        $user = Auth::id();

        $revision = Revision::create([
            'changes'       => $filePath,
            'talk_proposal_id'  => $talkproposal->id,
            'user_id'            => $user,
        ]);

        return redirect()->route('proposal')->with('success', 'Proposal submitted successfully!');
    }
    public function getStatistics()
    {
        $totalProposals = TalkProposal::count();
        $averageRating = Review::avg('rating');
        
        $proposalsPerTag = TalkProposal::select('tags.name', DB::raw('COUNT("tag_id") as proposal'))
            ->join('tags', 'tags.id', '=', 'talkproposals.tag_id')
            ->groupBy('tag_id')
            ->get();

        return response()->json([
            'total_proposals' => $totalProposals,
            'average_rating' => round($averageRating, 2),
            'proposals_per_tag' => $proposalsPerTag
        ]);
    }
}
