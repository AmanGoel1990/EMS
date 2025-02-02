<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TalkProposalController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\PdfController;



Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/proposal', [ProposalController::class, 'index'])->middleware('auth')->name('proposal');
Route::post('/signup_create', [SignupController::class, 'signup'])->name('signup.post');
Route::post('/proposal_submit', [TalkProposalController::class, 'store'])->name('proposal.submit');
Route::get('/dashboard', [ReviewerController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/pdf/download', [PdfController::class, 'downloadPdf'])->name('pdf.download');
Route::get('/review', [ReviewerController::class, 'addReview'])->name('review');
Route::post('/feedback_submit', [ReviewerController::class, 'submitreview'])->name('reviewerfeedback');
Route::get('/dashboards', [ReviewerController::class, 'filter'])->name('filter');