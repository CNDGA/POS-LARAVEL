<?php

namespace App\Http\Controllers;

use App\Models\Categoris;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Categories";
        //panggil semua data bases Categories
        $categories = Categoris::get();
        return view('categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categoris::create([
            'category_name' => $request->category_name,
        ]);
        return redirect()->to('categories');
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
        $edit = Categoris::find($id);
        return view('categories.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //opsi pertama
        // Categoris::where('id', $id)->update([
        //     'category_name' => $request->category_name,
        // ]);

        $category = Categoris::find($id);
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->to('categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categoris::where('id', $id)->delete();
        return redirect()->to('categories');
    }
}
