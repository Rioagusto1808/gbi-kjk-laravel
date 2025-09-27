<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{

    public function indexPublic()
{
    $berita = Berita::with('files', 'author')
        ->whereNotNull('published_at')
        ->orderByDesc('published_at')
        ->paginate(16);

    return view('landing.berita.index', compact('berita'));
}

public function show(Berita $berita)
{
    $berita->load('files', 'author');

    // Ambil berita lain selain berita yang sedang dibuka
    $beritaLain = Berita::with('files')
        ->where('id', '!=', $berita->id)
        ->whereNotNull('published_at')
        ->orderByDesc('published_at')
        ->limit(5)
        ->get();

    return view('landing.berita.show', compact('berita', 'beritaLain'));
}

    public function index()
    {
        $berita = Berita::with(['author', 'files'])->latest()->paginate(12);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(BeritaRequest $request)
    {
        $berita = Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'author_id' => auth()->id(),
            'published_at' => $request->published_at,
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $uploaded) {
                $path = $uploaded->store('berita', 'public');

                $fileModel = \App\Models\File::create([
                    'nama_asli' => $uploaded->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $uploaded->getMimeType(),
                    'size' => $uploaded->getSize(),
                    'kategori' => 'berita',
                    'uploaded_by' => auth()->id(),
                ]);

                $berita->files()->attach($fileModel->id, ['tipe' => 'gambar']);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(BeritaRequest $request, Berita $berita)
    {
        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'published_at' => $request->published_at,
        ]);

        if ($request->hasFile('foto')) {
            // hapus semua foto lama
            foreach ($berita->files as $oldFile) {
                Storage::disk('public')->delete($oldFile->path);
                $oldFile->delete();
            }
            $berita->files()->detach();

            // upload foto baru
            foreach ($request->file('foto') as $uploaded) {
                $path = $uploaded->store('berita', 'public');

                $fileModel = \App\Models\File::create([
                    'nama_asli' => $uploaded->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $uploaded->getMimeType(),
                    'size' => $uploaded->getSize(),
                    'kategori' => 'berita',
                    'uploaded_by' => auth()->id(),
                ]);

                $berita->files()->attach($fileModel->id, ['tipe' => 'gambar']);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }

}
