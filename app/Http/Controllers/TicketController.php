<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Rating;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Store a newly submitted ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'ticket_message' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:6',
        ]);

        // Create ticket
        Ticket::create([
            'message' => $request->ticket_message,
            'status' => 'pending',
        ]);

        // Create rating
        Rating::create([
            'rating' => $request->rating,
        ]);

        return redirect()->route('submit.ticket')->with('success', 'Thank you for your feedback!');
    }

    /**
     * Display all tickets in admin panel
     */
    public function adminIndex(Request $request)
    {
        $query = Ticket::query();
        
        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $tickets = $query->orderBy('created_at', 'desc')->paginate(20);
        $averageRating = Rating::avg('rating');
        $totalRatings = Rating::count();
        
        return view('admin.tickets.index', compact('tickets', 'averageRating', 'totalRatings'));
    }

    /**
     * Update ticket status
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket status updated!');
    }

    /**
     * Delete a ticket
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted successfully!');
    }
}
