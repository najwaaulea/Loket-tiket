@extends('layouts.app', ['title' => 'Transaksi Baru'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Transaksi Baru</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('orders.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('orders.store') }}">
      @include('orders._form', ['btnText' => 'Simpan', 'mode' => 'create'])
    </form>
  </div>
</div>
@endsection
