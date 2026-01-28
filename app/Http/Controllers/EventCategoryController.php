<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::latest()->paginate(10);
        return view('event_categories.index', compact('categories'));
    }

    public function create() { return view('event_categories.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100','unique:event_categories,name'],
        ]);

        EventCategory::create($data);
        return redirect()->route('event-categories.index')->with('success','Kategori event ditambahkan.');
    }

    public function edit(EventCategory $event_category)
    {
        return view('event_categories.edit', ['category' => $event_category]);
    }

    public function update(Request $request, EventCategory $event_category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100','unique:event_categories,name,'.$event_category->id],
        ]);

        $event_category->update($data);
        return redirect()->route('event-categories.index')->with('success','Kategori event diupdate.');
    }

    public function destroy(EventCategory $event_category)
    {
        $event_category->delete();
        return back()->with('success','Kategori event dihapus.');
    }
}
