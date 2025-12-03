<?php

namespace App\Http\Controllers;

use App\Models\InvitationSetting;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Display the invitation page.
     *
     * The guest name is taken from the `to` query parameter. If no
     * invitation settings exist the `invitation.empty` view will be shown.
     */
    public function show(Request $request)
    {
        // Get the guest name from the query string, defaulting to a generic label
        $guestName = $request->get('to', 'Tamu Undangan');

        // Retrieve the first invitation setting record
        $setting = InvitationSetting::first();

        if (!$setting) {
            return view('invitation.empty');
        }

        return view('invitation.tema-sage', [
            'setting' => $setting,
            'guestName' => $guestName,
        ]);
    }
}
