<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\Query;
use App\Http\Requests\MahasiswaCreateRequests;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $mahasiswas = Mahasiswa::where('Nama','Like','%'.$request->search.'%')->paginate(5);
        }else{
            $mahasiswas = Mahasiswa::all();
            $mahasiswas = Mahasiswa::orderBy('Nim', 'desc')->paginate(5);
        }

        return view('mahasiswas.index', compact('mahasiswas'));
        with('i', (request()->input('page', 1) - 1) * 5);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
        ]);

        Mahasiswa::find($Nim)->update($request->all());

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa berhasil dihapus');
    }
}
