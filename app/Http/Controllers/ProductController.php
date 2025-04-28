<?php

namespace App\Http\Controllers;

use App\Models\Categoris;
use App\Models\Products;
use Illuminate\Http\Request;
//harus ada ini untuk menghapus file poto
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Products";
        //select * from product LEFT JOIN categoris ON categoris.id = products.category_id
        //ORM : object relation mapp
        $datas = Products::with('category')->get();
        //print_r = return
        // return $datas;
        return view('products.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Categoris::orderBy('id', 'desc')->get();

        return view('products.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('product', 'public');
            $data['product_photo'] = $photo;
        }

        Products::create($data);

        return redirect()->to('product');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Products::find($id);
        $categories = Categoris::orderBy('id', 'desc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
            'stock' => $request->stock,
        ];

        $product = Products::find($id);
        if ($request->hasFile('product_photo')) {
            //jika gambar sudah ada dan mau diubah maka gambar kita hapus di ganti oleh gambar baru
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->photo));
            }
            $photo = $request->file('product_photo')->store('product', 'public');
            $data['product_photo'] = $photo;
        }

        $product->update($data);
        Alert::toast('Data Change Success', 'success');
        return redirect()->to('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        File::delete(public_path('storage/' . $product->product_photo));
        Products::where('id', $id)->delete();
        return redirect()->to('product');
    }
}
