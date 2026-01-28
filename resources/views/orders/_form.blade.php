@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Event</label>
    <select name="event_id" class="form-select" required>
      <option value="">-- pilih event --</option>
      @foreach($events as $e)
        <option value="{{ $e->id }}"
          @selected(old('event_id', $order->event_id ?? '') == $e->id)>
          {{ $e->name }} (quota: {{ $e->quota }}) - Rp{{ number_format($e->price,0,',','.') }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Customer</label>
    <select name="customer_id" class="form-select" required>
      <option value="">-- pilih customer --</option>
      @foreach($customers as $c)
        <option value="{{ $c->id }}"
          @selected(old('customer_id', $order->customer_id ?? '') == $c->id)>
          {{ $c->name }} - {{ $c->identity_no }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-4">
    <label class="form-label">Qty</label>
    <input type="number" min="1" name="qty" class="form-control" required
           value="{{ old('qty', $order->qty ?? 1) }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">Tanggal</label>
    <input type="datetime-local" name="order_date" class="form-control" required
           value="{{ old('order_date', isset($order) && $order->order_date ? $order->order_date->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
  </div>

  @isset($order)
    @if(($mode ?? '') === 'edit')
      <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="paid" @selected(old('status', $order->status) === 'paid')>Paid</option>
          <option value="cancelled" @selected(old('status', $order->status) === 'cancelled')>Cancelled</option>
        </select>
      </div>
    @endif
  @endisset
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">{{ $btnText }}</button>
  <a class="btn btn-outline-secondary" href="{{ route('orders.index') }}">Batal</a>
</div>
