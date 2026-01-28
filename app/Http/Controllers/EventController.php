<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->query('q',''));

        $events = Event::with('category')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name','like',"%{$q}%")
                      ->orWhere('location','like',"%{$q}%")
                      ->orWhereHas('category', fn($cq) => $cq->where('name','like',"%{$q}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('events.index', compact('events','q'));
    }

    public function create()
    {
        $categories = EventCategory::orderBy('name')->get();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_category_id' => ['required','exists:event_categories,id'],
            'name'              => ['required','string','max:200'],
            'location'          => ['nullable','string','max:150'],
            'event_date'        => ['required','date'],
            'price'             => ['required','integer','min:0'],
            'quota'             => ['required','integer','min:0'],
        ]);

        Event::create($data);
        return redirect()->route('events.index')->with('success','Event ditambahkan.');
    }

    public function edit(Event $event)
    {
        $categories = EventCategory::orderBy('name')->get();
        return view('events.edit', compact('event','categories'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'event_category_id' => ['required','exists:event_categories,id'],
            'name'              => ['required','string','max:200'],
            'location'          => ['nullable','string','max:150'],
            'event_date'        => ['required','date'],
            'price'             => ['required','integer','min:0'],
            'quota'             => ['required','integer','min:0'],
        ]);

        $event->update($data);
        return redirect()->route('events.index')->with('success','Event diupdate.');
    }

    public function destroy(Event $event)
    {
        // aman: jangan hapus kalau sudah ada order
        if ($event->orders()->exists()) {
            return back()->with('success','Event tidak bisa dihapus karena sudah ada transaksi.');
        }

        $event->delete();
        return back()->with('success','Event dihapus.');
    }
}
