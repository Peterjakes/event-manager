<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Show all events created by the logged-in organizer
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('backend.events.index', compact('events'));
    }

    // Show event creation form
    public function create()
    {
        return view('backend.events.create');
    }

    // Store new event in database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        Event::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'price' => $request->price,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show form to edit existing event
    public function edit(Event $event)
    {
        $this->authorizeEvent($event);
        return view('backend.events.edit', compact('event'));
    }

    // Update event info
    public function update(Request $request, Event $event)
    {
        $this->authorizeEvent($event);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $event->update($request->all());
        
        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    // Delete event
    public function destroy(Event $event)
    {
        $this->authorizeEvent($event);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }

    // Ensure logged-in user is the owner of the event
    private function authorizeEvent(Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
