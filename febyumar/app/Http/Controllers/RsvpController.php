<?php

namespace App\Http\Controllers;

use App\Models\RsvpResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RsvpController extends Controller
{
    /**
     * Store a new RSVP response.
     */
    public function store(Request $request)
    {
        // Accept both underscore labels (frontend) and space labels (existing DB) and normalize
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'status' => ['required', Rule::in(['hadir', 'tidak hadir', 'tentatif'])],
            'number_of_guests' => 'nullable|integer|min:1|max:50',
            'message' => 'nullable|string|max:500',
        ]);

        // map incoming values to the canonical DB enum values
        $map = [
            'hadir' => 'hadir',
            'tidak_hadir' => 'tidak hadir',
            'tidak hadir' => 'tidak hadir',
            'ragu' => 'tentatif',
            'tentatif' => 'tentatif',
        ];

        $rawStatus = strtolower($validated['status']);
        $validated['status'] = $map[$rawStatus] ?? $validated['status'];

        $rsvp = RsvpResponse::create($validated);

        // jika request AJAX / fetch JSON, kembalikan JSON (frontend AJAX menunggu ini)
        if ($request->wantsJson() || $request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $rsvp
            ], 201);
        }

        return back()->with('success', 'Terima kasih! RSVP Anda berhasil disimpan.');
    }

    /**
     * Return messages (ucapan & doa) from rsvp_responses as JSON.
     */
    public function messages()
    {
        // debug: kembalikan statistik + beberapa baris supaya mudah inspeksi tanpa membuka DB
        \Log::debug('rsvp.messages called');

        $total = RsvpResponse::count();
        $withMessage = RsvpResponse::whereNotNull('message')->where('message', '<>', '')->count();
        $rows = RsvpResponse::orderBy('created_at', 'desc')->take(20)
            ->get(['id', 'name', 'status', 'message', 'created_at']);

        return response()->json([
            'total' => $total,
            'with_message' => $withMessage,
            'rows' => $rows,
        ]);
    }
}
