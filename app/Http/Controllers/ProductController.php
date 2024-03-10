<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $product=product::all();
        return view('product.index',[
            "title"=>"product",
            "data"=>$product
        ]);
    }
    public function create():View{
        return view('product.create')->with([
            "title"=>"tambah data product",
            "data"=>category::all()
        ]);
    }
    public function store(Request $request):RedirectResponse{
        $request->validate([
            "name"=>"required",
            "description"=>"nullable",
            "stock"=>"required",
            "price"=>"required",
            "category_id"=>"required"
        ]);
        Product::create($request->all());
        return redirect()->route('product.index')->with('succsess','data produk berhasil ditambahkan');
    }
    public function edit(product $product):view{
        return view('product.edit',compact('product'))->with([
            "title"=>"ubah data produk",
            "data"=>category::all()
        ]);
    }
    public function update(product $product, request $request):RedirectResponse{
        $request->validate([
            "name"=>"required",
            "description"=>"nullable",
            "stock"=>"required",
            "price"=>"required",
            "category_id"=>"required"
        ]);
        $product->update($request->all());
        return redirect()->route('product.index')->with('updated','data produk berhasil di ubah');
    }
    public function show($id): View {
        $product = Product::findOrFail($id);
        return view('product.show')->with([
            "title" => "Detail Produk",
            "data" => $product
        ]);
    }
    public function destroy($id):RedirectResponse{
        product::where('id',$id)->delete();
        return redirect()->route('product.index')->with('delete','data produk berhasil diharus');
    }
}
