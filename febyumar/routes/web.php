<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes handle the wedding invitation frontend and RSVP submission.
| An admin route is also redirected to the Filament dashboard.
|
*/

Route::get('/', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
// endpoint untuk ambil ucapan & doa dari tabel rsvp_responses
Route::get('/rsvp/messages', [RsvpController::class, 'messages'])->name('rsvp.messages');
