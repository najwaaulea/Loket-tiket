@extends('layouts.app', ['title' => 'Edit Transaksi'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Edit Transaksi</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('orders.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('orders.update', $order) }}">
      @csrf
      @method('PUT')
      @include('orders._form', ['btnText' => 'Update', 'mode' => 'edit'])
    </form>
  </div>
</div>
@endsection
