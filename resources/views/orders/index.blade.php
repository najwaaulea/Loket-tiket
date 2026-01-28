@extends('layouts.app', ['title' => 'Transaksi'])

@section('content')
<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Transaksi</h1>

  <div class="d-flex gap-2 align-items-center">
    <form method="get" class="d-flex gap-2">
      <select name="status" class="form-select">
        <option value="all" @selected(($status ?? 'all')==='all')>Semua</option>
        <option value="paid" @selected(($status ?? 'all')==='paid')>Paid</option>
        <option value="cancelled" @selected(($status ?? 'all')==='cancelled')>Cancelled</option>
      </select>
      <button class="btn btn-primary">Filter</button>
    </form>

    <a class="btn btn-success" href="{{ route('orders.create') }}">+ Transaksi</a>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped align-middle mb-0">
        <thead>
          <tr>
            <th style="width:80px">ID</th>
            <th>Event</th>
            <th>Customer</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th style="width:320px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $o)
            <tr>
              <td>#{{ $o->id }}</td>
              <td>
                <div class="fw-semibold">{{ $o->event->name }}</div>
                <div class="text-muted small">{{ $o->event->category->name ?? '-' }}</div>
              </td>
              <td>
                <div class="fw-semibold">{{ $o->customer->name }}</div>
                <div class="text-muted small">{{ $o->customer->identity_no }}</div>
              </td>
              <td>{{ $o->qty }}</td>
              <td>Rp{{ number_format($o->unit_price,0,',','.') }}</td>
              <td class="fw-semibold">Rp{{ number_format($o->total_price,0,',','.') }}</td>
              <td>{{ $o->order_date?->format('Y-m-d H:i') }}</td>
              <td>
                @if($o->status === 'paid')
                  <span class="badge text-bg-success">Paid</span>
                @else
                  <span class="badge text-bg-secondary">Cancelled</span>
                @endif
              </td>
              <td class="d-flex flex-wrap gap-2">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('orders.edit',$o) }}">Edit</a>

                @if($o->status === 'paid')
                  <form method="post" action="{{ route('orders.cancel',$o) }}"
                        onsubmit="return confirm('Batalkan transaksi? Kuota akan dikembalikan.')">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-outline-warning">Batalkan</button>
                  </form>
                @endif

                <form method="post" action="{{ route('orders.destroy',$o) }}"
                      onsubmit="return confirm('Yakin hapus transaksi?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="9" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="mt-3">{{ $orders->links() }}</div>
@endsection
