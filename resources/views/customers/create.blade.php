@extends('layouts.app', ['title' => 'Tambah Customer'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Tambah Customer</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('customers.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('customers.store') }}">
      @include('customers._form', ['btnText' => 'Simpan'])
    </form>
  </div>
</div>
@endsection
