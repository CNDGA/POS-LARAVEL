<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Users";
        $datas = Users::with('levels')->get();
        return view('users.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Levels::orderBy('id', 'desc')->get();
        return view('users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'level_id' => 'required|exists:levels,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ];

        Users::create($data);
        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->to('users');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Users::findOrFail($id);
        $levels = Levels::orderBy('id', 'desc')->get();
        return view('users.edit', compact('edit', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'level_id' => 'required|exists:levels,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'level_id' => $request->level_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user = Users::findOrFail($id);
        $user->update($data);

        Alert::toast('Data berhasil diubah', 'success');
        return redirect()->to('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        Alert::toast('Data berhasil dihapus', 'success');
        return redirect()->to('users');
    }
}
