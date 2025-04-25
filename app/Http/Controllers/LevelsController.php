<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Levels";
        //panggil semua data base berna,a levels
        $levels = Levels::get();
        return view('levels.index', compact('title', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Levels::create([
            'level_name' => $request->level_name,
        ]);
        return redirect()->to('levels');
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
        $edit = Levels::find($id);
        return view('levels.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $levels = Levels::find($id);
        $levels->level_name = $request->level_name;
        $levels->save();

        return redirect()->to('levels');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Levels::where('id', $id)->delete();
        return redirect()->to('levels');
    }
}
