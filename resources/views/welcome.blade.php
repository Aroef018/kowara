@extends('layouts.app')

<style>
    .hero-section {
        height: 100vh; /* Pastikan gambar memenuhi tinggi layar penuh */
        position: relative; /* Untuk mengatur overlay teks di atas gambar */
        overflow: hidden;
    }

    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('image/beach-418742_1280.jpg') }}');
        background-size: cover; /* Pastikan gambar memenuhi area */
        background-position: center; /* Atur posisi gambar di tengah */
        z-index: -1; /* Pastikan gambar di bawah konten */
        opacity: 0.7; /* Transparansi overlay */
    }

    .article-image {
        width: 100%;  /* Menjaga gambar memenuhi kolom */
        height: 200px; /* Menetapkan tinggi gambar tetap sama */
        object-fit: cover; /* Memastikan gambar terpotong dan proporsional */
    }

    .card-body {
        min-height: 200px; /* Sesuaikan tinggi minimum */
        max-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }


    .card-text {
        max-height: 75px; /* Sesuaikan tinggi maksimum */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Batasi ke 3 baris */
        -webkit-box-orient: vertical;
        white-space: normal;
    }
    
</style>

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center d-flex align-items-center justify-content-center">
    <!-- Background Gambar -->
    <div class="background-overlay"></div>
    
    <!-- Konten Teks -->
    <div class="container text-white">
      <h1 class="display-4 fw-bold">Selamat Datang</h1>
      <p class="lead">Jelajahi artikel dan informasi inspiratif setiap harinya.</p>
      <a class="btn btn-primary btn-lg mt-3" href="{{ route('articles.list') }}">Lihat Artikel</a>
    </div>
</section>  

<!-- Articles Section -->
<section class="py-5" id="articles">
    <div class="container">
        <h2 class="text-center mb-5">Artikel Terbaru</h2>
        <div class="row g-4">
            @forelse ($articles->take(6) as $article)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <!-- Gambar dengan ukuran tetap -->
                        <img src="{{ Storage::url($article->main_image) }}" alt="{{ $article->title }}" class="article-image">
                        <div class="card-body">
                            <h5 class="card-title">{!! Str::limit($article->title, 50) !!}</h5>
                            <p class="card-text">
                                {!! \App\Helpers\TextHelper::limitLines(strip_tags($article->content)) !!}
                            </p>
                            <a href="{{ route('article.detail', $article->id) }}" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                        </div>                        
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada artikel.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection