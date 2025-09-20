<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::latest()->paginate(10);
        return view('admin.event.index', compact('event'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(EventRequest $request)
    {
        Event::create($request->validated());
        return redirect()->route('event.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event berhasil dihapus.');
    }

    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

    public function jemaatIndex()
    {
        $event = Event::orderBy('tanggal_mulai', 'asc')->paginate(9);
        return view('jemaat.event.index', compact('event'));
    }

    public function jemaatShow(Event $event)
    {
        return view('jemaat.event.show', compact('event'));
    }
}
