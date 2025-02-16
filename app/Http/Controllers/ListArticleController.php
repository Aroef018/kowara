<?php

namespace App\Http\Controllers;

use App\Models\Article; // Pastikan model Article sudah diimport
use Illuminate\Http\Request;

class ListArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(12); // Ambil 12 artikel per halaman
        return view('listArticle', compact('articles'));
    }
}