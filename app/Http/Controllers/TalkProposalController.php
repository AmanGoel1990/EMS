<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Talkproposal;
use App\Models\revision;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TalkProposalController extends Controller
{
    public function store(Request $request)
    {
        $tag = new Tag();

        $filePath = $request->file('file')->store('presentation','public');

        $tag->name = $request->name;
        $tag->save();

        $talkproposal = new Talkproposal();
        $talkproposal->tag_id = $tag->id;
        $talkproposal->save();

        $user = Auth::id();
        $revision = new Revision();
        $revision->changes = $filePath;
        $revision->talk_proposal_id = $talkproposal->id;
        $revision->user_id = $user;
        $revision->save();

        return redirect()->route('proposal')->with('success', 'Proposal submitted successfully!');
    }

}
