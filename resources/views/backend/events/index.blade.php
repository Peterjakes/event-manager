@extends('backend.events.layout')

@section('content')
<div class="container">
    <h2>My Events</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">+ Create New Event</a>
    @foreach ($events as $event)
        <div class="card mb-3 p-3">
            <h4>{{ $event->name }}</h4>
            <p>{{ $event->description }}</p>
            <p><strong>Date:</strong> {{ $event->event_date }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Price:</strong> KES {{ $event->price }}</p>
            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @endforeach
</div>
@endsection