@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Kategori</label>
    <select name="event_category_id" class="form-select" required>
      <option value="">-- pilih --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}"
          @selected(old('event_category_id', $event->event_category_id ?? '') == $c->id)>
          {{ $c->name }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Nama Event</label>
    <input name="name" class="form-control" required value="{{ old('name', $event->name ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Lokasi</label>
    <input name="location" class="form-control" value="{{ old('location', $event->location ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Tanggal Event</label>
    <input type="datetime-local" name="event_date" class="form-control" required
           value="{{ old('event_date', isset($event) && $event->event_date ? $event->event_date->format('Y-m-d\TH:i') : now()->addDays(7)->format('Y-m-d\TH:i')) }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">Harga</label>
    <input type="number" min="0" name="price" class="form-control" required
           value="{{ old('price', $event->price ?? 0) }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">Kuota</label>
    <input type="number" min="0" name="quota" class="form-control" required
           value="{{ old('quota', $event->quota ?? 0) }}">
  </div>
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">{{ $btnText }}</button>
  <a class="btn btn-outline-secondary" href="{{ route('events.index') }}">Batal</a>
</div>
