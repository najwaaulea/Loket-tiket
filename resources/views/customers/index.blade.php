@extends('layouts.app', ['title' => 'Customer'])

@section('content')
<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Data Customer</h1>

  <div class="d-flex gap-2">
    <form method="get" class="d-flex gap-2">
      <input name="q" class="form-control" placeholder="Cari nama / ID / phone..." value="{{ $q ?? '' }}">
      <button class="btn btn-primary">Cari</button>
      <a class="btn btn-secondary" href="{{ route('customers.index') }}">Reset</a>
    </form>

    <a class="btn btn-success" href="{{ route('customers.create') }}">+ Tambah</a>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped align-middle mb-0">
        <thead>
          <tr>
            <th style="width:80px">ID</th>
            <th>Nama</th>
            <th>ID Customer</th>
            <th>Phone</th>
            <th>Alamat</th>
            <th style="width:220px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customers as $c)
            <tr>
              <td>#{{ $c->id }}</td>
              <td class="fw-semibold">{{ $c->name }}</td>
              <td>{{ $c->identity_no }}</td>
              <td>{{ $c->phone ?? '-' }}</td>
              <td class="text-truncate" style="max-width: 260px;">{{ $c->address ?? '-' }}</td>
              <td class="d-flex gap-2">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('customers.edit',$c) }}">Edit</a>

                <form method="post" action="{{ route('customers.destroy',$c) }}"
                      onsubmit="return confirm('Yakin hapus customer ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada customer.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="mt-3">{{ $customers->links() }}</div>
@endsection
