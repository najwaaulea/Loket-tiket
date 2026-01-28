@extends('layouts.app', ['title' => 'Edit Kategori Event'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Edit Kategori Event</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('event-categories.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('event-categories.update', $category) }}">
      @csrf
      @method('PUT')

      <label class="form-label">Nama Kategori</label>
      <input name="name" class="form-control" required value="{{ old('name', $category->name) }}">

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Update</button>
        <a class="btn btn-outline-secondary" href="{{ route('event-categories.index') }}">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
