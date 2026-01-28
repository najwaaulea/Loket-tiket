@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nama</label>
    <input name="name" class="form-control" required value="{{ old('name', $customer->name ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">ID Customer (NIK/NIM/ID)</label>
    <input name="identity_no" class="form-control" required value="{{ old('identity_no', $customer->identity_no ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">No. HP (optional)</label>
    <input name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}">
  </div>

  <div class="col-12">
    <label class="form-label">Alamat (optional)</label>
    <textarea name="address" class="form-control" rows="3">{{ old('address', $customer->address ?? '') }}</textarea>
  </div>
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">{{ $btnText }}</button>
  <a class="btn btn-outline-secondary" href="{{ route('customers.index') }}">Batal</a>
</div>
