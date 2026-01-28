<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->query('q',''));

        $customers = Customer::query()
            ->when($q !== '', fn($query) =>
                $query->where('name','like',"%{$q}%")
                      ->orWhere('identity_no','like',"%{$q}%")
                      ->orWhere('phone','like',"%{$q}%")
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers','q'));
    }

    public function create() { return view('customers.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:150'],
            'identity_no' => ['required','string','max:50','unique:customers,identity_no'],
            'phone'       => ['nullable','string','max:30'],
            'address'     => ['nullable','string'],
        ]);

        Customer::create($data);
        return redirect()->route('customers.index')->with('success','Customer ditambahkan.');
    }

    public function edit(Customer $customer) { return view('customers.edit', compact('customer')); }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:150'],
            'identity_no' => ['required','string','max:50','unique:customers,identity_no,'.$customer->id],
            'phone'       => ['nullable','string','max:30'],
            'address'     => ['nullable','string'],
        ]);

        $customer->update($data);
        return redirect()->route('customers.index')->with('success','Customer diupdate.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->orders()->exists()) {
            return back()->with('success','Customer tidak bisa dihapus karena ada transaksi.');
        }

        $customer->delete();
        return back()->with('success','Customer dihapus.');
    }
}
