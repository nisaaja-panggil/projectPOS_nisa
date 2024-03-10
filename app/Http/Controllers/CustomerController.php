<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use illuminate\view\View;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('customer.tabel', [
            "title" => "customer",
            "data" => Customer::all()
        ]);
    }
    public function create():view{
        return view('customer.tambah')->with(["title"=>"tambah data customer"]);
    }
    public function store(Request $request):RedirectResponse{
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "address"=>"nullable"
        ]);
       Customer::create($request->all());
       return redirect()->route('pelanggan.index')->with('success data','data customer berhasil ditambahkan');
    }
    public function edit(Customer $pelanggan):view{
        return view('customer.edit',compact('pelanggan'))->with(["title"=>"ubah data customer"]);
    }
    public function update(Request $request, customer $pelanggan):RedirectResponse{
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "address"=>"nullable"
        ]);
       $pelanggan->update($request->all());
       return redirect()->route('pelanggan.index')->with('updated','data pelanggan berhasil di ubah');
    }
    public function show(Customer $pelanggan):view{
        return view('customer.tampil',compact('pelanggan'))
                          ->with(["title"=>"data customer"]);
    }
}
