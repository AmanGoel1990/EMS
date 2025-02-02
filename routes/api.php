<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TalkProposalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/all_reviewers', [ReviewerController::class, 'list']);
Route::post('/reviewers_by_talk_proposals', [ReviewerController::class, 'fetch_by_talk_proposal']);
Route::get('/talks/statistics', [TalkProposalController::class, 'getStatistics']);
