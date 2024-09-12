<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
  public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Pegawai::query();

        if ($request->has('pegawai_id') && $request->input('pegawai_id') !== '') {
            $query->where('id', $request->input('pegawai_id'));
        }
        if ($request->has('email') && $request->input('email') !== '') {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->has('tanggal_lahir') && $request->input('tanggal_lahir') !== '') {
            $query->whereDate('tanggal_lahir', $request->input('tanggal_lahir'));
        }
        if ($request->has('jabatan') && $request->input('jabatan') !== '') {
            $query->where('jabatan', 'like', '%' . $request->input('jabatan') . '%');
        }

        $pegawais = $query->get();
        
        return response()->json($pegawais);
    }

    // Non-AJAX request
    $pegawais = Pegawai::all();
    return view('pegawai.index', compact('pegawais'));
}



    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais',
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('files', 'public');
        }

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais,email,' . $pegawai->id,
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($pegawai->file) {
                Storage::disk('public')->delete($pegawai->file);
            }
            $validated['file'] = $request->file('file')->store('files', 'public');
        }

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->file) {
            Storage::disk('public')->delete($pegawai->file);
        }
        
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
