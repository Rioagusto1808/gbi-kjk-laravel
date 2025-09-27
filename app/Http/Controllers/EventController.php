<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

        // app/Http/Controllers/EventController.php
public function publicIndex()
{
    $event = \App\Models\Event::where('status', '!=', 'Selesai')
        ->orderByDesc('tanggal_mulai')
        ->paginate(12);

    return view('landing.event.index', compact('event'));
}

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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event', 'public');
        }

        Event::create($data);

        return redirect()->route('event.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        // kalau ada gambar baru
        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            // simpan gambar baru
            $data['image'] = $request->file('image')->store('event', 'public');
        }

        $event->update($data);

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
