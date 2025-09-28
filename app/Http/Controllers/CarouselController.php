<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarouselRequest;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::latest()->paginate(10);

        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(CarouselRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('carousels', 'public');
            $data['image'] = $path;
        }

        // pastikan urutan ikut tersimpan
        $data['urutan'] = $request->input('urutan', 0);
        $data['aktif'] = $request->input('aktif', 1);

        Carousel::create($data);

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(CarouselRequest $request, Carousel $carousel)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
                Storage::disk('public')->delete($carousel->image);
            }
            $path = $request->file('image')->store('carousels', 'public');
            $data['image'] = $path;
        }

        // tambahkan urutan dan aktif ke update
        $data['urutan'] = $request->input('urutan', $carousel->urutan);
        $data['aktif'] = $request->input('aktif', $carousel->aktif);

        $carousel->update($data);

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil diperbarui.');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete($carousel->image);
        $carousel->delete();

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil dihapus.');
    }
}
