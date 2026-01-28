@extends('layouts.app', ['title' => 'Kategori Event'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Kategori Event</h1>
  <a class="btn btn-success" href="{{ route('event-categories.create') }}">+ Tambah</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <table class="table table-striped align-middle mb-0">
      <thead>
        <tr>
          <th style="width:90px">ID</th>
          <th>Nama</th>
          <th style="width:220px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($categories as $c)
          <tr>
            <td>#{{ $c->id }}</td>
            <td class="fw-semibold">{{ $c->name }}</td>
            <td class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-primary" href="{{ route('event-categories.edit', $c) }}">Edit</a>

              <form method="post" action="{{ route('event-categories.destroy', $c) }}"
                    onsubmit="return confirm('Yakin hapus kategori ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="text-center text-muted py-4">Belum ada kategori.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $categories->links() }}</div>
@endsection
