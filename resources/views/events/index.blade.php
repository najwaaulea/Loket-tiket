@extends('layouts.app', ['title' => 'Event'])

@section('content')
<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Data Event</h1>

  <div class="d-flex gap-2">
    <form method="get" class="d-flex gap-2">
      <input name="q" class="form-control" placeholder="Cari event / lokasi / kategori..." value="{{ $q ?? '' }}">
      <button class="btn btn-primary">Cari</button>
      <a class="btn btn-secondary" href="{{ route('events.index') }}">Reset</a>
    </form>

    <a class="btn btn-success" href="{{ route('events.create') }}">+ Tambah</a>
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
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Tanggal</th>
            <th>Harga</th>
            <th>Kuota</th>
            <th style="width:220px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($events as $e)
            <tr>
              <td>#{{ $e->id }}</td>
              <td class="fw-semibold">{{ $e->name }}</td>
              <td>{{ $e->category->name ?? '-' }}</td>
              <td>{{ $e->location ?? '-' }}</td>
              <td>{{ $e->event_date?->format('Y-m-d H:i') }}</td>
              <td>Rp{{ number_format($e->price,0,',','.') }}</td>
              <td>
                @if($e->quota <= 0)
                  <span class="badge text-bg-danger">Habis</span>
                @else
                  <span class="badge text-bg-success">{{ $e->quota }}</span>
                @endif
              </td>
              <td class="d-flex gap-2">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('events.edit',$e) }}">Edit</a>

                <form method="post" action="{{ route('events.destroy',$e) }}"
                      onsubmit="return confirm('Yakin hapus event ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="8" class="text-center text-muted py-4">Belum ada event.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="mt-3">{{ $events->links() }}</div>
@endsection
