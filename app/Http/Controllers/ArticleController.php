<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('additionalImages')->get();

        // dd($articles);

        return view('admin.manageArticle', compact('articles'));
    }

    public function show($id)
    {
        $articles = Article::latest()
        ->where('id', '!=', $id) // Kecualikan artikel dengan ID tertentu
        ->get();
        
        $article = Article::findOrFail($id); // Ambil artikel berdasarkan ID
        return view('detailArticle', compact('article', 'articles'));
    }


    public function create()
    {
        return view('admin.addArticle');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        $article->content = $validated['content'];

        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('images', 'public');
            $article->main_image = $mainImagePath;
        }

        $article->save();

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $additionalImage) {
                $additionalImagePath = $additionalImage->store('images', 'public');
                $article->additionalImages()->create([
                    'path' => $additionalImagePath,
                ]);
            }
        }

        return redirect()->route('articles.index')->with('success', 'Article uploaded successfully.');
    }

    public function update(Request $request, Article $article)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update title dan content
        $article->title = $request->input('title');
        $article->content = $request->input('content');

        // Update main_image jika ada
        if ($request->hasFile('main_image')) {
            // Hapus gambar utama lama jika ada
            if ($article->main_image && Storage::exists($article->main_image)) {
                Storage::delete($article->main_image);
            }

            // Simpan gambar utama baru
            $mainImagePath = $request->file('main_image')->store('images', 'public');
            $article->main_image = $mainImagePath;
        }

        $article->save();

        // Update additional_images jika ada
        if ($request->hasFile('additional_images')) {
            // Hapus gambar tambahan lama jika ada
            foreach ($article->additionalImages as $additionalImage) {
                if (Storage::exists($additionalImage->path)) {
                    Storage::delete($additionalImage->path);
                }
                $additionalImage->delete(); // Hapus dari database
            }

            // Simpan gambar tambahan baru
            foreach ($request->file('additional_images') as $additionalImage) {
                $additionalImagePath = $additionalImage->store('images', 'public');
                $article->additionalImages()->create([
                    'path' => $additionalImagePath,
                ]);
            }
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari artikel berdasarkan ID
        $article = Article::find($id);

        // Jika artikel ditemukan, hapus
        if ($article) {
            $article->delete();

            // Redirect ke halaman daftar artikel setelah berhasil menghapus
            return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
        }

        // Jika artikel tidak ditemukan
        return redirect()->route('articles.index')->with('error', 'Artikel tidak ditemukan!');
    }

    public function edit($id)
    {
        // Cari artikel berdasarkan ID
        $article = Article::find($id);

        // Jika artikel tidak ditemukan, kembalikan ke daftar artikel dengan pesan error
        if (!$article) {
            return redirect()->route('articles.index')->with('error', 'Artikel tidak ditemukan!');
        }

        // Kirim data artikel ke view edit
        return view('admin.editArticle', compact('article'));
    }
}