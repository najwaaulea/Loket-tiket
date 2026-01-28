@extends('layouts.app', ['title' => 'Edit Event'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Edit Event</h1>
  <a class="btn btn-secondary btn-sm" href="{{ route('events.index') }}">← Kembali</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('events.update', $event) }}">
      @csrf
      @method('PUT')
      @include('events._form', ['btnText' => 'Update'])
    </form>
  </div>
</div>
@endsection
