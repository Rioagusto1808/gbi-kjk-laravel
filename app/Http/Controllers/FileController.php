<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::with('uploader')->paginate(20);

        return response()->json($files);
    }

    public function store(FileRequest $request)
    {
        $uploaded = $request->file('file');
        $path = $uploaded->store('uploads', 'public');

        $file = File::create([
            'nama_asli' => $uploaded->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $uploaded->getMimeType(),
            'size' => $uploaded->getSize(),
            'kategori' => $request->kategori,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json($file, 201);
    }

    public function show(File $file)
    {
        return response()->json($file);
    }

    public function destroy(File $file)
    {
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return response()->json(['message' => 'File dihapus']);
    }
}
