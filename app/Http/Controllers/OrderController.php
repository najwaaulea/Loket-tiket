<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $orders = Order::with(['event.category','customer'])
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('orders.index', compact('orders','status'));
    }

    public function create()
    {
        $events = Event::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('orders.create', compact('events','customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id'    => ['required','exists:events,id'],
            'customer_id' => ['required','exists:customers,id'],
            'qty'         => ['required','integer','min:1'],
            'order_date'  => ['required','date'],
        ]);

        DB::transaction(function () use ($data) {
            $event = Event::lockForUpdate()->findOrFail($data['event_id']);

            if ($event->quota < $data['qty']) {
                abort(422, 'Kuota tiket tidak cukup.');
            }

            $unit = (int) $event->price;
            $total = $unit * (int) $data['qty'];

            Order::create([
                'event_id'     => $event->id,
                'customer_id'  => $data['customer_id'],
                'qty'          => $data['qty'],
                'unit_price'   => $unit,
                'total_price'  => $total,
                'order_date'   => $data['order_date'],
                'status'       => 'paid',
            ]);

            $event->decrement('quota', (int)$data['qty']);
        });

        return redirect()->route('orders.index')->with('success','Transaksi berhasil. Kuota berkurang.');
    }

    public function edit(Order $order)
    {
        $order->load(['event','customer']);
        $events = Event::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('orders.edit', compact('order','events','customers'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required','in:paid,cancelled'],
        ]);

        // sederhana: hanya ubah status (tanpa balikin quota otomatis)
        $order->update($data);

        return redirect()->route('orders.index')->with('success','Order diupdate.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success','Order dihapus.');
    }

    // tombol "Batalkan" = balikin kuota
    public function cancel(Order $order)
    {
        if ($order->status === 'cancelled') {
            return back()->with('success','Order sudah cancelled.');
        }

        DB::transaction(function () use ($order) {
            $order->load('event');
            $order->update(['status' => 'cancelled']);
            $order->event->increment('quota', (int)$order->qty);
        });

        return back()->with('success','Order dibatalkan. Kuota kembali bertambah.');
    }
}
