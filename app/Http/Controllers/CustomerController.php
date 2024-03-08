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
        return view('castomer.tabel', [
            "title" => "customer",
            "data" => Customer::all()
        ]);
    }
    public function create():view{
        return view('customer.tambah')->with(["title"=>"tambah data customer"]);
    }
}
