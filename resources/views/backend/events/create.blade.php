@extends('backend.events.layout')

@section('content')
<div class="container">
    <h2>{{ isset($event) ? 'Edit' : 'Create' }} Event</h2>
    <form method="POST" action="{{ isset($event) ? route('events.update', $event) : route('events.store') }}">
        @csrf
        @if(isset($event)) @method('PUT') @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $event->name ?? old('name') }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $event->description ?? old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="event_date" class="form-control" value="{{ $event->event_date ?? old('event_date') }}" required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location ?? old('location') }}" required>
        </div>
        <div class="mb-3">
            <label>Price (KES)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $event->price ?? old('price') }}" required>
        </div>
        <button type="submit" class="btn btn-success">{{ isset($event) ? 'Update' : 'Create' }} Event</button>
    </form>
</div>
@endsection
