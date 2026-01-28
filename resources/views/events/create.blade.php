@extends('layouts.app', ['title' => 'Tambah Event'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Tambah Event</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('events.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('events.store') }}">
      @include('events._form', ['btnText' => 'Simpan'])
    </form>
  </div>
</div>
@endsection
