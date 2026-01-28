@extends('layouts.app', ['title' => 'Tambah Kategori Event'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Tambah Kategori Event</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('event-categories.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('event-categories.store') }}">
      @csrf

      <label class="form-label">Nama Kategori</label>
      <input name="name" class="form-control" required value="{{ old('name') }}" placeholder="contoh: Konser">

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Simpan</button>
        <a class="btn btn-outline-secondary" href="{{ route('event-categories.index') }}">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
